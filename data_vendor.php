<?php
// data_vendor.php

// -----------------------------------------------------------
// Variabel Data Dummy 
$headerUser = [
    'name' => 'John Doe',
    'role' => 'Admin'   
];

// Data default untuk form Vendor
$vendorData = [
    'id' => 'VND-0891', // No. Vendor statis seperti pada gambar
];

// Set halaman saat ini agar sidebar tahu mana yang harus diaktifkan.
$currentPage = 'data_vendor.php'; 
// -----------------------------------------------------------

// Fungsi untuk mendapatkan ikon berdasarkan nama item (Hanya untuk estetika)
function getMenuIcon($name) {
    switch ($name) {
        case 'item': return '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10m-8-4l8 4"/></svg>';
        case 'warehouse': return '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m-3 0v-5a2 2 0 012-2h2a2 2 0 012 2v5M7 1h10"/></svg>';
        case 'department': return '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20v-2c0-.656-.126-1.283-.356-1.857M9.758 12A2.25 2.25 0 0012 9.75h1.5a2.25 2.25 0 002.25-2.25V6.75a2.25 2.25 0 00-2.25-2.25H12a2.25 2.25 0 00-2.25 2.25v.75m-6 3l10 5m-10-5h8m-5 0V7a3 3 0 00-3-3H4a2 2 0 00-2 2v12a2 2 0 002 2h4a3 3 0 003-3v-2.25z"/></svg>';
        case 'vendor': return '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>';
        case 'pr_form': return '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>';
        case 'approval': return '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
        case 'bidding': return '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>';
        case 'po_creation': return '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M16 10H8m2.094-3.094l2 2 2-2"/></svg>';
        case 'goods_receipt': return '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L8 8m9 4v7M7 8h10M7 16h10"/></svg>';
        default: return '';
    }
}

