<?php
// persetujuan-pr.php

// -----------------------------------------------------------
// Variabel Data Dummy
$headerUser = [
    'name' => 'John Doe', // Untuk header
    'role' => 'Admin'      // Untuk header
];

// Data untuk formulir Persetujuan PR
$prNumberSelected = 'PR/PROC/X/25/0765';
$requestor = 'Budi Santoso';
$department = 'Maintenance';
$tglRequest = '12/10/2025'; // Format DD/MM/YYYY
$tglDiharapkan = '20/10/2025'; // Format DD/MM/YYYY

$prList = [
    'PR/PROC/X/25/0765' => 'PR/PROC/X/25/0765 - Maintenance',
    'PR/PROC/X/25/0766' => 'PR/PROC/X/25/0766 - Produksi',
    'PR/PROC/X/25/0767' => 'PR/PROC/X/25/0767 - Gudang',
];

// Data item PR yang akan disetujui
$prItems = [
    [
        'id' => 1,
        'item' => 'Bearing 6205 ZZ',
        'qtyDiajukan' => 10,
        'qtyDisetujui' => 10,
        'status' => 'Setuju', // Setuju, Tolak, Belum Diproses
        'uom' => 'Pcs'
    ],
    [
        'id' => 2,
        'item' => 'V-Belt B-52',
        'qtyDiajukan' => 5,
        'qtyDisetujui' => 0,
        'status' => 'Tolak',
        'uom' => 'Unit'
    ],
    [
        'id' => 3,
        'item' => 'Sarung Tangan Karet',
        'qtyDiajukan' => 50,
        'qtyDisetujui' => 0,
        'status' => 'Belum Diproses',
        'uom' => 'Pasang'
    ],
];

// Variabel untuk menentukan halaman aktif (Sesuai dengan nama file)
$currentPage = 'persetujuan_pr'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persetujuan PR | Logistix</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* ---------------------------------
           GAYA KUSTOM SIDEBAR DAN SCROLLBAR
           --------------------------------- */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9; /* bg-slate-100 */
        }
        
        /* Gaya Tautan Sidebar Aktif (Mengikuti desain partials/sidebar.php) */
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
        
        /* ---------------------------------
           GAYA KHUSUS FORMULIR (Disesuaikan & Disederhanakan)
           --------------------------------- */
        .input-label {
            @apply block text-sm font-medium text-slate-700 mb-1; 
        }
        .form-input {
            @apply w-full border border-slate-300 rounded-lg shadow-sm px-3 py-2 text-slate-700 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150;
        }
        .static-input {
             @apply text-base font-semibold text-slate-800 mt-1;
        }
        
        /* Gaya untuk Select (Dropdown) di bagian atas */
        .form-select {
            @apply w-full border border-slate-300 rounded-lg shadow-sm px-4 py-2.5 text-slate-700 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 appearance-none;
        }

        /* Gaya untuk Input/Select dalam Tabel */
        .table-input {
            @apply w-full border border-slate-300 rounded-md shadow-sm px-3 py-2 text-sm text-slate-700 focus:ring-indigo-500 focus:border-indigo-500;
        }

        /* Penyesuaian Posisi Ikon di Select */
        .relative > .form-select.appearance-none ~ .fa-chevron-down {
            position: absolute; 
            right: 12px; 
            top: 50%; 
            transform: translateY(-50%); 
            color: #64748b; /* slate-500 */
            pointer-events: none;
        }
        
        /* Penyesuaian Posisi Ikon di Tabel Select */
        .item-row .relative > .table-input.appearance-none ~ .fa-chevron-down {
            right: 8px; /* Sedikit lebih ke dalam karena padding lebih kecil */
            font-size: 0.75rem; /* xs */
        }

        /* Status Badge Styling */
        .status-setuju {
            @apply bg-green-100 text-green-800 border-green-300;
        }
        .status-tolak {
            @apply bg-red-100 text-red-800 border-red-300;
        }
        .status-belum {
            @apply bg-yellow-100 text-yellow-800 border-yellow-300;
        }
    </style>
