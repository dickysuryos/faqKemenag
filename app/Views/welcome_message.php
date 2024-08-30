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
        }
        .menu-item-title {
            margin-top: 10px;
            font-size: 11px;
            font-weight: 500;
        }
        .btn_custom {
            border: none;
        }
        .icon_home {
            color:#0D7C66;
        }
        .btn_custom:hover .icon_home {
            color:#fff;
        }
        .icon_home -> #category {
            color:#fff;
        }
    </style>
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="row text-center">
            <?php foreach ($category as $category): ?>
                <div class="col-md-3 menu-item">
                <form id="searchForm" name="searchForm" action="<?= base_url('faqs/getFaqByCat') ?>" method="get" class="d-flex icon_home">
                <button class="btn btn-outline-success btn_custom" type="submit" name="category" value=<?= $category['id'] ?>  style="height: 150px;width: 200px;">    
                <!-- <i class="" id="category" name="category" value="haji" method="get">    -->
                    <img src="<?= base_url('/uploads/icon/' . $category['image']) ?>" alt="<?= $category['name'] ?>" width="100">
                    <div id="category"  class="menu-item-title"><?= $category['name'] ?></div>
                     </button>
                     </form>
                </div>
            <?php endforeach; ?>
              
                </div>
            </div>
        </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<?= $this->endSection() ?>