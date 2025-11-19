<?php
$headerUser = [ 'name' => 'John Doe', 'role' => 'Admin' ];
$currentPage = "persetujuan_pr";

$prList = [
    "PR/PROC/X/25/0765 - Maintenance",
    "PR/PROC/X/25/0743 - Engineering",
    "PR/PROC/X/25/0720 - Maintenance",
];

$prDetail = [
    'nomor'         => 'PR/PROC/X/25/0765',
    'requestor'     => 'Budi Santoso',
    'department'    => 'Maintenance',
    'tgl_request'   => '12/10/2025',
    'tgl_harap'     => '20/10/2025',
    'items' => [
        [ 'nama' => 'Bearing 6205 ZZ', 'qty' => 10, 'approved' => 10, 'status' => 'Setuju' ],
        [ 'nama' => 'V-Belt B-52', 'qty' => 5,  'approved' => 0,  'status' => 'Tolak' ],
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Persetujuan Purchase Request</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body {
    font-family: 'Inter', sans-serif;
    background-color:#f1f5f9;
}

/* === LABEL === */
.input-label {
    display:block;
    font-size:13px;
    font-weight:500;
    color:#64748b;
    margin-bottom:4px;
}

/* === INPUT / SELECT === */
.form-input, .form-select {
    width:100%;
    border:1px solid #cbd5e1;
    border-radius:10px;
    box-shadow:0 1px 3px rgba(0,0,0,0.06);
    padding:10px 12px;
    font-size:13px;
    color:#334155;
    height:42px;
    transition:0.15s;
}
.form-input:focus, .form-select:focus {
    border-color:#6366f1;
    outline:none;
    box-shadow:0 0 0 3px rgba(99,102,241,0.15);
}

/* === CARD === */
.data-card {
    border:1px solid #e2e8f0;
    border-radius:12px;
    background:white;
    padding:24px;
    box-shadow:0 1px 4px rgba(0,0,0,0.06);
}

/* === TABLE === */
.table-header {
    background:#f8fafc;
    color:#475569;
    font-weight:600;
}
.table-row:hover {
    background:#f8fafc;
}

/* === BUTTON === */
.btn-secondary {
    background:#e2e8f0;
    color:#334155;
    padding:12px 34px;
    font-weight:600;
    border-radius:10px;
    transition:0.2s;
}
.btn-secondary:hover {
    background:#cbd5e1;
}

.btn-primary {
    background:#16a34a;
    color:white;
    padding:12px 40px;
    font-weight:700;
    border-radius:12px;
    transition:0.2s;
}
.btn-primary:hover {
    background:#15803d;
}
</style>
</head>

<body class="bg-slate-100 flex min-h-screen">

<?php include "partials/sidebar.php"; ?>

<main class="flex-1 flex flex-col ml-64">

<?php include "partials/header.php"; ?>

<div class="p-10 flex-1">

    <h2 class="text-md font-semibold text-slate-700 mb-6 pb-2 border-b border-slate-300">
        Persetujuan Purchase Request — <?= $prDetail['department'] ?>
    </h2>

    <div class="bg-white p-8 rounded-xl shadow-md border border-slate-200">

        <!-- Dropdown Cari PR -->
        <div class="mb-8">
            <label class="input-label">Cari Nomor PR</label>
            <select class="form-select">
                <?php foreach ($prList as $p): ?>
                    <option><?= $p ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- DETAIL BOX -->
        <div class="data-card">

            <h3 class="text-xl font-semibold text-slate-800 mb-6">
                Detail <?= $prDetail['nomor'] ?>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-sm">

                <div>
                    <p class="input-label">Requestor:</p>
                    <p class="font-semibold text-slate-800"><?= $prDetail['requestor'] ?></p>
                </div>

                <div>
                    <p class="input-label">Departemen:</p>
                    <p class="font-semibold text-slate-800"><?= $prDetail['department'] ?></p>
                </div>

                <div>
                    <p class="input-label">Tgl Request:</p>
                    <p class="font-semibold text-slate-800"><?= $prDetail['tgl_request'] ?></p>
                </div>

                <div>
                    <p class="input-label">Tgl Diharapkan:</p>
                    <p class="font-semibold text-slate-800"><?= $prDetail['tgl_harap'] ?></p>
                </div>

            </div>

            <!-- TABLE -->
            <table class="w-full text-sm mt-8">
                <thead>
                    <tr class="table-header border-y border-slate-200">
                        <th class="py-3 px-3 text-left">Item</th>
                        <th class="py-3 px-3 text-left">Qty Diajukan</th>
                        <th class="py-3 px-3 text-left">Qty Disetujui</th>
                        <th class="py-3 px-3 text-left">Status</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($prDetail['items'] as $item): ?>
                    <tr class="border-b border-slate-200 table-row">
                        <td class="py-3 px-3"><?= $item['nama'] ?></td>
                        <td class="py-3 px-3"><?= $item['qty'] ?></td>
                        <td class="py-3 px-3">
                            <input type="number" 
                                   value="<?= $item['approved'] ?>" 
                                   class="form-input w-28 text-center" />
                        </td>
                        <td class="py-3 px-3">
                            <select class="form-select w-40">
                                <option <?= $item['status']=='Setuju'?'selected':'' ?>>Setuju</option>
                                <option <?= $item['status']=='Tolak'?'selected':'' ?>>Tolak</option>
                            </select>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>

        <!-- ACTION BUTTONS -->
        <div class="flex justify-end gap-4 mt-10">
            <button class="btn-secondary">Simpan Draft</button>
            <button class="btn-primary flex items-center">
                <i class="fa fa-check-circle mr-2 text-white"></i>
                Submit Persetujuan
            </button>
        </div>

    </div>

</div>

</main>

</body>
</html>
