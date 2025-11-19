<?php
// goods_receipt.php

// -----------------------------------------------------------
// Variabel Data Dummy & Konteks
$headerUser = [
    'name' => 'John Doe',
    'role' => 'Admin'
];

// Penanda sidebar
$currentPage = 'goods-receipt-page';

// Data GR
$grNumber = 'GR/GDG/X/25/0912';

// Data Dummy PO
$poData = [
    'no_po'       => 'PO/MT/X/25/0432',
    'vendor'      => 'CV. Mitra Teknik',
    'unit'        => 'Produksi',
    'departemen'  => 'Maintenance',
    'kategori'    => 'Inventory',
];

// Item
$itemData = [
    'item_name'     => 'Bearing 6205 ZZ',
    'volume_po'     => 10,
    'unit'          => 'Pcs',
    'total_amount'  => 582750,
];

// Format Rupiah
function formatRupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Goods Receipt (GR) | Logistix</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f1f5f9;
    }

    /* LABEL */
    .input-label {
        display:block;
        font-size:13px;
        font-weight:500;
        color:#64748b;
        margin-bottom:4px;
    }

    /* INPUT & SELECT */
    .form-input,
    .form-select {
        width:100%;
        border:1px solid #cbd5e1;
        border-radius:8px;
        box-shadow:0 1px 2px rgba(0,0,0,0.05);
        padding:10px 12px;
        font-size:13px;
        color:#334155;
        height:42px;
    }

    /* STATIC FIELD */
    .form-static {
        background:#f1f5f9;
        border:1px solid #cbd5e1;
        border-radius:8px;
        padding:10px 12px;
        font-weight:600;
        color:#475569;
        height:42px;
        display:flex;
        align-items:center;
    }

    /* DATE WRAPPER */
    .input-date-wrapper { position:relative; }
    .input-date-wrapper i {
        position:absolute;
        right:14px;
        top:50%;
        transform:translateY(-50%);
        font-size:15px;
        color:#475569;
        pointer-events:none;
    }
    input[type="date"]::-webkit-calendar-picker-indicator { opacity:0; cursor:pointer; }

    /* TABLE */
    .soft-table {
        border:1px solid #e2e8f0;
        border-radius:12px;
        overflow:hidden;
        box-shadow:0 1px 3px rgba(0,0,0,0.06);
    }

    /* BUTTONS */
    .btn-success {
        background:#16a34a;
        color:white;
        border-radius:12px;
        padding:14px 50px;
        font-size:18px;
        font-weight:700;
        box-shadow:0 2px 6px rgba(0,0,0,0.15);
        transition:0.2s;
    }
    .btn-success:hover { background:#15803d; }

    .btn-primary {
        background:#4f46e5;
        color:white;
        padding:12px 34px;
        border-radius:10px;
        font-weight:600;
        transition:0.2s;
        box-shadow:0 2px 6px rgba(0,0,0,0.15);
    }
    .btn-primary:hover { background:#4338ca; }

</style>
</head>

<body class="flex min-h-screen">

<?php include 'partials/sidebar.php'; ?>

<main class="flex-1 flex flex-col ml-64">

    <?php include 'partials/header.php'; ?>

    <!-- PAGE CONTENT -->
    <div class="p-10">

        <h2 class="text-md font-semibold text-slate-700 mb-6 pb-2 border-b border-slate-300">
            Goods Receipt (GR)
        </h2>

        <div class="bg-white p-8 rounded-xl shadow-md border border-slate-200">

            <!-- GR FORM -->
            <form action="#" method="POST">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
                    <div>
                        <label class="input-label">No. GR</label>
                        <div class="form-static"><?= $grNumber ?></div>
                    </div>

                    <div>
                        <label class="input-label">Tanggal GR</label>
                        <div class="input-date-wrapper">
                            <input type="date" class="form-input" value="2025-11-12">
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>

                    <div>
                        <label class="input-label">Cari No. PO</label>
                        <select class="form-select">
                            <option><?= $poData['no_po'] . ' - ' . $poData['vendor'] ?></option>
                            <option>PO/MT/X/25/0433 - UD. Baja Perkasa</option>
                        </select>
                    </div>
                </div>

                <!-- PO INFO -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 mb-10 pb-6 border-b border-slate-300">
                    <div>
                        <label class="input-label">Vendor</label>
                        <div class="form-static"><?= $poData['vendor'] ?></div>
                    </div>
                    <div>
                        <label class="input-label">Unit</label>
                        <div class="form-static"><?= $poData['unit'] ?></div>
                    </div>
                    <div>
                        <label class="input-label">Departemen</label>
                        <div class="form-static"><?= $poData['departemen'] ?></div>
                    </div>
                    <div>
                        <label class="input-label">Kategori</label>
                        <div class="form-static"><?= $poData['kategori'] ?></div>
                    </div>
                </div>

                <!-- ITEM -->
                <h3 class="text-lg font-bold text-indigo-700 mb-4">Item yang Diterima</h3>

                <div class="soft-table overflow-x-auto mb-8">

                    <table class="min-w-full text-sm">
                        <thead class="bg-slate-50 text-slate-600 font-semibold">
                            <tr>
                                <th class="px-4 py-3 text-left">Item</th>
                                <th class="px-4 py-3 text-center">Volume PO</th>
                                <th class="px-4 py-3 text-center">Volume Aktual</th>
                                <th class="px-4 py-3 text-center">Varian</th>
                                <th class="px-4 py-3 text-right">Total Amount</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            <tr class="text-slate-700">
                                <td class="px-4 py-4 font-medium"><?= $itemData['item_name'] ?></td>

                                <td class="px-4 py-4 text-center">
                                    <?= $itemData['volume_po'] . ' ' . $itemData['unit'] ?>
                                </td>

                                <td class="px-4 py-4">
                                    <input type="number"
                                           class="form-input text-center"
                                           value="<?= $itemData['volume_po'] ?>">
                                </td>

                                <td class="px-4 py-4 text-center text-red-600 font-bold">
                                    0
                                </td>

                                <td class="px-4 py-4 text-right font-semibold text-indigo-700">
                                    <?= formatRupiah($itemData['total_amount']) ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- TOTAL & SUBMIT -->
                <div class="flex justify-end mt-10">
                    <div class="w-full md:w-96 space-y-4">

                        <div class="flex justify-between items-center text-lg font-bold text-slate-700">
                            <span>Total Amount GR</span>
                            <span class="text-2xl text-indigo-700">
                                <?= formatRupiah($itemData['total_amount']) ?>
                            </span>
                        </div>

                        <button type="submit" class="btn-success w-full flex items-center justify-center">
                            <i class="fa fa-check-circle mr-2"></i>
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
