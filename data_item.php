<?php
// data_item.php

// -----------------------------------------------------------
// Variabel Data Dummy (Untuk simulasi data header dan form)
$headerUser = [
    'name' => 'John Doe', // Untuk header
    'role' => 'Admin'     // Untuk header
];

// Data default untuk form Item
$itemData = [
    'item_id' => 'ITM-00123',
    'group_options' => [
        'Bahan Baku' => 'selected', // Nilai default
        'ATK' => '', 
        'Sparepart' => ''
    ],
    'class_options' => [
        'Bahan Kimia' => 'selected', // Nilai default
        'Elektronik' => '', 
        'Kertas' => ''
    ],
    'category_options' => [
        'Inventory' => 'selected', // Nilai default
        'Expenses' => '', 
        'Asset' => ''
    ]
];
// -----------------------------------------------------------

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Data Item | Logistix</title>
    
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
        
        /* GAYA KUSTOM UNTUK SIDEBAR CONTAINER */
        .sidebar-custom {
            width: 16rem; /* ml-64 (256px) */
            background-color: var(--sidebar-bg);
            color: var(--light-text-color);
            padding: 1rem 0;
            min-height: 100vh;
            position: fixed; 
            top: 0;
            left: 0;
            z-index: 20;
        }

        /* GAYA UNTUK TAUTAN AKTIF/HOVER (Sesuai permintaan) */
        .sidebar-link.active {
            background-color: #4f46e5; /* indigo-600 */
            color: #ffffff;
            font-weight: 600;
        }
        .sidebar-link:not(.active):hover {
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
            min-height: 100vh; /* Agar main content penuh */
        }
        
    </style>
</head>
<body class="bg-slate-100"> 
    
    <?php 
        // Set halaman saat ini agar sidebar.php tahu mana yang harus diaktifkan
        $currentPage = 'item-data.php'; 
        include 'partials/sidebar.php'; 
    ?> 

    <div class="main-content-wrapper"> 
        
        <?php 
            include 'partials/header.php'; 
        ?>

        <main class="p-8 flex-1">
            
            <div id="item-data-page" class="page-content">
                
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-slate-800">Master Data Item</h2> 
                    
                    <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">Tambah Item</button>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-md">
                    <form class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div>
                            <label for="item-id" class="block text-sm font-medium text-slate-700">No. ID Item</label>
                            <input type="text" id="item-id" class="mt-1 block w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="<?php echo htmlspecialchars($itemData['item_id']); ?>" readonly>
                        </div>
                        <div>
                            <label for="item-name" class="block text-sm font-medium text-slate-700">Nama Item</label>
                            <input type="text" id="item-name" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        
                        <div>
                            <label for="barcode-produk" class="block text-sm font-medium text-slate-700">Barcode Produk (Fisik)</label>
                            <input type="text" id="barcode-produk" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="barcode-item" class="block text-sm font-medium text-slate-700">Barcode Item (Per Satuan)</label>
                            <input type="text" id="barcode-item" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        
                        <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700">Kuantitas & Konversi</label>
                                <div class="mt-1 flex space-x-4">
                                    <input type="number" placeholder="Qty Terkecil (misal: gram)" class="block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <input type="number" placeholder="Qty Terbesar (misal: Kg)" class="block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                            </div>
                            <div>
                                <label for="par-stock" class="block text-sm font-medium text-slate-700">Par Stock (Satuan Terkecil)</label>
                                <input type="number" id="par-stock" placeholder="Notifikasi stok minimum" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        </div>

                        <div>
                            <label for="item-group" class="block text-sm font-medium text-slate-700">Group</label>
                            <select id="item-group" class="mt-1 block w-full px-3 py-2 border border-slate-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <?php foreach ($itemData['group_options'] as $option => $selected): ?>
                                    <option <?php echo $selected; ?>><?php echo htmlspecialchars($option); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="item-class" class="block text-sm font-medium text-slate-700">Class</label>
                            <select id="item-class" class="mt-1 block w-full px-3 py-2 border border-slate-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <?php foreach ($itemData['class_options'] as $option => $selected): ?>
                                    <option <?php echo $selected; ?>><?php echo htmlspecialchars($option); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label for="item-category" class="block text-sm font-medium text-slate-700">Kategori</label>
                            <select id="item-category" class="mt-1 block w-full px-3 py-2 border border-slate-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <?php foreach ($itemData['category_options'] as $option => $selected): ?>
                                    <option <?php echo $selected; ?>><?php echo htmlspecialchars($option); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="md:col-span-2 text-right mt-4">
                            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">Simpan Item</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </main>
        
    </div>
    
</body>
</html>