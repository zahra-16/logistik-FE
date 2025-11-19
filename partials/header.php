<?php
// ===============================
// partials/header.php (NEW STYLE)
// ===============================

// Helper: ambil inisial user
function getInitials($name) {
    $words = preg_split('/\s+/', trim($name));
    if (count($words) === 0) return "?";
    $initials = strtoupper(substr($words[0], 0, 1));
    if (count($words) > 1) {
        $initials .= strtoupper(substr(end($words), 0, 1));
    }
    return $initials;
}

// Default user (fallback)
$headerUser = $headerUser ?? ['name' => 'Pengguna Tamu', 'role' => 'Guest'];
$initials   = getInitials($headerUser['name']);

// Judul otomatis berdasarkan halaman
$title = "Dashboard";
$pageTitles = [
    'dashboard'        => 'Dashboard',
    'manajemen_user'   => 'Manajemen User',

    'data-item'        => 'Data Item',
    'data_gudang.php'  => 'Data Gudang',
    'departemen_divisi.php' => 'Departemen & Divisi',
    'data_vendor.php'   => 'Data Vendor',
    
    'purchase_request' => 'Purchase Request',
    'persetujuan_pr'   => 'Persetujuan PR',
    'pr-bidding-page'  => 'Proses Bidding PR',
    'pembuatan_po'     => 'Pembuatan PO',
    
    'goods-receipt-page' => 'Goods Receipt',

    'users'            => 'Manajemen User',
    'settings'         => 'Pengaturan',
];

if (isset($currentPage) && array_key_exists($currentPage, $pageTitles)) {
    $title = $pageTitles[$currentPage];
}
?>

<header class="bg-white shadow-sm border-b border-slate-200 sticky top-0 z-10 h-20">
    <div class="flex justify-between items-center h-full px-8">

        <!-- Page Title -->
        <h1 class="text-xl font-semibold text-slate-900">
            <?= htmlspecialchars($title); ?>
        </h1>

        <!-- Search + User -->
        <div class="flex items-center space-x-6">

            <!-- Search -->
            <div class="relative">
                <input 
                    type="text" 
                    placeholder="Cari..." 
                    class="py-2 pl-4 pr-10 border border-slate-300 rounded-lg text-sm w-48 focus:ring-2 focus:ring-indigo-500"
                >
                <i class="fas fa-search absolute right-3 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
            </div>

            <!-- User Avatar + Info -->
            <div class="flex items-center space-x-2 cursor-pointer">
                <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-white font-semibold text-sm">
                    <?= htmlspecialchars($initials); ?>
                </div>
                <div class="text-right">
                    <p class="text-sm font-medium text-slate-700 leading-none">
                        <?= htmlspecialchars($headerUser['name']); ?>
                    </p>
                    <p class="text-xs text-slate-500">
                        <?= htmlspecialchars($headerUser['role']); ?>
                    </p>
                </div>
            </div>

        </div>
    </div>
</header>
