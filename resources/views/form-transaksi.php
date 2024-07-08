<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-4">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">FORM TRANSAKSI</h1>
        <div class="mb-4">
            <p class="font-semibold">Nomor Transaksi</p>
            <p>Auto Generate</p>
        </div>
        <div class="mb-4">
            <label for="tanggal" class="block font-semibold">Tanggal Transaksi</label>
            <input type="text" id="tanggal" placeholder="Datepicker" class="border border-gray-300 p-2 rounded w-full">
        </div>
        <hr>
        <div class="mb-4">
            <label for="customer" class="block font-semibold">Pilih Customer</label>
            <select id="customer" class="border border-gray-300 p-2 rounded w-full" onchange="toggleCustomerForm()">
                <option value="">Option Customer</option>
                <option value="new">Tambah Baru</option>
            </select>
        </div>
        <div id="dataCustomer" class="mb-4 hidden">
            <label for="dataCustomer" class="block font-semibold">Data Customer</label>
            <div class="flex space-x-4">
                <input type="text" placeholder="Nama" class="border border-gray-300 p-2 rounded w-full">
                <input type="text" placeholder="Alamat" class="border border-gray-300 p-2 rounded w-full">
                <input type="text" placeholder="Phone" class="border border-gray-300 p-2 rounded w-full">
            </div>
        </div>
        <div class="mb-4">
            <label for="barang" class="block font-semibold">Pilih Barang</label>
            <div class="flex space-x-4">
                <select id="barang" class="border border-gray-300 p-2 rounded w-full">
                    <option>Option Barang</option>
                </select>
                <input type="text" placeholder="Qty" class="border border-gray-300 p-2 rounded w-1/4">
                <input type="text" placeholder="Subtotal" class="border border-gray-300 p-2 rounded w-1/4">
                <button class="bg-purple-600 text-white p-2 rounded">Tambah Barang</button>
            </div>
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
                    <tr>
                        <td class="border-t py-2 px-4">1</td>
                        <td class="border-t py-2 px-4">Barang A</td>
                        <td class="border-t py-2 px-4">1</td>
                        <td class="border-t py-2 px-4">300.000</td>
                        <td class="border-t py-2 px-4">
                            <button class="text-blue-600">Edit</button> |
                            <button class="text-red-600">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mb-4">
            <p class="font-bold">Total Transaksi : Rp 300.000</p>
        </div>
        <!-- <button class="bg-purple-600 text-white p-2 rounded w-full">Simpan Transaksi</button> -->
        <a href="/" class="bg-purple-600 text-white p-2 rounded w-full">Simpan Transaksi</a>
    </div>
    <script>
        function toggleCustomerForm() {
            const customerSelect = document.getElementById('customer');
            const dataCustomer = document.getElementById('dataCustomer');
            if (customerSelect.value === 'new') {
                dataCustomer.classList.remove('hidden');
            } else {
                dataCustomer.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
