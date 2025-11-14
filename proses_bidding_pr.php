<?php
// proses_bidding_pr.php

// -----------------------------------------------------------
// Variabel Data Dummy & Konteks
$headerUser = [
    'name' => 'John Doe', // Untuk header
    'role' => 'Admin'     // Untuk header
];

// Data untuk item yang sedang dalam proses bidding
$prNumberSelected = 'PR/PROC/X/25/0765';
$biddingItem = [
    'item_name' => 'Bearing 6205 ZZ',
    'qty' => 10,
];

// Data Dummy Vendor dan Penawaran
$vendorList = [
    'PT. Sinar Jaya Abadi',
    'CV. Mitra Teknik',
    'UD. Baja Perkasa',
    'Toko Makmur Sentosa',
];

// Data Dummy Penawaran untuk Tampilan Perbandingan (Mengikuti screenshot)
$dummyBiddings = [
    [
        'id' => 1,
        'nama_vendor' => 'PT. Sinar Jaya Abadi',
        'harga_satuan' => 55000,
        'total' => 550000,
        'term_of_payment' => '30 Hari',
        'file_uploaded' => false,
    ],
    [
        'id' => 2,
        'nama_vendor' => 'CV. Mitra Teknik',
        'harga_satuan' => 52500,
        'total' => 525000,
        'term_of_payment' => '14 Hari',
        'file_uploaded' => false,
    ]
];

// Set halaman saat ini untuk penanda di sidebar
// Nilai ini harus cocok dengan logika di partials/sidebar.php
$currentPage = 'pr-bidding-page'; 

// -----------------------------------------------------------
// FUNGSI & LOGIKA SIDEBAR DIHAPUS DARI SINI
// -----------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Bidding PR | Logistix</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* ---------------------------------
            GAYA KUSTOM FORMULIR & LAYOUT
            (Disamakan dengan pembuatan_po.php)
            --------------------------------- */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9; /* bg-slate-100 */
        }
        
        /* Gaya Formulir */
        .form-select {
            @apply w-full border border-slate-300 rounded-lg shadow-sm px-4 py-2.5 text-slate-700 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 appearance-none;
        }
        .form-input {
            @apply w-full border border-slate-300 rounded-lg shadow-sm px-4 py-2.5 text-slate-700 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150;
        }
        .input-label {
             @apply block text-sm font-medium text-slate-500 mb-1;
        }
        
        /* Gaya Sidebar Aktif */
        .sidebar-link.active {
            background-color: #4f46e5; /* indigo-600 */
            color: #ffffff;
            font-weight: 600;
        }
        .sidebar-link:hover {
            background-color: #334155; /* slate-700 */
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

        /* Gaya Khusus untuk input Total yang disabled */
        .total-input {
            @apply bg-slate-200 text-slate-800 font-bold;
        }
    </style>
</head>
<body class="bg-slate-100 flex min-h-screen"> 
    
    <?php 
    // PANGGIL SIDEBAR DARI FILE TERPISAH
    // Variabel $currentPage ('pr-bidding-page') sudah didefinisikan di atas.
    include 'partials/sidebar.php'; 
    ?>
    
    <main class="flex-1 flex flex-col ml-64 w-full"> 

        <header class="bg-white shadow-md sticky top-0 z-10">
            <div class="max-w-full mx-auto px-8 py-3 flex justify-between items-center">
                <div class="text-xl font-semibold text-slate-700">
                    Proses Bidding PR
                </div>
                <div class="flex items-center space-x-4">
                     <div class="text-right">
                        <p class="text-sm font-medium text-slate-800"><?php echo htmlspecialchars($headerUser['name']); ?></p>
                        <p class="text-xs text-slate-500"><?php echo htmlspecialchars($headerUser['role']); ?></p>
                    </div>
                    <div class="w-10 h-10 bg-indigo-500 text-white rounded-full flex items-center justify-center font-bold text-sm">
                        <?php echo strtoupper(substr($headerUser['name'], 0, 1)); ?>
                    </div>
                </div>
            </div>
        </header>
        
        <div class="p-8 flex-1">
            <div class="bg-white p-8 rounded-xl shadow-lg">
                
                <h2 class="text-2xl font-semibold text-slate-800 mb-2">Proses Bidding PR</h2>

                <div class="mb-6">
                    <p class="text-slate-600">
                        Item dari <strong class="text-slate-800"><?php echo htmlspecialchars($prNumberSelected); ?></strong> yang disetujui:
                    </p>
                    <h3 class="text-xl font-bold text-indigo-700 mt-2 mb-4">
                        Item: <?php echo htmlspecialchars($biddingItem['item_name']); ?> (Qty: <?php echo $biddingItem['qty']; ?>)
                    </h3>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 relative">
                    
                    <?php 
                    // Looping untuk menampilkan 2 dummy penawaran
                    foreach ($dummyBiddings as $index => $bidding): 
                    ?>
                    
                    <div class="p-6 border border-slate-200 rounded-xl shadow-md space-y-4">
                        <h4 class="text-lg font-bold text-slate-700 mb-4 border-b pb-2">
                            Penawaran <?php echo $index + 1; ?>
                        </h4>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="input-label">Nama Vendor</label>
                                <select class="form-select bg-white">
                                    <option>-- Pilih Vendor --</option>
                                    <?php 
                                    foreach ($vendorList as $vendor) {
                                        $selected = ($vendor == $bidding['nama_vendor']) ? 'selected' : '';
                                        echo "<option value=\"{$vendor}\" {$selected}>{$vendor}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="input-label">Harga Satuan</label>
                                    <input type="number" class="form-input" placeholder="Harga Satuan" value="<?php echo $bidding['harga_satuan']; ?>">
                                </div>
                                <div>
                                    <label class="input-label">Total</label>
                                    <input type="text" class="form-input total-input" placeholder="Total Harga" disabled value="<?php echo number_format($bidding['total'], 0, ',', '.'); ?>">
                                </div>
                            </div>
                            
                            <div>
                                <label class="input-label">Term of Payment</label>
                                <input type="text" class="form-input" placeholder="Contoh: 30 Hari" value="<?php echo htmlspecialchars($bidding['term_of_payment']); ?>">
                            </div>
                            
                            <div>
                                <label class="input-label">Dokumen Penawaran</label>
                                <label class="flex items-center px-4 py-2 bg-white border border-slate-300 rounded-lg cursor-pointer hover:bg-slate-50 transition shadow-sm w-full">
                                    <span class="text-sm text-slate-600">Choose File</span>
                                    <span class="ml-2 text-xs text-slate-400">No file chosen</span>
                                    <input type="file" class="hidden">
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    
                    <div class="lg:col-span-2 flex justify-end">
                        <button type="button" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-8 rounded-lg shadow-lg transition duration-200 mt-4">
                             Simpan Bidding Item ini
                        </button>
                    </div>
                </div> 
                <div class="flex justify-center mt-12 pt-6 border-t border-dashed border-slate-300">
                    <button type="button" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-4 px-10 rounded-xl shadow-xl transition duration-200 text-lg flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        Submit Semua Bidding untuk Approval
                    </button>
                </div>

            </div>
        </div>
    </main>
    
</body>
</html>