<?php
// purchase-request.php

// -----------------------------------------------------------
// Variabel Data Dummy
$headerUser = [
    'name' => 'John Doe', // Untuk header
    'role' => 'Admin'     // Untuk header
];

// Data untuk formulir
$requestDate = '12 Oktober 2025';
$prNumber = 'PR/PROC/X/25/0765';
$unit = 'Produksi';
$department = 'Maintenance';

// Data dropdown dummy
$itemGroups = [
    'Suku Cadang Mesin', 
    'Alat Keselamatan', 
    'Alat Tulis Kantor'
];
$items = [
    'Bearing 6205 ZZ', 
    'Oli Mesin SAE 40', 
    'Sarung Tangan Karet'
];

// Variabel untuk menentukan halaman aktif (DIPERLUKAN di partials/sidebar.php)
$currentPage = 'purchase_request'; 

// CATATAN: Fungsi getMenuIcon() harus ada di partials/sidebar.php 
// agar tidak perlu didefinisikan di sini. 
// Jika Anda tidak memisahkan fungsi tersebut, Anda HARUS mendefinisikannya di sini 
// atau di partials/config.php yang di-include sebelum sidebar.php.
// Untuk mematuhi permintaan "cukup panggil saja", kita asumsikan ia ada.
// Namun, demi keamanan kode agar berjalan, saya akan biarkan fungsi di-comment
// dan kita asumsikan partials/sidebar.php sudah menyediakannya.

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Purchase Request | Logistix</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* ---------------------------------
           GAYA KUSTOM SIDEBAR DAN SCROLLBAR (Perlu ada di sini jika tidak ada di file CSS terpisah)
           --------------------------------- */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9; /* bg-slate-100 */
        }
        
        /* Gaya Tautan Sidebar Aktif (HARUS ada di sini/CSS file) */
        .sidebar-link {
            color: #cbd5e1; /* slate-300 */
        }
        .sidebar-link.active {
            background-color: #4f46e5; /* indigo-600 */
            color: #ffffff !important;
            font-weight: 600;
        }
        .sidebar-link:not(.active):hover {
            background-color: #334155; /* slate-700 */
            color: #ffffff !important;
        }

        /* SOLUSI SCROLLBAR AGRESIF */
        .custom-scrollbar-hide {
            -ms-overflow-style: none !important; 
            scrollbar-width: none !important; 
        }
        .custom-scrollbar-hide::-webkit-scrollbar {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }
        
        /* GAYA KHUSUS FORMULIR */
        .input-label {
            /* Lebih ringkas, menggunakan utilitas Tailwind */
            @apply block text-sm font-medium text-slate-700 mb-1; 
        }
        .form-input {
            /* Default form input styling, memastikan w-full */
            @apply w-full border border-slate-300 rounded-lg shadow-sm px-3 py-2 text-slate-700 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150;
        }
        .static-input {
             /* Styling untuk teks statis (non-editable) */
             @apply text-base font-semibold text-slate-800 mt-1;
        }
        
        /* PENYESUAIAN POSISI IKON */
        .relative > .form-input.appearance-none ~ .fa-chevron-down {
            position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #64748b; pointer-events: none;
        }
        .relative > .form-input.pr-10 ~ .fa-calendar-alt {
            position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; cursor: pointer;
        }
        .table-input {
            @apply w-full border border-slate-300 rounded-md shadow-sm px-3 py-2 text-sm text-slate-700 focus:ring-indigo-500 focus:border-indigo-500;
        }
        .item-row .relative > .table-input.appearance-none ~ .fa-chevron-down {
            right: 8px; font-size: 0.75rem; 
        }
        
    </style>
