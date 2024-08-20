<?= $this->extend('layout/page_layout') ?>
<?= $this->section('faq') ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script>
        $(document).ready(function() {
            // Handle the form submission
            $('#searchForm').on('submit', function(e) {
                // e.preventDefault(); // Prevent the default form submission

                // Get the search term
                var searchTerm = $('#search').val().trim();

                if (searchTerm === '') {
                    // If the search term is empty, show the default message
                    $('#titleFaq').unhide
                } else {
                    // Perform the AJAX request
                 $('#titleFaq2').text('Hasil Pencarian : ' .$searchTerm);
                 $('#titleFaq').hide()
                  $('#titleFaq2').unhide()
                 

                     
                }
            });
        });
    </script> -->
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
</div>


<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<?= $this->endSection() ?>