// resources/views/edit_transaksi.blade.php
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
        <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
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
                    <tbody>
                        @foreach($transaksi->detail as $item)
                        <tr>
                            <td class="border-t py-2 px-4">{{ $loop->iteration }}</td>
                            <td class="border-t py-2 px-4">{{ $item->nama_barang }}</td>
                            <td class="border-t py-2 px-4">{{ $item->qty }}</td>
                            <td class="border-t py-2 px-4">{{ number_format($item->subtotal, 2, ',', '.') }}</td>
                            <td class="border-t py-2 px-4">
                                <button class="text-blue-600">Edit</button> |
                                <button class="text-red-600">Hapus</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mb-4">
                <p class="font-bold">Total Transaksi : Rp {{ number_format($transaksi->total_transaksi, 2, ',', '.') }}</p>
            </div>
            <button type="submit" class="bg-purple-600 text-white p-2 rounded w-full">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