</head>
<body class="bg-slate-100 flex min-h-screen"> 
    
    <?php 
        // PANGGIL SIDEBAR (Menggunakan logika file PHP eksternal)
        // Kita berasumsi file ini berisi seluruh tag <aside> dan fungsi PHP pendukung
        include 'partials/sidebar.php'; 
    ?> 

    <main class="flex-1 ml-64 flex flex-col">
        
        <?php 
            // PANGGIL HEADER (Menggunakan logika file PHP eksternal)
            // Kita berasumsi file ini berisi seluruh tag <header>
            // Jika Anda tidak memiliki partials/header.php, baris ini perlu dihapus 
            // atau diganti dengan kode header manual
            // include 'partials/header.php'; 
            
            // Menggunakan kode header manual yang Anda sediakan di dalam main:
        ?>
        <header class="h-20 bg-white shadow-md flex items-center justify-between px-8 z-10">
            <div class="text-xl font-semibold text-slate-800">Formulir Purchase Request (PR)</div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" placeholder="Cari..." class="form-input py-1.5 w-48 bg-slate-100 border-slate-300">
                    <i class="fa fa-search absolute right-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                </div>
                <div class="w-10 h-10 bg-indigo-500 rounded-full flex items-center justify-center text-white font-bold cursor-pointer">JD</div>
                <div class="text-slate-700 text-sm">
                    <span class="font-medium"><?php echo htmlspecialchars($headerUser['name']); ?></span><br>
                    <span class="text-xs text-slate-500"><?php echo htmlspecialchars($headerUser['role']); ?></span>
                </div>
            </div>
        </header>

        <div class="p-8 flex-1">
            <div class="bg-white p-8 rounded-xl shadow-lg">
                <h2 class="text-xl font-semibold text-slate-800 mb-6">Formulir Purchase Request (PR)</h2>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6 pb-6 border-b border-slate-200">
                    <div>
                        <label class="input-label">Tanggal Request</label>
                        <p class="static-input"><?php echo htmlspecialchars($requestDate); ?></p>
                    </div>
                    <div>
                        <label class="input-label">No. PR</label>
                        <p class="static-input"><?php echo htmlspecialchars($prNumber); ?></p>
                    </div>
                    <div>
                        <label class="input-label">Unit</label>
                        <p class="static-input"><?php echo htmlspecialchars($unit); ?></p>
                    </div>
                    <div>
                        <label class="input-label">Department</label>
                        <p class="static-input"><?php echo htmlspecialchars($department); ?></p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 pt-2">
                    <div>
                        <label for="expected_date" class="input-label">Expected Date Delivery</label>
                        <div class="relative">
                            <input type="text" id="expected_date" name="expected_date" placeholder="dd/mm/yyyy" class="form-input pr-10">
                            <i class="fa fa-calendar-alt"></i> 
                        </div>
                    </div>
                    <div>
                        <label for="group_item" class="input-label">Group of Item</label>
                        <div class="relative">
                            <select id="group_item" name="group_item" class="form-input appearance-none">
                                <option value="">-- Cari Group --</option>
                                <?php foreach ($itemGroups as $group): ?>
                                    <option value="<?php echo htmlspecialchars($group); ?>"><?php echo htmlspecialchars($group); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <i class="fa fa-chevron-down"></i>
                        </div>
                    </div>
                    <div>
                        <label for="lokasi_tujuan" class="input-label">Lokasi Tujuan (Gudang)</label>
                        <input type="text" id="lokasi_tujuan" name="lokasi_tujuan" placeholder="Isikan manual jika perlu" class="form-input">
                    </div>
                </div>

                <h3 class="font-semibold text-lg text-slate-800 mb-4 mt-6">Detail Item</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b bg-slate-50 text-slate-600">
                                <th class="text-left font-semibold p-3">Item (Cari berdasarkan group)</th>
                                <th class="text-left font-semibold p-3 w-48">Volume (Qty UoM terkecil)</th>
                                <th class="w-16 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="item-list">
                            <tr class="item-row border-b border-slate-100 hover:bg-slate-50">
                                <td class="p-2">
                                    <div class="relative">
                                        <select id="item_select_1" name="item[]" class="table-input appearance-none bg-white">
                                            <option value="Bearing 6205 ZZ" selected>Bearing 6205 ZZ</option>
                                            <?php foreach ($items as $item): ?>
                                                <?php if ($item !== 'Bearing 6205 ZZ'): ?>
                                                    <option value="<?php echo htmlspecialchars($item); ?>"><?php echo htmlspecialchars($item); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <i class="fa fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 text-xs pointer-events-none"></i>
                                    </div>
                                </td>
                                <td class="p-2">
                                    <div class="relative">
                                        <input type="number" id="volume_1" name="volume[]" value="10" placeholder="Contoh: 10" class="table-input text-right pr-16">
                                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 text-xs">Pcs</span>
                                    </div>
                                </td>
                                <td class="p-2 text-center">
                                    <button type="button" onclick="removeItem(this)" class="text-red-500 hover:text-red-700 p-1">
                                        <i class="fa fa-times text-base"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <button type="button" id="add-item-btn" class="text-indigo-600 hover:text-indigo-800 font-medium mt-4 p-2 rounded-lg transition duration-200 flex items-center">
                    <i class="fa fa-plus mr-1 text-sm"></i> Tambah Item
                </button>

                <div class="flex justify-end mt-8">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-8 rounded-lg shadow-xl transition duration-200">
                        Submit Request
                    </button>
                </div>

            </div>
        </div>
    </main>

    <script>
        let itemCount = 2; 

        // Data item harus diambil dari PHP untuk digunakan di JS
        const itemOptions = [
            <?php foreach ($items as $item): ?>
                { value: "<?php echo htmlspecialchars($item); ?>", text: "<?php echo htmlspecialchars($item); ?>" },
            <?php endforeach; ?>
        ];

        /**
         * Menambahkan baris item baru ke formulir (dalam format TR).
         */
        function addItem() {
            const itemList = document.getElementById('item-list');
            const newItemRow = document.createElement('tr');
            newItemRow.classList.add('item-row', 'border-b', 'border-slate-100', 'hover:bg-slate-50');

            // HTML untuk baris item baru dalam format <td>
            newItemRow.innerHTML = `
                <td class="p-2">
                    <div class="relative">
                        <select id="item_select_${itemCount}" name="item[]" class="table-input appearance-none bg-white">
                            <option value="">Pilih Item</option>
                            ${itemOptions.map(opt => `<option value="${opt.value}">${opt.text}</option>`).join('')}
                        </select>
                        <i class="fa fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 text-xs pointer-events-none"></i>
                    </div>
                </td>
                <td class="p-2">
                    <div class="relative">
                        <input type="number" id="volume_${itemCount}" name="volume[]" placeholder="Contoh: 10" class="table-input text-right pr-16">
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 text-xs">Pcs</span>
                    </div>
                </td>
                <td class="p-2 text-center">
                    <button type="button" onclick="removeItem(this)" class="text-red-500 hover:text-red-700 p-1">
                        <i class="fa fa-times text-base"></i>
                    </button>
                </td>
            `;

            itemList.appendChild(newItemRow);
            itemCount++;
        }

        /**
         * Menghapus baris item dari formulir.
         * @param {HTMLElement} buttonElement - Tombol yang diklik.
         */
        function removeItem(buttonElement) {
            const itemRows = document.querySelectorAll('.item-row');
            if (itemRows.length > 1) {
                // Mencari elemen <tr> terdekat
                const itemRow = buttonElement.closest('tr.item-row');
                if (itemRow) {
                    itemRow.remove();
                }
            } else {
                alert("Minimal harus ada satu item dalam Purchase Request.");
            }
            
        }

        // Event listener untuk tombol 'Tambah Item'
        document.getElementById('add-item-btn').addEventListener('click', addItem);
        
        // Dummy date picker functionality 
        const expectedDateInput = document.getElementById('expected_date');
        // Menggunakan selector yang tepat untuk ikon kalender yang sesuai
        const calendarIcon = document.querySelector('.relative:has(#expected_date) .fa-calendar-alt');

        // Mengaktifkan simulasi set tanggal hari ini
        const handleDateClick = function() {
            const today = new Date();
            const day = String(today.getDate()).padStart(2, '0');
            const month = String(today.getMonth() + 1).padStart(2, '0'); 
            const year = today.getFullYear();
            expectedDateInput.value = `${day}/${month}/${year}`;
        };
        
        expectedDateInput.addEventListener('click', handleDateClick);
        if (calendarIcon) {
            calendarIcon.addEventListener('click', handleDateClick);
        }
        
    </script>
</body>
</html>