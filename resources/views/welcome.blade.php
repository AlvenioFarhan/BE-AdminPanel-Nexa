<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-4">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">TRANSAKSI PENJUALAN</h1>
        <div class="flex justify-between items-center mb-4">
            <div class="flex space-x-4">
                <div class="flex items-center space-x-2">
                    <input type="text" placeholder="Datepicker" class="border border-gray-300 p-2 rounded">
                    <span>sd</span>
                    <input type="text" placeholder="Datepicker" class="border border-gray-300 p-2 rounded">
                    <button class="bg-purple-600 text-white p-2 rounded">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v16a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4m0 0l4 4m-4-4v12"></path>
                        </svg>
                    </button>
                </div>
                <input type="text" placeholder="Search.." class="border border-gray-300 p-2 rounded">
            </div>
            <div class="flex space-x-4">
                <!-- <button class="bg-purple-600 text-white p-2 rounded">Tambah Transaksi</button> -->
                <a href="form-transaksi" class="bg-purple-600 text-white p-2 rounded">Tambah Transaksi</a>
                <button class="bg-purple-600 text-white p-2 rounded">Export Excel</button>
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
                <tr>
                    <td class="border-t py-2 px-4">1</td>
                    <td class="border-t py-2 px-4">SO/2024-04/0001</td>
                    <td class="border-t py-2 px-4">Customer A</td>
                    <td class="border-t py-2 px-4">300.000</td>
                    <td class="border-t py-2 px-4">
                        <button class="text-blue-600">Edit</button> |
                        <button class="text-red-600">Hapus</button>
                    </td>
                </tr>
                <tr>
                    <td class="border-t py-2 px-4">2</td>
                    <td class="border-t py-2 px-4">SO/2024-04/0002</td>
                    <td class="border-t py-2 px-4">Customer B</td>
                    <td class="border-t py-2 px-4">200.000</td>
                    <td class="border-t py-2 px-4">
                        <button class="text-blue-600">Edit</button> |
                        <button class="text-red-600">Hapus</button>
                    </td>
                </tr>
                <tr class="font-bold">
                    <td class="border-t py-2 px-4" colspan="3">Total</td>
                    <td class="border-t py-2 px-4">500.000</td>
                    <td class="border-t py-2 px-4"></td>
                </tr>
            </tbody>
        </table>
        <p class="text-red-600 mt-4">*Penyajian data gunakan plugin datatable serverside</p>
    </div>
</body>
</html>
