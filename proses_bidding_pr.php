<?php
// proses_bidding_pr.php (FINAL UI FIXED)

// -----------------------------------------------------------
// Dummy Data & Context
$headerUser = [
    'name' => 'John Doe',
    'role' => 'Admin'
];

$prNumberSelected = 'PR/PROC/X/25/0765';
$biddingItem = [
    'item_name' => 'Bearing 6205 ZZ',
    'qty' => 10,
];

$vendorList = [
    'PT. Sinar Jaya Abadi',
    'CV. Mitra Teknik',
    'UD. Baja Perkasa',
    'Toko Makmur Sentosa',
];

$dummyBiddings = [
    [
        'id' => 1,
        'nama_vendor' => 'PT. Sinar Jaya Abadi',
        'harga_satuan' => 55000,
        'total' => 550000,
        'term_of_payment' => '30 Hari',
    ],
    [
        'id' => 2,
        'nama_vendor' => 'CV. Mitra Teknik',
        'harga_satuan' => 52500,
        'total' => 525000,
        'term_of_payment' => '14 Hari',
    ]
];

$currentPage = 'pr-bidding-page';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Proses Bidding PR | Logistix</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body {
    font-family: 'Inter', sans-serif;
    background-color:#f1f5f9;
}

/* LABEL */
.input-label {
    display:block;
    font-size:13px;
    font-weight:500;
    color:#64748b;
    margin-bottom:4px;
}

/* INPUT GENERAL */
.form-input, .form-select {
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
.form-static-bg {
    background:#f1f5f9;
    color:#475569;
    font-weight:600;
    cursor:not-allowed;
}

/* DATE INPUT */
.input-date-wrapper {
    position: relative;
    width: 100%;
}
.input-date {
    width: 100%;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    padding: 10px 40px 10px 12px;
    font-size: 13px;
    height: 42px;
    color: #334155;
}

input[type="date"]::-webkit-calendar-picker-indicator {
    opacity: 0;
    cursor: pointer;
}

.input-date-wrapper i {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 15px;
    color: #475569;
    pointer-events: none;
}

/* CARD */
.vendor-card {
    border:1px solid #e2e8f0;
    border-radius:12px;
    background:white;
    padding:22px;
    box-shadow:0 1px 3px rgba(0,0,0,0.06);
}

/* BUTTON PRIMARY */
.btn-primary {
    background:#4f46e5;
    color:white;
    padding:12px 40px;
    border-radius:10px;
    font-weight:600;
    box-shadow:0 2px 6px rgba(0,0,0,0.15);
    display:flex;
    align-items:center;
    transition:0.2s;
}
.btn-primary:hover {
    background:#4338ca;
}

/* BUTTON SUCCESS */
.btn-success {
    background:#16a34a;
    color:white;
    padding:14px 50px;
    border-radius:12px;
    font-size:18px;
    font-weight:700;
    box-shadow:0 2px 6px rgba(0,0,0,0.15);
    transition:0.2s;
}
.btn-success:hover {
    background:#15803d;
}

/* TOTAL FIELD */
.total-input {
    background:#f1f5f9;
    font-weight:700;
}
</style>
</head>

<body class="bg-slate-100 flex min-h-screen">

<?php include 'partials/sidebar.php'; ?>

<main class="flex-1 flex flex-col ml-64">

<?php include 'partials/header.php'; ?>

<!-- PAGE CONTENT -->
<div class="p-10 flex-1">

    <h2 class="text-md font-semibold text-slate-700 mb-6 pb-2 border-b border-slate-300">
        Proses Bidding Purchase Request
    </h2>

    <div class="bg-white p-8 rounded-xl shadow-md border border-slate-200">

        <p class="text-slate-600">
            Item dari <strong><?= $prNumberSelected ?></strong> yang disetujui:
        </p>

        <h3 class="text-xl font-bold text-indigo-700 mt-2 mb-8">
            Item: <?= $biddingItem['item_name'] ?> (Qty: <?= $biddingItem['qty'] ?>)
        </h3>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <?php foreach ($dummyBiddings as $index => $bidding): ?>
            <div class="vendor-card">

                <h4 class="text-lg font-semibold text-slate-800 mb-5">
                    Penawaran <?= $index + 1 ?>
                </h4>

                <div class="space-y-5">

                    <!-- Vendor -->
                    <div>
                        <label class="input-label">Nama Vendor</label>
                        <select class="form-input bg-white">
                            <option value="">-- Pilih Vendor --</option>
                            <?php foreach ($vendorList as $vendor): ?>
                                <option value="<?= $vendor ?>" <?= $vendor == $bidding['nama_vendor'] ? 'selected' : '' ?>>
                                    <?= $vendor ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Harga -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="input-label">Harga Satuan</label>
                            <input 
                                type="number" 
                                class="form-input harga-satuan"
                                value="<?= $bidding['harga_satuan'] ?>"
                                data-index="<?= $index ?>">
                        </div>

                        <div>
                            <label class="input-label">Total</label>
                            <input 
                                type="text" 
                                class="form-input total-input total-harga"
                                value="<?= number_format($bidding['total'],0,',','.') ?>"
                                readonly>
                        </div>
                    </div>

                    <!-- TOP -->
                    <div>
                        <label class="input-label">Term of Payment</label>
                        <input 
                            type="text" 
                            class="form-input" 
                            value="<?= $bidding['term_of_payment'] ?>">
                    </div>

                    <!-- Upload -->
                    <div>
                        <label class="input-label">Dokumen Penawaran</label>
                        <label class="flex items-center px-4 py-2 bg-white border border-slate-300 rounded-lg cursor-pointer hover:bg-slate-50">
                            <i class="fa fa-upload mr-2 text-slate-500"></i>
                            <span class="text-sm text-slate-700">Upload File</span>
                            <input type="file" class="hidden">
                        </label>
                    </div>

                </div>

            </div>
            <?php endforeach; ?>

        </div>

        <!-- SIMPAN ITEM -->
        <div class="mt-8 flex justify-end">
            <button class="btn-primary">
                Simpan Bidding Item Ini
            </button>
        </div>

        <!-- SUBMIT ALL -->
        <div class="mt-12 flex justify-center border-t border-dashed pt-8">
            <button class="btn-success flex items-center">
                <i class="fas fa-check-circle mr-2 text-white"></i>
                Submit Semua Bidding untuk Approval
            </button>
        </div>

    </div>
</div>

</main>

<script>
// Auto hitung total
document.querySelectorAll('.harga-satuan').forEach(input => {
    input.addEventListener('input', function() {
        const parent = this.closest('.vendor-card');
        const totalInput = parent.querySelector('.total-harga');

        const qty = <?= $biddingItem['qty'] ?>;
        const harga = parseFloat(this.value) || 0;

        totalInput.value = (harga * qty).toLocaleString('id-ID');
    });
});
</script>

</body>
</html>
