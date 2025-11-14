<?php
// pembuatan_po.php

// -----------------------------------------------------------
// Variabel Data Dummy & Konteks
$headerUser = [
    'name' => 'John Doe', // Untuk header
    'role' => 'Admin' // Untuk header
];

// Data Dummy dari Bidding yang disetujui
$prBiddingList = [
    'PR/PROC/X/25/0765 - Bearing 6205 ZZ - CV. Mitra Teknik', // PR yang disetujui
    'PR/PROC/X/25/0766 - Oli Mesin A - PT. Sinar Jaya Abadi',
    'PR/PROC/X/25/0767 - Filter Udara - UD. Barokah Sentosa',
];

// Tentukan tanggal hari ini untuk mengisi placeholder
$today = date('d/m/Y');
$expectedArrival = date('d/m/Y', strtotime('+7 days')); // Asumsi tiba 7 hari kemudian

// Data Detail PO yang akan dimuat
// Asumsi: memilih item pertama (CV. Mitra Teknik)
$detailPO = [
    'no_po' => 'PO/MT/X/25/0432',
    'vendor' => 'CV. Mitra Teknik',
    'item' => 'Bearing 6205 ZZ',
    'volume' => 10,
    'satuan' => 'Pcs',
    'hargaSatuan' => 52500, // Dari screenshot
    'tglPO' => $today, // Diperbaiki: Menggunakan tanggal hari ini
    'tglTiba' => $expectedArrival, // Diperbaiki: Menggunakan tanggal estimasi tiba
    'ppn_rate' => 0.11 // 11%
];

// Perhitungan Total
$subtotal = $detailPO['volume'] * $detailPO['hargaSatuan'];
$ppn = $subtotal * $detailPO['ppn_rate'];
$grandTotal = $subtotal + $ppn;


/**
 * Helper function untuk memformat mata uang.
 * Menggunakan if (!function_exists) untuk mencegah Fatal Error redeclare function.
 */
if (!function_exists('formatRupiah')) {
    function formatRupiah($number) {
        // Menggunakan "Rp " dan titik sebagai pemisah ribuan
        return 'Rp ' . number_format($number, 0, ',', '.');
    }
}

// Set halaman saat ini untuk penanda di sidebar
// Nama variabel ini harus cocok dengan yang digunakan di partials/sidebar.php
$currentPage = 'po-creation-page'; 

