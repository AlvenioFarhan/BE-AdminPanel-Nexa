<!-- resources/views/form_transaksi.blade.php -->
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
        <form action="{{ route('transaksi.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <p class="font-semibold">Nomor Transaksi</p>
                <p>Auto Generate</p>
            </div>
            <div class="mb-4">
                <label for="tanggal" class="block font-semibold">Tanggal Transaksi</label>
                <input type="date" id="tanggal" name="tanggal_transaksi" placeholder="Datepicker" class="border border-gray-300 p-2 rounded w-full">
            </div>
            <hr>
            <div class="mb-4">
                <label for="customer" class="block font-semibold">Pilih Customer</label>
                <select id="customer" name="id_customer" class="border border-gray-300 p-2 rounded w-full" onchange="toggleCustomerForm()">
                    <option value="">Option Customer</option>
                    @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->nama }}</option>
                    @endforeach
                    <option value="new">Tambah Baru</option>
                </select>
            </div>
            <div id="dataCustomer" class="mb-4 hidden">
                <label for="dataCustomer" class="block font-semibold">Data Customer</label>
                <div class="flex space-x-4">
                    <input type="text" id="customerNama" name="customer_nama" placeholder="Nama" class="border border-gray-300 p-2 rounded w-full">
                    <input type="text" id="customerAlamat" name="customer_alamat" placeholder="Alamat" class="border border-gray-300 p-2 rounded w-full">
                    <input type="text" id="customerPhone" name="customer_phone" placeholder="Phone" class="border border-gray-300 p-2 rounded w-full">
                </div>
            </div>
            <div class="mb-4">
                <label for="barang" class="block font-semibold">Pilih Barang</label>
                <div class="flex space-x-4">
                    <select id="barang" name="barang[][kd_barang]" class="border border-gray-300 p-2 rounded w-full">
                        @foreach($barang as $item)
                        <option value="{{ $item['id'] }}">{{ $item['nama'] }}</option>
                        @endforeach
                    </select>
                    <input type="number" id="qty" name="barang[][qty]" placeholder="Qty" class="border border-gray-300 p-2 rounded w-1/4">
                    <input type="number" id="subtotal" name="barang[][subtotal]" placeholder="Subtotal" class="border border-gray-300 p-2 rounded w-1/4">
                    <button type="button" onclick="addBarang()" class="bg-purple-600 text-white p-2 rounded">Tambah Barang</button>
                </div>
            </div>
            <div class="mb-4">
                <table id="barangTable" class="min-w-full bg-white border border-gray-300">
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
                        <!-- Barang items will be added here dynamically -->
                    </tbody>
                </table>
            </div>
            <div class="mb-4">
                <p class="font-bold">Total Transaksi : Rp <span id="totalTransaksi">0</span></p>
                <input type="hidden" id="total_transaksi" name="total_transaksi" value="0">
            </div>
            <button type="submit" class="bg-purple-600 text-white p-2 rounded w-full">Simpan Transaksi</button>
        </form>
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

        function addBarang() {
            const barangSelect = document.getElementById('barang');
            const qty = document.getElementById('qty').value;
            const subtotal = document.getElementById('subtotal').value;
            const barangTableBody = document.getElementById('barangTable').getElementsByTagName('tbody')[0];

            if (barangSelect.value && qty && subtotal) {
                const rowCount = barangTableBody.rows.length;
                const row = barangTableBody.insertRow(rowCount);

                const cellNo = row.insertCell(0);
                const cellNamaBarang = row.insertCell(1);
                const cellQty = row.insertCell(2);
                const cellSubtotal = row.insertCell(3);
                const cellAction = row.insertCell(4);

                cellNo.innerHTML = rowCount + 1;
                cellNamaBarang.innerHTML = barangSelect.options[barangSelect.selectedIndex].text;
                cellQty.innerHTML = qty;
                cellSubtotal.innerHTML = subtotal;
                cellAction.innerHTML = '<button type="button" onclick="deleteBarang(this)" class="text-red-600">Hapus</button>';

                // Update total transaksi
                const totalTransaksiElem = document.getElementById('totalTransaksi');
                const totalTransaksiInput = document.getElementById('total_transaksi');
                const totalTransaksi = parseInt(totalTransaksiElem.innerText.replace(/[^0-9]/g, '')) + parseInt(subtotal);
                totalTransaksiElem.innerText = totalTransaksi.toLocaleString();
                totalTransaksiInput.value = totalTransaksi;

                // Clear the input fields
                document.getElementById('qty').value = '';
                document.getElementById('subtotal').value = '';
            } else {
                alert('Please fill out all fields');
            }
        }

        function deleteBarang(btn) {
            const row = btn.parentNode.parentNode;
            const subtotal = parseInt(row.cells[3].innerHTML);
            row.parentNode.removeChild(row);

            // Update total transaksi
            const totalTransaksiElem = document.getElementById('totalTransaksi');
            const totalTransaksiInput = document.getElementById('total_transaksi');
            const totalTransaksi = parseInt(totalTransaksiElem.innerText.replace(/[^0-9]/g, '')) - subtotal;
            totalTransaksiElem.innerText = totalTransaksi.toLocaleString();
            totalTransaksiInput.value = totalTransaksi;

            // Update row numbers
            const barangTableBody = document.getElementById('barangTable').getElementsByTagName('tbody')[0];
            for (let i = 0; i < barangTableBody.rows.length; i++) {
                barangTableBody.rows[i].cells[0].innerHTML = i + 1;
            }
        }
    </script>
</body>
</html>
