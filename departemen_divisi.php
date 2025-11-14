<?php
// departemen_divisi.php

// -----------------------------------------------------------
// Variabel Data Dummy
$headerUser = [
    'name' => 'John Doe', 
    'role' => 'Admin'
];

// Data Dummy untuk Tabel Departemen
$departments = [
    ['id' => 'DEPT-01', 'name' => 'Finance & Accounting', 'division_count' => 3, 'description' => 'Mengelola semua transaksi keuangan dan pelaporan.', 'status' => 'Aktif'],
    ['id' => 'DEPT-02', 'name' => 'Supply Chain Management', 'division_count' => 2, 'description' => 'Mengawasi rantai pasokan dan logistik.', 'status' => 'Aktif'],
    ['id' => 'DEPT-03', 'name' => 'Human Resources', 'division_count' => 1, 'description' => 'Mengelola sumber daya manusia dan administrasi umum.', 'status' => 'Aktif'],
];

// Data Dummy untuk Tabel Divisi (Contoh untuk Departemen Finance)
$divisions = [
    ['id' => 'DIV-FN-01', 'department_id' => 'DEPT-01', 'department_name' => 'Finance & Accounting', 'name' => 'Financial Reporting', 'description' => 'Membuat laporan keuangan triwulanan.', 'status' => 'Aktif'],
    ['id' => 'DIV-FN-02', 'department_id' => 'DEPT-01', 'department_name' => 'Finance & Accounting', 'name' => 'Taxation', 'description' => 'Mengurus kepatuhan pajak perusahaan.', 'status' => 'Aktif'],
    ['id' => 'DIV-SC-01', 'department_id' => 'DEPT-02', 'department_name' => 'Supply Chain Management', 'name' => 'Procurement', 'description' => 'Unit pengadaan barang dan jasa.', 'status' => 'Aktif'],
];

// Set halaman saat ini agar sidebar tahu mana yang harus diaktifkan.
$currentPage = 'departemen_divisi.php'; 
// -----------------------------------------------------------

