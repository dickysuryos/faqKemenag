<?= $this->extend('layout/page_layout') ?>
<?= $this->section('faq') ?>
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
    <div class="mb-3">
      <form id="searchForm" name="searchForm" action="<?= base_url('faq/search') ?>" method="get" class="d-flex">
      <input id="search" name="search"class="form-control me-2" type="search" placeholder="Cari Sesuatu" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  </div>
</div>

<div class="container mt-5">
    <h1 id="titleFaq" name="titleFaq" class="mb-4">Frequently Asked Questions (FAQ)</h1>
    <div class="accordion" id="faqAccordion">
        <?php foreach ($faqs as $index => $faq): ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading<?= $index ?>">
                    <button class="accordion-button <?= $index === 0 ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>" aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>" aria-controls="collapse<?= $index ?>">
                        <?= $faq['question'] ?>
                    </button>
                </h2>
                <div id="collapse<?= $index ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" aria-labelledby="heading<?= $index ?>" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <?=  auto_link_text($faq['answer']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- End Of Search  -->

</div>


<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<?= $this->endSection() ?>