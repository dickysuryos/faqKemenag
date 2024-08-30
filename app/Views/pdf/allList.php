<?= $this->extend('layout/page_layout') ?>
<?= $this->section('pdf') ?>
<!DOCTYPE html>
<html>

<head>
  <title>PDF List</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container">
  <div class="container mt-5">
    <div class="mb-3">
      <form id="searchForm" name="searchForm" action="<?= base_url('pdf/search') ?>" method="get" class="d-flex">
      <input id="search" name="search"class="form-control me-2" type="search" placeholder="Cari Dokumen" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  </div>
</div>
<table class="table table-bordered">
          <thead>
            <tr>
              <th>Title</th>
              <th>Description</th>
              <th>Category</th>
              <th>File</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($pdfs as $pdf): ?>
              <tr>
                <td> <a href="<?= base_url('/pdf/detail/' . $pdf['id']) ?>"><?= $pdf['title'] ?></a> </td>
                <td><?= $pdf['description'] ?></td>
                <td><?= $pdf['category'] ?></td>
                <td><a href="<?= base_url($pdf['file_path']) ?>" target="_blank"><?= $pdf['file_name'] ?></a></td>
                <?php if (session()->get('logged_in')): ?>
                  <?php if (session()->get('role') == 'admin'): ?>
                    <td>
                      <label id="shareLink" data-link="<?= base_url('/pdf/detail/'. $pdf['id']) ?>" readonly invisible></label>
                      <button class="btn btn-primary btn-sm copy-button" id="copyButton">Share</button>
                      <!-- Toast -->
                      <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                        <div id="copyToast" class="toast align-items-center text-bg-success border-0" role="alert"
                          aria-live="assertive" aria-atomic="true">
                          <div class="d-flex">
                            <div class="toast-body">
                              Link copied to clipboard!
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                              aria-label="Close"></button>
                          </div>
                        </div>
                      </div>


                    </td>
                  <?php endif; ?>
                <?php endif; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
    </div>
  <!-- Bootstrap 5 JS and Popper.js -->
 <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script> -->

  <!-- JavaScript for Copy Functionality -->
  <script>
    document.querySelectorAll('.copy-button').forEach(button => {
        button.addEventListener('click', function() {
            // Find the closest label with the data-link attribute
            var shareLink = this.closest('tr').querySelector('label').getAttribute('data-link');

            // Copy the link to the clipboard
            navigator.clipboard.writeText(shareLink).then(function() {
                // Show the toast notification
                var toastEl = document.getElementById('copyToast');
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            }, function(err) {
                console.error('Async: Could not copy text: ', err);
            });
        });
    });
</script>

</html>
<?= $this->endSection() ?>