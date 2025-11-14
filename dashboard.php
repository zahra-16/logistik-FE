<?php
// dashboard.php

// -----------------------------------------------------------
// Variabel Data Dummy
$headerUser = [
    'name' => 'John Doe', // Untuk header
    'role' => 'Admin'     // Untuk header
];
$userName = "John"; // Untuk konten ucapan selamat datang
// -----------------------------------------------------------

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Logistix</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* ---------------------------------
            GAYA KUSTOM SIDEBAR DAN KARTU
            --------------------------------- */
        :root {
            --primary-color: #4e73df;
            --sidebar-bg: #2c3e50;
        }

        /* Gaya Kustom untuk Tautan Sidebar Aktif Tailwind */
        .sidebar-link.active {
            background-color: #4f46e5; /* indigo-600 */
            color: #ffffff;
            font-weight: 600;
        }
        .sidebar-link:hover {
            background-color: #334155; /* slate-700 */
        }

        /* ---------------------------------
            SOLUSI SCROLLBAR AGRESIF (FINAL FIX)
            --------------------------------- */
        .custom-scrollbar-hide {
            /* Untuk Firefox dan IE/Edge Lama */
            -ms-overflow-style: none !important;  
            scrollbar-width: none !important;  
        }

        .custom-scrollbar-hide::-webkit-scrollbar {
            /* PERBAIKAN DENGAN !IMPORTANT UNTUK CHROME/EDGE */
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }
    </style>
</head>
<body class="bg-slate-100 flex min-h-screen"> 
    
    <?php 
        $currentPage = 'dashboard';
        include 'partials/sidebar.php'; 
    ?> 

    <main class="flex-1 ml-64 flex flex-col">
        
        <?php 
            include 'partials/header.php'; 
        ?>

        <div class="p-8 flex-1">
            <h2 class="text-3xl font-light text-slate-800 mb-6">Selamat Datang, <?php echo htmlspecialchars($userName); ?>!</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-indigo-500 flex flex-col justify-between transition duration-300 hover:shadow-xl">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        </div>
                        <div class="text-4xl font-bold text-slate-800">12</div>
                    </div>
                    <p class="text-sm text-slate-500 mt-2">Purchase Request Baru</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-green-500 flex flex-col justify-between transition duration-300 hover:shadow-xl">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <div class="text-4xl font-bold text-slate-800">8</div>
                    </div>
                    <p class="text-sm text-slate-500 mt-2">PO Menunggu GR</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-yellow-500 flex flex-col justify-between transition duration-300 hover:shadow-xl">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <div class="text-4xl font-bold text-slate-800">21 Item</div>
                    </div>
                    <p class="text-sm text-slate-500 mt-2">Stok Kritis</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-red-500 flex flex-col justify-between transition duration-300 hover:shadow-xl">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                        </div>
                        <div class="text-4xl font-bold text-slate-800">3</div>
                    </div>
                    <p class="text-sm text-slate-500 mt-2">Pengajuan Ditolak</p>
                </div>

            </div>
        </div>
    </main>
    
</body>
</html>