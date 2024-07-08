<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Customer;
use App\Models\TransaksiD;
use App\Models\TransaksiH;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = TransaksiH::with('customer')->get();
        return view('welcome', compact('transaksi'));
    }

    public function create()
    {
        $customers = Customer::all();
        $barang = [
            ['id' => 1, 'nama' => 'Barang A'],
            ['id' => 2, 'nama' => 'Barang B'],
            ['id' => 3, 'nama' => 'Barang C'],
        ];
        return view('form_transaksi', compact('customers', 'barang'));
    }

    public function store(Request $request)
    {
        // Log request data
        \Log::info('Request Data: ', $request->all());

        // Validasi input
        $validated = $request->validate([
            'tanggal_transaksi' => 'required|date',
            'id_customer' => 'required|integer|exists:customers,id',
            'total_transaksi' => 'required|numeric',
        ]);

        // Generate nomor transaksi
        $tahun = date('Y');
        $bulan = date('m');
        $counter = Counter::firstOrCreate(
            ['tahun' => $tahun, 'bulan' => $bulan],
            ['counter' => 0]
        );
        $counter->increment('counter');
        $nomor_transaksi = 'SO/' . $tahun . '-' . $bulan . '/' . str_pad($counter->counter, 4, '0', STR_PAD_LEFT);

        // Handle new customer
        if ($request->id_customer == 'new') {
            $customer = Customer::create([
                'nama' => $request->customer_nama,
                'alamat' => $request->customer_alamat,
                'phone' => $request->customer_phone,
            ]);
            $request->merge(['id_customer' => $customer->id]);
        }

        // Simpan transaksi header
        $transaksi = TransaksiH::create([
            'id_customer' => $request->id_customer,
            'nomor_transaksi' => $nomor_transaksi,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'total_transaksi' => $request->total_transaksi,
        ]);

        // Simpan transaksi detail
        foreach ($request->barang as $item) {
            TransaksiD::create([
                'id_transaksi_h' => $transaksi->id,
                'kd_barang' => $item['kd_barang'],
                'nama_barang' => $item['nama_barang'],
                'qty' => $item['qty'],
                'subtotal' => $item['subtotal'],
            ]);
        }

        return redirect()->route('transaksi.index');
    }

    public function edit($id)
    {
        $transaksi = TransaksiH::with('detail')->find($id);
        $customers = Customer::all();
        return view('edit_transaksi', compact('transaksi', 'customers'));
    }

    public function update(Request $request, $id)
    {
        $transaksi = TransaksiH::find($id);
        $transaksi->update([
            'id_customer' => $request->id_customer,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'total_transaksi' => $request->total_transaksi,
        ]);

        // Update transaksi detail
        foreach ($request->barang as $item) {
            $detail = TransaksiD::find($item['id']);
            $detail->update([
                'kd_barang' => $item['kd_barang'],
                'nama_barang' => $item['nama_barang'],
                'qty' => $item['qty'],
                'subtotal' => $item['subtotal'],
            ]);
        }

        return redirect()->route('transaksi.index');
    }

    public function destroy($id)
    {
        TransaksiH::destroy($id);
        return redirect()->route('transaksi.index');
    }
}
