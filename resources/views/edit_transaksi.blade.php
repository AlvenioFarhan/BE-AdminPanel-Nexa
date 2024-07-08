<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-4">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">EDIT TRANSAKSI</h1>
        <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST" id="editTransaksiForm">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="nomor_transaksi" class="block font-semibold">Nomor Transaksi</label>
                <input type="text" id="nomor_transaksi" name="nomor_transaksi" value="{{ $transaksi->nomor_transaksi }}" class="border border-gray-300 p-2 rounded w-full" readonly>
            </div>
            <div class="mb-4">
                <label for="tanggal_transaksi" class="block font-semibold">Tanggal Transaksi</label>
                <input type="date" id="tanggal_transaksi" name="tanggal_transaksi" value="{{ $transaksi->tanggal_transaksi }}" class="border border-gray-300 p-2 rounded w-full">
            </div>
            <div class="mb-4">
                <label for="customer" class="block font-semibold">Pilih Customer</label>
                <select id="customer" name="id_customer" class="border border-gray-300 p-2 rounded w-full">
                    @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" @if($customer->id == $transaksi->id_customer) selected @endif>{{ $customer->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200 text-left">
                            <th class="py-2 px-4">No</th>
                            <th class="py-2 px-4">Nama Barang</th>
                            <th class="py-2 px-4">Qty</th>
                            <th class="py-2 px-4">Subtotal</th>
                            <th class="py-2 px-4">Action</th>
                        </tr>
                    </thead>
                    <tbody id="barangTableBody">
                        @foreach($transaksi->detail as $item)
                        <tr data-id="{{ $item->id }}">
                            <td class="border-t py-2 px-4">{{ $loop->iteration }}</td>
                            <td class="border-t py-2 px-4">{{ $item->nama_barang }}</td>
                            <td class="border-t py-2 px-4">
                                <input type="number" name="barang[{{ $item->id }}][qty]" value="{{ $item->qty }}" class="border border-gray-300 p-1 rounded w-full" oninput="updateSubtotal(this)">
                            </td>
                            <td class="border-t py-2 px-4"><span class="subtotal">{{ number_format($item->subtotal, 2, ',', '.') }}</span></td>
                            <td class="border-t py-2 px-4">
                                <button type="button" class="text-red-600" onclick="deleteBarang(this)">Hapus</button>
                            </td>
                            <input type="hidden" name="barang[{{ $item->id }}][id]" value="{{ $item->id }}">
                            <input type="hidden" name="barang[{{ $item->id }}][kd_barang]" value="{{ $item->kd_barang }}">
                            <input type="hidden" name="barang[{{ $item->id }}][nama_barang]" value="{{ $item->nama_barang }}">
                            <input type="hidden" name="barang[{{ $item->id }}][harga]" value="15000"> <!-- Harga barang disimpan di sini -->
                            <input type="hidden" name="barang[{{ $item->id }}][subtotal]" value="{{ $item->subtotal }}" class="subtotal-input">
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mb-4">
                <p class="font-bold">Total Transaksi : <span id="totalTransaksi">{{ number_format($transaksi->total_transaksi, 2, ',', '.') }}</span></p>
                <input type="hidden" id="total_transaksi" name="total_transaksi" value="{{ $transaksi->total_transaksi }}">
            </div>
            <button type="submit" class="bg-purple-600 text-white p-2 rounded w-full">Simpan Perubahan</button>
            <a href="/" class="bg-gray-400 text-white p-2 rounded w-full my-3 text-center block">Batal Perubahan</a>
        </form>
    </div>
    <script>
        function deleteBarang(button) {
            const row = button.closest('tr');
            row.remove();
            updateTotalTransaksi();
        }

        function updateSubtotal(input) {
            const row = input.closest('tr');
            const qty = input.value;
            const harga = row.querySelector('input[name*="[harga]"]').value;
            const subtotalElem = row.querySelector('.subtotal');
            const subtotalInput = row.querySelector('.subtotal-input');

            const subtotal = qty * harga;
            subtotalElem.innerText = subtotal.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
            subtotalInput.value = subtotal;

            updateTotalTransaksi();
        }

        function updateTotalTransaksi() {
            const rows = document.querySelectorAll('#barangTableBody tr');
            let total = 0;
            rows.forEach(row => {
                const subtotal = parseFloat(row.querySelector('.subtotal-input').value);
                total += subtotal;
            });
            document.getElementById('totalTransaksi').innerText = total.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
            document.getElementById('total_transaksi').value = total;
        }
    </script>
</body>
</html>