// -----------------------------------------------------------
// FUNGSI & LOGIKA SIDEBAR DIHAPUS DARI FILE INI DAN DIPINDAH KE partials/sidebar.php
// -----------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembuatan Purchase Order | Logistix</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* ---------------------------------
            GAYA KUSTOM FORMULIR & LAYOUT
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
        .form-static-bg {
            @apply bg-slate-100 border-slate-300 text-slate-800 font-semibold cursor-not-allowed;
        }
        .input-label {
             @apply block text-sm font-medium text-slate-500 mb-1;
        }
        
        /* Ikon Kalender/Chevron Down pada input */
        .input-icon-right {
            position: absolute; 
            right: 12px; 
            top: 50%; 
            transform: translateY(-50%); 
            color: #64748b; /* slate-500 */
            pointer-events: none;
        }

        /* Gaya Sidebar Aktif baru (Indigo-600) */
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
    // Variabel $currentPage harus sudah didefinisikan sebelumnya.
    // Kode ini diasumsikan berada di root yang sama dengan folder partials.
    include 'partials/sidebar.php'; 
    ?>

    <main class="flex-1 flex flex-col ml-64 w-full"> 

        <header class="bg-white shadow-md sticky top-0 z-10">
            <div class="max-w-full mx-auto px-8 py-3 flex justify-between items-center">
                <div class="text-xl font-semibold text-slate-700">
                    Pembuatan Purchase Order (PO)
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
                
                <h2 class="text-2xl font-semibold text-slate-800 mb-6">Pembuatan Purchase Order (PO)</h2>

                <div class="mb-8 p-4 border border-indigo-200 bg-indigo-50 rounded-lg">
                    <form action="#" method="GET" class="flex items-center space-x-4">
                        <label for="pr_released" class="font-medium text-slate-700 whitespace-nowrap">Pilih PR Released (Bidding Approved):</label>
                        <div class="relative w-full max-w-lg">
                            <select id="pr_released" name="pr_released" class="form-select pr-10 bg-white">
                                <?php foreach ($prBiddingList as $key => $prBidding): ?>
                                    <?php 
                                    // Logika untuk menandai pilihan yang sesuai, disini item pertama yang terpilih
                                    $isSelected = ($key === 0) ? 'selected' : ''; 
                                    ?>
                                    <option value="<?php echo htmlspecialchars($prBidding); ?>" <?php echo $isSelected; ?>>
                                        <?php echo htmlspecialchars($prBidding); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <i class="fa fa-chevron-down input-icon-right"></i>
                        </div>
                    </form>
                </div>
                <h3 class="text-xl font-bold text-slate-700 mb-6 border-b pb-2">Detail PO</h3>

                <form action="#" method="POST">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div>
                            <label for="no_po" class="input-label">No. PO</label>
                            <input 
                                type="text" 
                                id="no_po" 
                                name="no_po" 
                                value="<?php echo htmlspecialchars($detailPO['no_po']); ?>" 
                                readonly 
                                class="form-input form-static-bg"
                            >
                        </div>
                        <div>
                            <label for="vendor_name" class="input-label">Vendor</label>
                            <input 
                                type="text" 
                                id="vendor_name" 
                                name="vendor_name" 
                                value="<?php echo htmlspecialchars($detailPO['vendor']); ?>" 
                                readonly 
                                class="form-input form-static-bg"
                            >
                        </div>
                        <div>
                            <label for="tgl_po" class="input-label">Tanggal PO</label>
                            <div class="relative">
                                <input 
                                    type="text" 
                                    id="tgl_po" 
                                    name="tgl_po" 
                                    value="<?php echo htmlspecialchars($detailPO['tglPO']); ?>" 
                                    class="form-input pr-10"
                                    placeholder="dd/mm/yyyy"
                                >
                                <i class="fa fa-calendar-alt input-icon-right"></i>
                            </div>
                        </div>
                        <div>
                            <label for="tgl_tiba" class="input-label">Tgl Diharapkan Tiba</label>
                            <div class="relative">
                                <input 
                                    type="text" 
                                    id="tgl_tiba" 
                                    name="tgl_tiba" 
                                    value="<?php echo htmlspecialchars($detailPO['tglTiba']); ?>" 
                                    class="form-input pr-10"
                                    placeholder="dd/mm/yyyy"
                                >
                                <i class="fa fa-calendar-alt input-icon-right"></i>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto mb-8">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead>
                                <tr class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">
                                    <th class="px-4 py-3">Item</th>
                                    <th class="px-4 py-3 text-center">Volume</th>
                                    <th class="px-4 py-3 text-right">Harga Satuan</th>
                                    <th class="px-4 py-3 text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                <tr class="bg-white text-slate-700">
                                    <td class="px-4 py-3 font-medium"><?php echo htmlspecialchars($detailPO['item']); ?></td>
                                    <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($detailPO['volume']) . ' ' . htmlspecialchars($detailPO['satuan']); ?></td>
                                    <td class="px-4 py-3 text-right"><?php echo formatRupiah($detailPO['hargaSatuan']); ?></td>
                                    <td class="px-4 py-3 text-right"><?php echo formatRupiah($subtotal); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-end">
                        <div class="w-full max-w-md space-y-2">
                            <div class="flex justify-between text-slate-700">
                                <span>Subtotal</span>
                                <span class="font-medium"><?php echo formatRupiah($subtotal); ?></span>
                            </div>
                            <div class="flex justify-between text-slate-700 border-b pb-2">
                                <span>PPN 11%</span>
                                <span class="font-medium"><?php echo formatRupiah($ppn); ?></span>
                            </div>
                            <div class="flex justify-between text-2xl font-bold text-indigo-700 pt-2">
                                <span>Grand Total</span>
                                <span><?php echo formatRupiah($grandTotal); ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end mt-10">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-8 rounded-lg shadow-xl transition duration-200 flex items-center">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Buat & Kirim PO
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    
</body>
</html>