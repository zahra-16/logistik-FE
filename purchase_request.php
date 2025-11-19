<?php
$headerUser = [ 'name' => 'John Doe', 'role' => 'Admin' ];
$currentPage = "purchase_request";

$requestDate = '12 Oktober 2025';
$prNumber = 'PR/PROC/X/25/0765';
$unit = 'Produksi';
$department = 'Maintenance';

$itemGroups = ['Bearing','Elektrik','Machining','Material','Sparepart'];
$items = ['Bearing 6205 ZZ','Bearing 6302 RS','Cable NYA 1.5mm','Grease SKF','Seal Oil 20x40x8','Belt V A51'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Purchase Request | Logistix</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background:#f1f5f9;
        }

        /* LABEL */
        .input-label {
            display:block;
            font-size:13px;
            font-weight:500;
            color:#64748b;
            margin-bottom:4px;
        }

        /* INPUT */
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

        /* STATIC BG */
        .static-field {
            background:#f1f5f9;
            font-weight:600;
        }

        /* DATE STYLE */
        .date-wrap {
            position:relative;
        }
        .date-wrap i {
            position:absolute;
            right:14px;
            top:50%;
            transform:translateY(-50%);
            color:#475569;
        }

        /* TABLE */
        .table-row {
            transition:.15s;
        }
        .table-row:hover {
            background:#f8fafc;
        }

        /* ADD ITEM BUTTON */
        .btn-add {
            font-size:14px;
            display:flex;
            align-items:center;
            color:#4f46e5;
            font-weight:600;
        }
        .btn-add:hover {
            color:#4338ca;
        }

        /* SUBMIT BUTTON */
        .btn-primary {
            background:#4f46e5;
            color:white;
            padding:14px 42px;
            border-radius:10px;
            font-weight:600;
            box-shadow:0 2px 6px rgba(0,0,0,0.15);
            transition:.2s;
        }
        .btn-primary:hover {
            background:#4338ca;
        }
    </style>
</head>

<body class="bg-slate-100 flex min-h-screen">

    <?php include "partials/sidebar.php"; ?>

    <main class="flex-1 flex flex-col ml-64">
        <?php include "partials/header.php"; ?>

        <div class="p-10 flex-1">

            <h2 class="text-md font-semibold text-slate-700 mb-6 pb-2 border-b border-slate-300">
                Formulir Purchase Request
            </h2>

            <!-- CARD WRAPPER -->
            <div class="bg-white p-8 rounded-xl shadow-md border border-slate-200">

                <!-- TOP DATA GRID -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10 pb-6 border-b border-slate-200">
                    <div>
                        <label class="input-label">Tanggal Request</label>
                        <input type="text" value="<?=$requestDate?>" class="form-input static-field" readonly>
                    </div>

                    <div>
                        <label class="input-label">No. PR</label>
                        <input type="text" value="<?=$prNumber?>" class="form-input static-field" readonly>
                    </div>

                    <div>
                        <label class="input-label">Unit</label>
                        <input type="text" value="<?=$unit?>" class="form-input static-field" readonly>
                    </div>

                    <div>
                        <label class="input-label">Department</label>
                        <input type="text" value="<?=$department?>" class="form-input static-field" readonly>
                    </div>
                </div>

                <!-- INPUT FORM -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

                    <!-- Expected Delivery -->
                    <div>
                        <label class="input-label">Expected Date Delivery</label>
                        <div class="date-wrap">
                            <input type="date" class="form-input">
                            <i class="fa fa-calendar-alt"></i>
                        </div>
                    </div>

                    <!-- Group Item -->
                    <div>
                        <label class="input-label">Group of Item</label>
                        <select class="form-select">
                            <option value="">-- Pilih Group --</option>
                            <?php foreach($itemGroups as $g): ?>
                                <option><?=$g?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Lokasi -->
                    <div>
                        <label class="input-label">Lokasi Tujuan (Gudang)</label>
                        <input type="text" class="form-input" placeholder="Isikan manual jika perlu">
                    </div>
                </div>

                <!-- DETAIL ITEM -->
                <h3 class="text-lg font-semibold text-slate-800 mb-4">Detail Item</h3>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <th class="p-3 text-left text-slate-600">Item</th>
                                <th class="p-3 text-left text-slate-600 w-40">Volume (Qty)</th>
                                <th class="w-10"></th>
                            </tr>
                        </thead>

                        <tbody id="item-list">

                            <!-- ROW SAMPLE -->
                            <tr class="table-row border-b border-slate-200">
                                <td class="p-3">
                                    <select class="form-select">
                                        <?php foreach($items as $i): ?>
                                            <option><?=$i?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>

                                <td class="p-3">
                                    <div class="relative">
                                        <input type="number" value="10" class="form-input pr-12 text-right">
                                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs text-slate-500">Pcs</span>
                                    </div>
                                </td>

                                <td class="text-center p-3">
                                    <button class="text-red-500 hover:text-red-700">
                                        <i class="fa fa-times text-lg"></i>
                                    </button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <!-- BUTTON TAMBAH -->
                <button class="btn-add mt-4">
                    <i class="fa fa-plus mr-1"></i> Tambah Item
                </button>

                <!-- SUBMIT -->
                <div class="flex justify-end mt-12">
                    <button class="btn-primary">
                        Submit Request
                    </button>
                </div>

            </div>
        </div>
    </main>

</body>
</html>