// Fungsi sidebar (dipindahkan dari file departemen_divisi.php agar mandiri)
function renderSidebar($currentPage) {
    
    // Pastikan $currentPage telah didefinisikan. Jika tidak, default ke string kosong.
    if (!isset($currentPage)) {
        $currentPage = '';
    }

    $sidebar = '
    <aside class="w-64 bg-slate-800 text-slate-300 flex flex-col fixed h-full z-20">
        <div class="p-6 text-white text-2xl font-bold border-b border-slate-700">
            <span class="text-indigo-400">LOGIS</span><span>TIX</span>
        </div>
        
        <nav class="flex-1 px-4 py-6 space-y-2 custom-scrollbar-hide overflow-y-auto"> 
            
            <a href="dashboard.php" class="sidebar-link flex items-center px-4 py-2 rounded-lg hover:bg-slate-700 transition duration-150 ' . ($currentPage == 'dashboard.php' ? 'active' : '') . '" data-target="dashboard-page">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" /></svg>
                Dashboard
            </a>
            
            <a href="manajemen_user.php" class="sidebar-link flex items-center px-4 py-2 rounded-lg hover:bg-slate-700 transition duration-150 ' . ($currentPage == 'manajemen_user.php' ? 'active' : '') . '" data-target="manajemen_user-page">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                Manajemen User
            </a>
            
            <div>
                <h3 class="px-4 py-2 text-xs font-semibold text-slate-500 uppercase tracking-wider mt-4">Master Data</h3>
                <div class="space-y-2 mt-1">
                    <a href="data_item.php" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150 ' . ($currentPage == 'data_item.php' ? 'active' : '') . '" data-target="item-data-page">
                        <span class="text-indigo-300 mr-2">' . getMenuIcon('item') . '</span> Data Item
                    </a>
                    <a href="data_gudang.php" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150 ' . ($currentPage == 'data_gudang.php' ? 'active' : '') . '" data-target="warehouse-data-page">
                        <span class="text-indigo-300 mr-2">' . getMenuIcon('warehouse') . '</span> Data Gudang
                    </a>
                    <a href="departemen_divisi.php" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150 ' . ($currentPage == 'departemen_divisi.php' ? 'active' : '') . '" data-target="department-data-page">
                        <span class="text-indigo-300 mr-2">' . getMenuIcon('department') . '</span> Departemen & Divisi
                    </a>
                    <a href="data_vendor.php" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150 ' . ($currentPage == 'data_vendor.php' ? 'active' : '') . '" data-target="vendor-data-page">
                        <span class="text-indigo-300 mr-2">' . getMenuIcon('vendor') . '</span> Data Vendor
                    </a>
                </div>
            </div>

            <div>
                <h3 class="px-4 py-2 text-xs font-semibold text-slate-500 uppercase tracking-wider mt-4">Pengadaan</h3>
                <div class="space-y-2 mt-1">
                    <a href="purchase_request.php" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150 ' . ($currentPage == 'purchase_request.php' ? 'active' : '') . '" data-target="pr-form-page">
                        <span class="text-indigo-300 mr-2">' . getMenuIcon('pr_form') . '</span> Purchase Request (PR)
                    </a>
                    <a href="persetujuan_pr.php" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150 ' . ($currentPage == 'persetujuan_pr.php' ? 'active' : '') . '" data-target="pr-approval-page">
                        <span class="text-indigo-300 mr-2">' . getMenuIcon('approval') . '</span> Persetujuan PR
                    </a>
                    <a href="proses_bidding_pr.php" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150 ' . ($currentPage == 'proses_bidding_pr.php' ? 'active' : '') . '" data-target="pr-bidding-page">
                        <span class="text-indigo-300 mr-2">' . getMenuIcon('bidding') . '</span> Proses Bidding PR
                    </a>
                    <a href="pembuatan_po.php" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150 ' . ($currentPage == 'pembuatan_po.php' ? 'active' : '') . '" data-target="po-creation-page">
                        <span class="text-indigo-300 mr-2">' . getMenuIcon('po_creation') . '</span> Pembuatan PO
                    </a>
                </div>
            </div>

            <div>
                <h3 class="px-4 py-2 text-xs font-semibold text-slate-500 uppercase tracking-wider mt-4">Penerimaan</h3>
                <div class="space-y-2 mt-1">
                    <a href="goods_receipt.php" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150 ' . ($currentPage == 'goods_receipt.php' ? 'active' : '') . '" data-target="goods-receipt-page">
                        <span class="text-indigo-300 mr-2">' . getMenuIcon('goods_receipt') . '</span> Goods Receipt (GR)
                    </a>
                </div>
            </div>
        </nav>
    </aside>
    ';
    return $sidebar;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Data Vendor | Logistix</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 
    
    <style>
        /* Variabel CSS */
        :root {
            --primary-color: #4e73df;
            --sidebar-bg: #2c3e50;
        }

        /* Font body */
        body {
            font-family: 'Inter', sans-serif;
        }
        
        /* GAYA UNTUK TAUTAN AKTIF/HOVER */
        .sidebar-link.active, .master-data-link.active {
            background-color: #4f46e5; /* indigo-600 */
            color: #ffffff;
            font-weight: 600;
        }
        .sidebar-link:not(.active):hover, .master-data-link:not(.active):hover {
            background-color: #334155; /* slate-700 */
        }

        /* Layout Fixes */
        .custom-scrollbar-hide {
            -ms-overflow-style: none !important;  
            scrollbar-width: none !important;  
        }
        .custom-scrollbar-hide::-webkit-scrollbar {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }
        .main-content-wrapper {
            margin-left: 16rem; 
            flex-grow: 1; 
            display: flex;
            flex-direction: column;
            width: calc(100% - 16rem);
            min-height: 100vh;
        }
    </style>
</head>
<body class="bg-slate-100"> 
    
    <?php echo renderSidebar($currentPage); // Tampilkan Sidebar ?>

    <div class="main-content-wrapper"> 
        
        <header class="bg-white shadow-sm border-b border-slate-200 sticky top-0 z-10 h-20"> 
            <div class="flex justify-between items-center h-full px-8">
                <h1 class="text-xl font-semibold text-slate-900">Master Vendor</h1>
                
                <div class="flex items-center space-x-6">
                    <div class="relative">
                        <input type="text" placeholder="Cari..." class="py-2 pl-4 pr-10 border border-slate-300 rounded-lg focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm w-48">
                        <i class="fas fa-search absolute right-3 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                    </div>
                    
                    <div class="flex items-center space-x-2 cursor-pointer">
                        <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-white font-semibold text-sm">
                            JD
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-slate-700 leading-none"><?php echo htmlspecialchars($headerUser['name']); ?></p>
                            <p class="text-xs text-slate-500"><?php echo htmlspecialchars($headerUser['role']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <main class="p-8 flex-1">
            
            <div id="vendor-data-page" class="page-content">
                
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-slate-800">Master Data Vendor</h2>
                    <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">Tambah Vendor</button>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-md">
                    <form class="space-y-6">
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="vendor-no" class="block text-sm font-medium text-slate-700">No. Vendor</label>
                                <input type="text" id="vendor-no" class="mt-1 block w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-md shadow-sm" value="<?php echo htmlspecialchars($vendorData['id']); ?>" readonly>
                            </div>
                            <div>
                                <label for="vendor-name" class="block text-sm font-medium text-slate-700">Nama Vendor</label>
                                <input type="text" id="vendor-name" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label for="vendor-badan-usaha" class="block text-sm font-medium text-slate-700">Badan Usaha</label>
                                <select id="vendor-badan-usaha" class="mt-1 block w-full px-3 py-2 border border-slate-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                    <option>PT</option><option>CV</option><option>Individual</option>
                                </select>
                            </div>
                        </div>
                        
                        <div>
                             <label for="vendor-alamat" class="block text-sm font-medium text-slate-700">Alamat Vendor</label>
                             <textarea id="vendor-alamat" rows="3" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="vendor-nib" class="block text-sm font-medium text-slate-700">NIB</label>
                                <input type="text" id="vendor-nib" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label for="vendor-npwp" class="block text-sm font-medium text-slate-700">NPWP</label>
                                <input type="text" id="vendor-npwp" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                 <label class="block text-sm font-medium text-slate-700">PKP</label>
                                 <div class="mt-2 flex items-center space-x-4">
                                     <label class="inline-flex items-center"><input type="radio" name="pkp" value="Ya" class="form-radio text-indigo-600"> <span class="ml-2">Ya</span></label>
                                     <label class="inline-flex items-center"><input type="radio" name="pkp" value="Tidak" class="form-radio text-indigo-600" checked> <span class="ml-2">Tidak</span></label>
                                 </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 border-t pt-6">
                             <div>
                                <label for="vendor-penanggung-jawab" class="block text-sm font-medium text-slate-700">Penanggung Jawab</label>
                                <input type="text" id="vendor-penanggung-jawab" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label for="vendor-jabatan" class="block text-sm font-medium text-slate-700">Jabatan</label>
                                <input type="text" id="vendor-jabatan" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label for="vendor-sales" class="block text-sm font-medium text-slate-700">Nama Sales</label>
                                <input type="text" id="vendor-sales" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label for="vendor-telp" class="block text-sm font-medium text-slate-700">No. Telp/HP</label>
                                <input type="text" id="vendor-telp" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div class="md:col-span-2">
                                <label for="vendor-email" class="block text-sm font-medium text-slate-700">Alamat Email</label>
                                <input type="email" id="vendor-email" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>
                        
                        <div class="pt-4 text-right">
                             <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">Simpan Vendor</button>
                        </div>
                    </form>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-md mt-8">
                    <h3 class="text-xl font-semibold text-slate-700 mb-4">Data Vendor Tersimpan</h3>
                    
                    <div class="flex justify-between items-center mb-4">
                        <input type="text" placeholder="Cari Kode atau Nama Vendor..." class="py-2 px-3 border border-slate-300 rounded-md shadow-sm text-sm w-64 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <select class="py-2 px-3 border border-slate-300 rounded-md shadow-sm text-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option>Tampilkan 10</option>
                            <option>Tampilkan 25</option>
                        </select>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">No. Vendor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Nama Vendor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Badan Usaha</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">NPWP/PKP</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-200 text-slate-700">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">VND-0801</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">PT Solusi Prima</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">PT</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">PKP</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
                                        <button class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-900" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">VND-0802</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">CV Jaya Abadi</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">CV</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Non-PKP</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
                                        <button class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-900" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4 flex justify-between items-center text-sm text-slate-600">
                        <div>Menampilkan 1 sampai 10 dari 25 data</div>
                        <div class="space-x-1">
                            <button class="px-3 py-1 border border-slate-300 rounded-md hover:bg-slate-100">Sebelumnya</button>
                            <button class="px-3 py-1 border border-indigo-600 bg-indigo-600 text-white rounded-md">1</button>
                            <button class="px-3 py-1 border border-slate-300 rounded-md hover:bg-slate-100">2</button>
                            <button class="px-3 py-1 border border-slate-300 rounded-md hover:bg-slate-100">Selanjutnya</button>
                        </div>
                    </div>
                </div>
                </div>
            </main>
        
    </div>
    
</body>
</html>