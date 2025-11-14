<?php
// goods_receipt.php

// -----------------------------------------------------------
// Variabel Data Dummy & Konteks
$headerUser = [
    'name' => 'John Doe', // Untuk header
    'role' => 'Admin'     // Untuk header
];

// Set halaman saat ini untuk penanda di sidebar
// Nilai ini harus cocok dengan logika di partials/sidebar.php
$currentPage = 'goods-receipt-page'; 

// Data Dummy untuk Form GR
$grNumber = 'GR/GDG/X/25/0912';

// Data Dummy PO yang dipilih
$poData = [
    'no_po' => 'PO/MT/X/25/0432',
    'vendor' => 'CV. Mitra Teknik',
    'unit' => 'Produksi',
    'departemen' => 'Maintenance',
    'kategori' => 'Inventory',
];

// Data Dummy Item yang diterima (diambil dari PO yang dipilih)
$itemData = [
    'item_name' => 'Bearing 6205 ZZ',
    'volume_po' => 10,
    'unit' => 'Pcs',
    'total_amount' => 582750, // Rp 582.750
];

// FUNGSI UNTUK FORMAT RUPIAH
function formatRupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

// -----------------------------------------------------------
// FUNGSI SIDEBAR (DIASUMSIKAN ADA DI partials/sidebar.php)
// -----------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goods Receipt (GR) | Logistix</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* ---------------------------------
            GAYA KUSTOM FORMULIR & LAYOUT
            (Disamakan dengan file-file sebelumnya)
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
        .static-value {
             @apply w-full bg-slate-100 border border-slate-300 rounded-lg shadow-sm px-4 py-2.5 text-slate-700 font-medium;
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
    </style>
</head>
<body class="bg-slate-100 flex min-h-screen"> 
    
    <?php 
    // PANGGIL SIDEBAR DARI FILE TERPISAH
    include 'partials/sidebar.php'; 
    ?>
    
    <main class="flex-1 flex flex-col ml-64 w-full"> 

        <header class="bg-white shadow-md sticky top-0 z-10">
            <div class="max-w-full mx-auto px-8 py-3 flex justify-between items-center">
                <div class="text-xl font-semibold text-slate-700">
                    Goods Receipt (GR)
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
                
                <h2 class="text-2xl font-semibold text-slate-800 mb-6">Formulir Goods Receipt (GR)</h2>
                
                <form action="#" method="POST">
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div>
                            <label class="input-label">No. GR</label>
                            <div class="static-value"><?php echo htmlspecialchars($grNumber); ?></div>
                        </div>
                        <div>
                            <label class="input-label">Tanggal GR</label>
                            <div class="relative">
                                <input type="text" class="form-input pr-10" placeholder="dd/mm/yyyy" value="12/11/2025">
                                <i class="fa fa-calendar absolute right-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            </div>
                        </div>
                        <div>
                            <label class="input-label">Cari No. PO</label>
                            <select class="form-select bg-white">
                                <option><?php echo htmlspecialchars($poData['no_po']) . ' - ' . htmlspecialchars($poData['vendor']); ?></option>
                                <option>PO/MT/X/25/0433 - UD. Baja Perkasa</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-10 pb-6 border-b">
                        <div>
                            <label class="input-label">Vendor:</label>
                            <div class="static-value"><?php echo htmlspecialchars($poData['vendor']); ?></div>
                        </div>
                        <div>
                            <label class="input-label">Unit:</label>
                            <div class="static-value"><?php echo htmlspecialchars($poData['unit']); ?></div>
                        </div>
                        <div>
                            <label class="input-label">Departemen:</label>
                            <div class="static-value"><?php echo htmlspecialchars($poData['departemen']); ?></div>
                        </div>
                        <div>
                            <label class="input-label">Kategori:</label>
                            <div class="static-value"><?php echo htmlspecialchars($poData['kategori']); ?></div>
                        </div>
                    </div>
                    
                    <h3 class="text-lg font-bold text-slate-700 mb-4">Item yang Diterima</h3>
                    
                    <div class="overflow-x-auto mb-6">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead>
                                <tr class="text-left text-sm font-semibold text-slate-600 bg-slate-50">
                                    <th class="px-4 py-3">Item</th>
                                    <th class="px-4 py-3 text-center">Volume PO</th>
                                    <th class="px-4 py-3 text-center w-32">Volume Aktual Diterima</th>
                                    <th class="px-4 py-3 text-center">Varian</th>
                                    <th class="px-4 py-3 text-right">Total Amount</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                <tr class="text-sm text-slate-700">
                                    <td class="px-4 py-4 font-medium"><?php echo htmlspecialchars($itemData['item_name']); ?></td>
                                    <td class="px-4 py-4 text-center"><?php echo $itemData['volume_po'] . ' ' . $itemData['unit']; ?></td>
                                    <td class="px-4 py-2">
                                        <input type="number" class="form-input text-center py-2" value="<?php echo $itemData['volume_po']; ?>">
                                    </td>
                                    <td class="px-4 py-4 text-center text-red-600 font-medium">0</td>
                                    <td class="px-4 py-4 text-right"><?php echo formatRupiah($itemData['total_amount']); ?></td>
                                </tr>
                                </tbody>
                        </table>
                    </div>
                    
                    <div class="flex justify-end mt-8">
                        <div class="w-full md:w-96 space-y-4">
                            
                            <div class="flex justify-between items-center text-lg font-bold text-slate-800">
                                <span>Total Amount GR</span>
                                <span class="text-2xl text-indigo-700"><?php echo formatRupiah($itemData['total_amount']); ?></span>
                            </div>
                            
                            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-lg shadow-lg transition duration-200 flex items-center justify-center">
                                <i class="fas fa-check-circle mr-2"></i>
                                Submit & Masukkan Stok
                            </button>
                        </div>
                    </div>
                    
                </form>

            </div>
        </div>
    </main>
    
</body>
</html>