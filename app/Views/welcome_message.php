<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .menu-item {
            text-align: center;
            margin: 20px 0;
        }
        .menu-item i {
            font-size: 50px;
            color: #007bff;
        }
        .menu-item-title {
            margin-top: 10px;
            font-size: 18px;
            font-weight: 500;
        }
    </style>
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="row text-center">
                <!-- Menu Item 1 -->
                <div class="col-md-4 menu-item">
                    <i class="bi bi-house-door-fill"></i>
                    <div class="menu-item-title">Haji Dan Umrah</div>
                </div>
                <!-- Menu Item 2 -->
                <div class="col-md-4 menu-item">
                    <i class="bi bi-person-fill"></i>
                    <div class="menu-item-title">Bimas Islam</div>
                </div>
                <!-- Menu Item 3 -->
                <div class="col-md-4 menu-item">
                    <i class="bi bi-gear-fill"></i>
                    <div class="menu-item-title">Nikah</div>
                </div>
                <!-- Menu Item 4 -->
                <div class="col-md-4 menu-item">
                    <i class="bi bi-book-half"></i>
                    <div class="menu-item-title">Pendidikan</div>
                </div>
                <!-- Menu Item 5 -->
                <div class="col-md-4 menu-item">
                    <i class="bi bi-cloud-download-fill"></i>
                    <div class="menu-item-title">Publikasi</div>
                </div>
                <!-- Menu Item 6 -->
                <div class="col-md-4 menu-item">
                    <i class="bi bi-info-circle-fill"></i>
                    <div class="menu-item-title">Statistik</div>
                </div>
            </div>
        </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<?= $this->endSection() ?>