</head>
<body class="bg-slate-100 flex min-h-screen"> 
    
    <?php 
        // PANGGIL SIDEBAR (Menggunakan logika file PHP eksternal)
        // **Pastikan file partials/sidebar.php ada dan berisi semua kode sidebar yang dihapus dari sini**
        include 'partials/sidebar.php'; 
    ?>

    <main class="flex-1 ml-64 flex flex-col">
        
        <?php 
            // START DUMMY HEADER (Disimpan dari kode sebelumnya)
        ?>
        <header class="h-20 bg-white shadow-md flex items-center justify-between px-8 z-10">
            <div class="text-xl font-semibold text-slate-800">Persetujuan Purchase Request (PR)</div>
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
        <?php // END DUMMY HEADER ?>

        <div class="p-8 flex-1">
            <h2 class="text-2xl font-semibold text-slate-800 mb-6">Persetujuan Purchase Request</h2>

            <div class="bg-white p-8 rounded-xl shadow-lg">
                
                <div class="flex flex-col md:flex-row items-center mb-8 pb-6 border-b border-slate-200">
                    <label for="cari_pr" class="text-lg font-medium text-slate-600 mr-4 whitespace-nowrap mb-2 md:mb-0">Pilih No. PR:</label>
                    <div class="relative w-full md:w-96">
                        <select id="cari_pr" name="cari_pr" class="form-select pr-10">
                            <?php foreach ($prList as $key => $pr): ?>
                                <option value="<?php echo htmlspecialchars($key); ?>" 
                                    <?php echo ($key == $prNumberSelected ? 'selected' : ''); ?>>
                                    <?php echo htmlspecialchars($pr); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <i class="fa fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 pointer-events-none"></i>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div>
                        <label class="input-label text-slate-600">Requestor</label>
                        <p class="static-input text-slate-800"><?php echo htmlspecialchars($requestor); ?></p>
                    </div>
                    <div>
                        <label class="input-label text-slate-600">Department</label>
                        <p class="static-input text-slate-800"><?php echo htmlspecialchars($department); ?></p>
                    </div>
                    <div>
                        <label class="input-label text-slate-600">Tanggal PR Dibuat</label>
                        <p class="static-input text-slate-800"><?php echo htmlspecialchars($tglRequest); ?></p>
                    </div>
                    <div>
                        <label class="input-label text-slate-600">Tanggal Diharapkan</label>
                        <p class="static-input text-slate-800"><?php echo htmlspecialchars($tglDiharapkan); ?></p>
                    </div>
                </div>
                
                <h3 class="font-semibold text-lg text-slate-800 mb-4 mt-6 border-t pt-4">Item Permintaan</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b bg-slate-50 text-slate-600">
                                <th class="text-left font-semibold p-3 w-1/4">Item</th>
                                <th class="text-center font-semibold p-3 w-24">Qty Diajukan</th>
                                <th class="text-center font-semibold p-3 w-24">Qty Disetujui</th>
                                <th class="text-center font-semibold p-3 w-32">Status</th>
                                <th class="w-16 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="pr-detail-list">
                            <?php foreach ($prItems as $index => $itemData): ?>
                                <tr class="item-row border-b border-slate-100 hover:bg-slate-50">
                                    <td class="p-3">
                                        <p class="font-medium text-slate-700"><?php echo htmlspecialchars($itemData['item']); ?></p>
                                        <p class="text-xs text-slate-500 mt-0.5">UoM: <?php echo htmlspecialchars($itemData['uom']); ?></p>
                                    </td>
                                    <td class="p-3 text-center font-medium text-slate-700"><?php echo htmlspecialchars($itemData['qtyDiajukan']); ?></td>
                                    <td class="p-3">
                                        <div class="relative">
                                            <input type="number" value="<?php echo htmlspecialchars($itemData['qtyDisetujui']); ?>" name="qty_approved[]" class="table-input text-center">
                                        </div>
                                    </td>
                                    <td class="p-3 text-center">
                                        <?php
                                        $status = $itemData['status'];
                                        $badgeClass = '';
                                        if ($status == 'Setuju') {
                                            $badgeClass = 'status-setuju';
                                        } elseif ($status == 'Tolak') {
                                            $badgeClass = 'status-tolak';
                                        } else {
                                            $badgeClass = 'status-belum';
                                        }
                                        ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border <?php echo $badgeClass; ?>">
                                            <?php echo htmlspecialchars($status); ?>
                                        </span>
                                    </td>
                                    <td class="p-3 text-center">
                                        <select name="item_action[]" class="table-input text-center text-xs bg-white">
                                            <option value="skip" <?php echo ($itemData['status'] != 'Belum Diproses' ? 'selected' : ''); ?>>Lewati</option>
                                            <option value="approve" <?php echo ($itemData['status'] == 'Setuju' ? 'selected' : ''); ?>>Setujui</option>
                                            <option value="reject" <?php echo ($itemData['status'] == 'Tolak' ? 'selected' : ''); ?>>Tolak</option>
                                        </select>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-slate-200 pt-6 mt-8 flex justify-between items-center">
                    <button type="button" class="text-slate-600 hover:text-slate-800 font-medium p-2 rounded-lg transition duration-200 flex items-center">
                        <i class="fa fa-print mr-1 text-sm"></i> Cetak PR
                    </button>
                    <div>
                        <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2.5 px-6 rounded-lg shadow transition duration-200 mr-4">
                            Tolak Semua
                        </button>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2.5 px-8 rounded-lg shadow-xl transition duration-200">
                            Simpan Persetujuan
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script>
        // Dummy JS untuk simulasi aksi di halaman persetujuan
        document.getElementById('cari_pr').addEventListener('change', function() {
            const selectedPrNumber = this.value;
            // Di aplikasi nyata, ini akan memicu AJAX/fetch untuk memuat detail PR
            console.log("Memuat detail untuk PR:", selectedPrNumber);
            alert("Simulasi: Data untuk PR " + selectedPrNumber + " akan dimuat.");
            
            // Karena ini dummy, kita akan set beberapa nilai statis
            document.querySelector('#pr-detail-list tr:nth-child(1) td:nth-child(3) input').value = 10;
            document.querySelector('#pr-detail-list tr:nth-child(1) td:nth-child(4) span').textContent = 'Setuju';
            document.querySelector('#pr-detail-list tr:nth-child(1) td:nth-child(4) span').className = 'inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border status-setuju';
            
            document.querySelector('#pr-detail-list tr:nth-child(2) td:nth-child(3) input').value = 0;
            document.querySelector('#pr-detail-list tr:nth-child(2) td:nth-child(4) span').textContent = 'Tolak';
            document.querySelector('#pr-detail-list tr:nth-child(2) td:nth-child(4) span').className = 'inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border status-tolak';

            document.querySelector('#pr-detail-list tr:nth-child(3) td:nth-child(3) input').value = 0;
            document.querySelector('#pr-detail-list tr:nth-child(3) td:nth-child(4) span').textContent = 'Belum Diproses';
            document.querySelector('#pr-detail-list tr:nth-child(3) td:nth-child(4) span').className = 'inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border status-belum';
        });

        // Dummy fungsi untuk aksi di kolom terakhir (Simulasi interaksi)
        document.querySelectorAll('#pr-detail-list select[name="item_action[]"]').forEach(selectElement => {
            selectElement.addEventListener('change', function() {
                const row = this.closest('tr.item-row');
                const statusSpan = row.querySelector('td:nth-child(4) span');
                const qtyInput = row.querySelector('td:nth-child(3) input');
                const action = this.value;

                // Reset class default
                statusSpan.className = 'inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border';

                if (action === 'approve') {
                    statusSpan.textContent = 'Setuju';
                    statusSpan.classList.add('status-setuju');
                    // Ambil nilai yang diajukan sebagai default disetujui
                    const requestedQty = row.querySelector('td:nth-child(2)').textContent.trim();
                    qtyInput.value = requestedQty;
                } else if (action === 'reject') {
                    statusSpan.textContent = 'Tolak';
                    statusSpan.classList.add('status-tolak');
                    qtyInput.value = 0;
                } else { // skip
                    statusSpan.textContent = 'Belum Diproses';
                    statusSpan.classList.add('status-belum');
                    // Biarkan qtyDisetujui sesuai nilai input terakhir (atau 0 jika baru)
                    if(qtyInput.value == 0) {
                         qtyInput.value = 0;
                    }
                }
            });
        });
    </script>
</body>
</html>