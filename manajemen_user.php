<?php
// user-management.php

// -----------------------------------------------------------
// Variabel Data Dummy (Data tidak diubah dari permintaan terakhir)
$headerUser = [
    'name' => 'John Doe', // Untuk header
    'role' => 'Admin'     // Untuk header
];

$users = [
    [
        'name' => 'Jane Cooper',
        'role' => 'Manager',
        'department' => 'Purchasing',
        'division' => 'Operasional',
        'last_activity' => 'Login (12/10/2025 22:50)'
    ],
    [
        'name' => 'Budi Santoso',
        'role' => 'SPV',
        'department' => 'Gudang',
        'division' => 'Logistik',
        'last_activity' => 'Approve PR-0123 (12/10/2025 21:15)'
    ],
    [
        'name' => 'Risa Dewi',
        'role' => 'Staff',
        'department' => 'Purchasing',
        'division' => 'Pengadaan',
        'last_activity' => 'Buat PR-0124 (13/10/2025 09:30)'
    ],
    [
        'name' => 'Ahmad Fauzi',
        'role' => 'General Manager',
        'department' => 'Management',
        'division' => 'Eksekutif',
        'last_activity' => 'Login (13/10/2025 10:00)'
    ],
];
// -----------------------------------------------------------

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User | Logistix</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* ---------------------------------
            GAYA KUSTOM SIDEBAR DAN SCROLLBAR (Disalin dari dashboard.php)
            --------------------------------- */
        body {
            font-family: 'Inter', sans-serif;
        }
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
        // Set halaman saat ini agar sidebar.php tahu mana yang harus diaktifkan
        $currentPage = 'manajemen_user';
        // Asumsi file partials/sidebar.php ada
        include 'partials/sidebar.php'; 
    ?> 

    <main class="flex-1 ml-64 flex flex-col">
        
        <?php 
            // Header menggunakan title 'Manajemen User'
            // Asumsi file partials/header.php ada
            include 'partials/header.php'; 
        ?>

        <div class="p-8 flex-1">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-slate-800">Manajemen User</h2>
                 <a href="user-add.php" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-200">
                    Tambah User
                </a>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Nama User</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Peran</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Departemen</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Divisi</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Aktivitas Terakhir</th>
                            <th scope="col" class="relative px-6 py-3"><span class="sr-only">Detail</span></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900"><?php echo htmlspecialchars($user['name']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500"><?php echo htmlspecialchars($user['role']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500"><?php echo htmlspecialchars($user['department']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500"><?php echo htmlspecialchars($user['division']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500"><?php echo htmlspecialchars($user['last_activity']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="user-detail.php?id=<?php echo urlencode($user['name']); ?>" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    
</body>
</html>