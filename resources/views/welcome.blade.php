<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 p-4">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">TRANSAKSI PENJUALAN</h1>
        <div class="mb-4">
            <div class="flex justify-between items-center">
                <div class="flex space-x-4 mx-3">
                    <div class="flex items-center space-x-2">
                        <input type="date" class="border border-gray-300 p-2 rounded">
                        <span>sd</span>
                        <input type="date" class="border border-gray-300 p-2 rounded">
                        <button class="bg-purple-600 text-white p-2 rounded">
                            <i class="fas fa-filter"></i>
                        </button>
                    </div>
                    <input type="text" placeholder="Search.." class="border border-gray-300 p-2 rounded">
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('transaksi.create') }}" class="bg-purple-600 text-white p-2 rounded">Tambah Transaksi</a>
                    <button class="bg-purple-600 text-white p-2 rounded">Export Excel</button>
                </div>
            </div>
        </div>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="w-full bg-gray-200 text-left">
                    <th class="py-2 px-4">No</th>
                    <th class="py-2 px-4">Nomor Transaksi</th>
                    <th class="py-2 px-4">Customer</th>
                    <th class="py-2 px-4">Total Transaksi</th>
                    <th class="py-2 px-4">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi as $trx)
                <tr>
                    <td class="border-t py-2 px-4">{{ $loop->iteration }}</td>
                    <td class="border-t py-2 px-4">{{ $trx->nomor_transaksi }}</td>
                    <td class="border-t py-2 px-4">{{ $trx->customer->nama }}</td>
                    <td class="border-t py-2 px-4">{{ number_format($trx->total_transaksi, 2, ',', '.') }}</td>
                    <td class="border-t py-2 px-4">
                        <a href="{{ route('transaksi.edit', $trx->id) }}" class="text-blue-600">Edit</a> |
                        <form action="{{ route('transaksi.destroy', $trx->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                <tr class="font-bold">
                    <td class="border-t py-2 px-4" colspan="3">Total</td>
                    <td class="border-t py-2 px-4">{{ number_format($transaksi->sum('total_transaksi'), 2, ',', '.') }}</td>
                    <td class="border-t py-2 px-4"></td>
                </tr>
            </tbody>
        </table>
        <p class="text-red-600 mt-4">*Penyajian data gunakan plugin datatable serverside</p>
    </div>
</body>
</html>
