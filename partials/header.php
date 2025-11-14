<?php
// partials/header.php

// --- Fungsi Helper (Untuk membuat inisial) ---
function getInitials($name) {
    $words = explode(' ', trim($name));
    $initials = '';
    if (isset($words[0])) {
        $initials .= strtoupper(substr($words[0], 0, 1));
    }
    // Hanya ambil huruf pertama dari kata terakhir jika ada lebih dari satu kata
    if (count($words) > 1) {
        $initials .= strtoupper(substr(end($words), 0, 1));
    }
    return $initials === '' ? '?' : $initials;
}

// --- Ambil Data yang Dibutuhkan ---
// Fallback data
$headerUser = isset($headerUser) ? $headerUser : ['name' => 'Pengguna Tamu', 'role' => 'Guest']; 
$initials = getInitials($headerUser['name']);

// Tentukan Judul Halaman berdasarkan $currentPage
$title = "Dashboard"; // Default title
if (isset($currentPage)) {
    if ($currentPage == 'manajemen_user' || $currentPage == 'user-management.php') {
        $title = 'Manajemen User';
    } elseif ($currentPage == 'item-data.php') {
        $title = 'Master Item'; // <-- Judul disesuaikan untuk halaman Data Item
    } else {
        // Asumsi jika bukan salah satu di atas, kembali ke Dashboard (atau bisa diperluas)
        $title = 'Dashboard'; 
    }
}
?>

<header class="bg-white shadow-md border-b border-slate-200 sticky top-0 z-10">
    <div class="px-8 py-3 flex justify-between items-center h-16">
        
        <h1 id="page-title" class="text-xl font-semibold text-slate-800 w-1/4">
            <?php echo htmlspecialchars($title); ?>
        </h1>

        <div class="flex-1 max-w-md mx-auto">
            <div class="relative">
                <input type="text" placeholder="Cari..." class="w-full pl-4 pr-10 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 text-sm" />
                
                <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-indigo-600">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.39L19.49 19.49a.75.75 0 11-1.06 1.06l-6.04-6.04A7 7 0 012 9z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="flex items-center space-x-3 w-1/4 justify-end">
            
            <div class="w-10 h-10 flex items-center justify-center bg-indigo-600 text-white font-bold rounded-full text-base shadow-md shrink-0">
                <?php echo htmlspecialchars($initials); ?>
            </div>
            
            <div class="text-right hidden sm:block">
                <p class="text-sm font-semibold text-slate-900 leading-none">
                    <?php echo htmlspecialchars($headerUser['name']); ?>
                </p>
                <p class="text-xs text-slate-500 leading-none">
                    <?php echo htmlspecialchars($headerUser['role']); ?>
                </p>
            </div>
        </div>
    </div>
</header>