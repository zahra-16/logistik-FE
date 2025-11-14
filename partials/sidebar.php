<?php 
// partials/sidebar.php

// Pastikan $currentPage telah didefinisikan. Jika tidak, default ke string kosong.
if (!isset($currentPage)) {
    $currentPage = '';
}

// Fungsi untuk mendapatkan ikon berdasarkan nama item (Hanya untuk estetika)
function getMenuIcon($name) {
    switch ($name) {
        case 'item': return '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10m-8-4l8 4"/></svg>'; // Box
        case 'warehouse': return '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m-3 0v-5a2 2 0 012-2h2a2 2 0 012 2v5M7 1h10"/></svg>'; // Building
        case 'department': return '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20v-2c0-.656-.126-1.283-.356-1.857M9.758 12A2.25 2.25 0 0012 9.75h1.5a2.25 2.25 0 002.25-2.25V6.75a2.25 2.25 0 00-2.25-2.25H12a2.25 2.25 0 00-2.25 2.25v.75m-6 3l10 5m-10-5h8m-5 0V7a3 3 0 00-3-3H4a2 2 0 00-2 2v12a2 2 0 002 2h4a3 3 0 003-3v-2.25z"/></svg>'; // Users & Gear
        case 'vendor': return '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>'; // Credit Card
        case 'pr_form': return '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>'; // Document
        case 'approval': return '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'; // Checkmark
        case 'bidding': return '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>'; // Pencil/Edit
        case 'po_creation': return '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M16 10H8m2.094-3.094l2 2 2-2"/></svg>'; // Cart
        case 'goods_receipt': return '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L8 8m9 4v7M7 8h10M7 16h10"/></svg>'; // Delivery Box
        default: return '';
    }
}
?>

<aside class="w-64 bg-slate-800 text-slate-300 flex flex-col fixed h-full z-20">
    <div class="p-6 text-white text-2xl font-bold border-b border-slate-700">
        <span class="text-indigo-400">LOGIS</span><span>TIX</span>
    </div>
    
    <nav class="flex-1 px-4 py-6 space-y-2 custom-scrollbar-hide overflow-y-auto"> 
        
        <!-- MAIN LINKS -->
        <a href="dashboard.php" class="sidebar-link flex items-center px-4 py-2 rounded-lg hover:bg-slate-700 transition duration-150 <?php echo ($currentPage == 'dashboard' ? 'active' : ''); ?>" data-target="dashboard-page">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" /></svg>
            Dashboard
        </a>
        
        <a href="manajemen_user.php" class="sidebar-link flex items-center px-4 py-2 rounded-lg hover:bg-slate-700 transition duration-150 <?php echo ($currentPage == 'manajemen_user' ? 'active' : ''); ?>" data-target="manajemen_user-page">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
            Manajemen User
        </a>
        
        <!-- MASTER DATA -->
        <div>
            <h3 class="px-4 py-2 text-xs font-semibold text-slate-500 uppercase tracking-wider mt-4">Master Data</h3>
            <div class="space-y-2 mt-1">
                <a href="data_item.php" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150" data-target="item-data-page">
                    <span class="text-indigo-300 mr-2"><?php echo getMenuIcon('item'); ?></span> Data Item
                </a>
                <a href="data_gudang.php" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150" data-target="warehouse-data-page">
                    <span class="text-indigo-300 mr-2"><?php echo getMenuIcon('warehouse'); ?></span> Data Gudang
                </a>
                <a href="departemen_divisi.php" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150" data-target="department-data-page">
                    <span class="text-indigo-300 mr-2"><?php echo getMenuIcon('department'); ?></span> Departemen & Divisi
                </a>
                <a href="data_vendor.php" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150" data-target="vendor-data-page">
                    <span class="text-indigo-300 mr-2"><?php echo getMenuIcon('vendor'); ?></span> Data Vendor
                </a>
            </div>
        </div>

        <!-- PENGADAAN -->
        <div>
            <h3 class="px-4 py-2 text-xs font-semibold text-slate-500 uppercase tracking-wider mt-4">Pengadaan</h3>
            <div class="space-y-2 mt-1">
                <a href="purchase_request.php" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150" data-target="pr-form-page">
                    <span class="text-indigo-300 mr-2"><?php echo getMenuIcon('pr_form'); ?></span> Purchase Request (PR)
                </a>
                <a href="persetujuan_pr.php" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150" data-target="pr-approval-page">
                    <span class="text-indigo-300 mr-2"><?php echo getMenuIcon('approval'); ?></span> Persetujuan PR
                </a>
                <a href="proses_bidding_pr.php" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150" data-target="pr-bidding-page">
                    <span class="text-indigo-300 mr-2"><?php echo getMenuIcon('bidding'); ?></span> Proses Bidding PR
                </a>
                <a href="pembuatan_po.php" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150" data-target="po-creation-page">
                    <span class="text-indigo-300 mr-2"><?php echo getMenuIcon('po_creation'); ?></span> Pembuatan PO
                </a>
            </div>
        </div>

        <!-- PENERIMAAN -->
        <div>
            <h3 class="px-4 py-2 text-xs font-semibold text-slate-500 uppercase tracking-wider mt-4">Penerimaan</h3>
            <div class="space-y-2 mt-1">
                <a href="goods_receipt.php" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150" data-target="goods-receipt-page">
                    <span class="text-indigo-300 mr-2"><?php echo getMenuIcon('goods_receipt'); ?></span> Goods Receipt (GR)
                </a>
            </div>
        </div>
    </nav>
</aside>