// Fungsi untuk mendapatkan ikon (fungsi ini WAJIB ada di setiap file PHP yang menggunakan sidebar)
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
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Departemen & Divisi | Logistix</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 
    
    <style>
        /* Styles CSS yang sama dari file data_gudang.php */
        :root { --primary-color: #4e73df; --sidebar-bg: #2c3e50; }
        body { font-family: 'Inter', sans-serif; }
        /* Menggunakan z-50 pada sidebar agar tidak tertutup header sticky */
        .sidebar-custom { width: 16rem; background-color: var(--sidebar-bg); color: var(--light-text-color); padding: 1rem 0; min-height: 100vh; position: fixed; top: 0; left: 0; z-index: 50; } 
        .sidebar-link.active, .master-data-link.active { background-color: #4f46e5; color: #ffffff; font-weight: 600; }
        .sidebar-link:not(.active):hover, .master-data-link:not(.active):hover { background-color: #334155; }
        .custom-scrollbar-hide { -ms-overflow-style: none !important; scrollbar-width: none !important; }
        .custom-scrollbar-hide::-webkit-scrollbar { display: none !important; width: 0 !important; height: 0 !important; }
        .main-content-wrapper { margin-left: 16rem; flex-grow: 1; display: flex; flex-direction: column; width: calc(100% - 16rem); min-height: 100vh; }
        .tab-button.active { border-bottom: 3px solid #4f46e5; color: #4f46e5; font-weight: 600; }
        .status-aktif { background-color: #d1fae5; color: #059669; padding: 2px 8px; border-radius: 9999px; font-size: 0.75rem; font-weight: 500; }
        
        /* Gaya baru untuk form seperti di gambar */
        .form-card { 
            background-color: white; 
            border-radius: 0.75rem; /* rounded-xl */
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1); /* shadow-md */
            padding: 1.5rem; /* p-6 */
        }
        .form-title {
            color: #1e293b; /* text-slate-800 */
            font-size: 1.5rem; /* text-2xl */
            font-weight: 700; /* font-bold */
        }
    </style>
</head>
<body class="bg-slate-100"> 
    
    <aside class="w-64 bg-slate-800 text-slate-300 flex flex-col fixed h-full z-50">
        <div class="p-6 text-white text-2xl font-bold border-b border-slate-700">
            <span class="text-indigo-400">LOGIS</span><span>TIX</span>
        </div>
        
        <nav class="flex-1 px-4 py-6 space-y-2 custom-scrollbar-hide overflow-y-auto"> 
            
            <a href="dashboard.php" class="sidebar-link flex items-center px-4 py-2 rounded-lg hover:bg-slate-700 transition duration-150 <?php echo ($currentPage == 'dashboard.php' ? 'active' : ''); ?>" data-target="dashboard-page">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" /></svg>
                Dashboard
            </a>
            
            <a href="manajemen_user.php" class="sidebar-link flex items-center px-4 py-2 rounded-lg hover:bg-slate-700 transition duration-150 <?php echo ($currentPage == 'manajemen_user.php' ? 'active' : ''); ?>" data-target="manajemen_user-page">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                Manajemen User
            </a>
            
            <div>
                <h3 class="px-4 py-2 text-xs font-semibold text-slate-500 uppercase tracking-wider mt-4">Master Data</h3>
                <div class="space-y-2 mt-1">
                    <a href="data_item.php" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150 <?php echo ($currentPage == 'data_item.php' ? 'active' : ''); ?>" data-target="item-data-page">
                        <span class="text-indigo-300 mr-2"><?php echo getMenuIcon('item'); ?></span> Data Item
                    </a>
                    <a href="data_gudang.php" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150 <?php echo ($currentPage == 'data_gudang.php' ? 'active' : ''); ?>" data-target="warehouse-data-page">
                        <span class="text-indigo-300 mr-2"><?php echo getMenuIcon('warehouse'); ?></span> Data Gudang
                    </a>
                    <a href="departemen_divisi.php" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150 <?php echo ($currentPage == 'departemen_divisi.php' ? 'active' : ''); ?>" data-target="department-data-page">
                        <span class="text-indigo-300 mr-2"><?php echo getMenuIcon('department'); ?></span> Departemen & Divisi**
                    </a>
                    <a href="data_vendor.php" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150 <?php echo ($currentPage == 'data_vendor.php' ? 'active' : ''); ?>" data-target="vendor-data-page">
                        <span class="text-indigo-300 mr-2"><?php echo getMenuIcon('vendor'); ?></span> Data Vendor
                    </a>
                </div>
            </div>

            <div>
                <h3 class="px-4 py-2 text-xs font-semibold text-slate-500 uppercase tracking-wider mt-4">Pengadaan</h3>
                <div class="space-y-2 mt-1">
                    <a href="#" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150 <?php echo ($currentPage == 'pr_form.php' ? 'active' : ''); ?>" data-target="pr-form-page">
                        <span class="text-indigo-300 mr-2"><?php echo getMenuIcon('pr_form'); ?></span> Purchase Request (PR)
                    </a>
                    <a href="#" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150 <?php echo ($currentPage == 'pr_approval.php' ? 'active' : ''); ?>" data-target="pr-approval-page">
                        <span class="text-indigo-300 mr-2"><?php echo getMenuIcon('approval'); ?></span> Persetujuan PR
                    </a>
                    <a href="#" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150 <?php echo ($currentPage == 'pr_bidding.php' ? 'active' : ''); ?>" data-target="pr-bidding-page">
                        <span class="text-indigo-300 mr-2"><?php echo getMenuIcon('bidding'); ?></span> Proses Bidding PR
                    </a>
                    <a href="#" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150 <?php echo ($currentPage == 'po_creation.php' ? 'active' : ''); ?>" data-target="po-creation-page">
                        <span class="text-indigo-300 mr-2"><?php echo getMenuIcon('po_creation'); ?></span> Pembuatan PO
                    </a>
                </div>
            </div>

            <div>
                <h3 class="px-4 py-2 text-xs font-semibold text-slate-500 uppercase tracking-wider mt-4">Penerimaan</h3>
                <div class="space-y-2 mt-1">
                    <a href="#" class="sidebar-link flex items-center pl-6 pr-4 py-2 rounded-lg text-sm hover:bg-slate-700 transition duration-150 <?php echo ($currentPage == 'goods_receipt.php' ? 'active' : ''); ?>" data-target="goods-receipt-page">
                        <span class="text-indigo-300 mr-2"><?php echo getMenuIcon('goods_receipt'); ?></span> Goods Receipt (GR)
                    </a>
                </div>
            </div>
        </nav>
    </aside>
    <div class="main-content-wrapper"> 
        
        <header class="bg-white shadow-sm border-b border-slate-200 sticky top-0 z-10 h-20"> 
            <div class="flex justify-between items-center h-full px-8">
                <h1 class="text-xl font-semibold text-slate-900">Departemen & Divisi</h1>
                
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
            
            <div id="department-data-page" class="page-content">
                
                <div class="flex justify-between items-center mb-6">
                    <h2 class="form-title">Master Departemen & Divisi</h2>
                    <button onclick="console.log('Fungsi Tambah Data Dipanggil')" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
                        Tambah Data
                    </button>
                </div>

                <div class="form-card">
                    <form id="inline-form" onsubmit="event.preventDefault(); saveDepartment();">
                        <div class="grid grid-cols-3 gap-6">
                            <div>
                                <label for="form-id" class="block text-sm font-medium text-slate-700 mb-1">No. ID</label>
                                <input type="text" id="form-id" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm text-base text-slate-900" value="DPT-005" readonly>
                            </div>
                            <div>
                                <label for="form-code" class="block text-sm font-medium text-slate-700 mb-1">Kode</label>
                                <input type="text" id="form-code" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-base" placeholder="Contoh: FIN" required>
                            </div>
                            <div>
                                <label for="form-name" class="block text-sm font-medium text-slate-700 mb-1">Nama</label>
                                <input type="text" id="form-name" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-base" placeholder="Departemen atau Divisi" required>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
                
                <div id="content-department" class="tab-content hidden">
                    </div>

                <div id="content-division" class="tab-content hidden">
                    </div>

                <div class="bg-white rounded-xl shadow-md mb-6 hidden">
                    <div class="flex border-b border-slate-200 p-2">
                        <button id="tab-dept" class="tab-button active px-4 py-2 text-slate-600 transition-colors duration-200" onclick="switchTab('department')">Departemen</button>
                        <button id="tab-div" class="tab-button px-4 py-2 text-slate-600 transition-colors duration-200" onclick="switchTab('division')">Divisi</button>
                    </div>
                </div>

            </div>
            
        </main>
        </div>

    <div id="department-modal" class="fixed inset-0 bg-slate-900 bg-opacity-50 z-[100] hidden flex items-center justify-center p-4">
        </div>

    <div id="division-modal" class="fixed inset-0 bg-slate-900 bg-opacity-50 z-[100] hidden flex items-center justify-center p-4">
        </div>

    <script>
        // Memastikan fungsi-fungsi yang sudah ada tetap didefinisikan
        function switchTab(tabName) {
            // Fungsi ini sekarang tidak melakukan apa-apa karena tabel disembunyikan
            console.log(`Tab switch simulated for: ${tabName}`);
        }

        function showDepartmentModal(isEdit = false, id = null) {
            // Modal disembunyikan, fungsi dialihkan ke console log saja
            console.log('Simulasi memanggil Modal Departemen (saat ini form menggunakan layout inline)');
        }

        function closeDepartmentModal() {
            console.log('Simulasi menutup Modal Departemen');
        }

        function showDivisionModal(isEdit = false, id = null) {
            console.log('Simulasi memanggil Modal Divisi (saat ini form menggunakan layout inline)');
        }

        function closeDivisionModal() {
            console.log('Simulasi menutup Modal Divisi');
        }

        // Fungsi Simulasi Aksi
        function saveDepartment() {
            alert('Data form inline berhasil disimpan secara simulasi.');
            document.getElementById('inline-form').reset();
        }

        function saveDivision() {
            console.log('Divisi berhasil disimpan.');
            closeDivisionModal();
        }

        function editDepartment(id) {
            console.log(`Simulasi Edit Departemen ID: ${id}`);
        }
        
        function editDivision(id) {
            console.log(`Simulasi Edit Divisi ID: ${id}`);
        }

        function deleteData(id) {
            // Simulasi konfirmasi dan penghapusan
            if (confirm(`Apakah Anda yakin ingin menghapus data dengan ID: ${id}?`)) {
                 console.log(`Data ID: ${id} telah dihapus.`);
            }
        }
    </script>
</body>
</html>