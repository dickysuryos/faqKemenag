<!DOCTYPE html>
<html lang="en">
<?= $this->extend('layout/page_layout') ?>
<?= $this->section('/category/categories') ?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Category Select Dropdown</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="index-tab" data-bs-toggle="tab" data-bs-target="#indexPdf" type="button"
          role="tab" aria-controls="index" aria-selected="true">All Category</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="addCategory-tab" data-bs-toggle="tab" data-bs-target="#addCategory" type="button"
          role="tab" aria-controls="addCategory" aria-selected="false">Add Category</button>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="indexPdf" role="tabpanel" aria-labelledby="index-tab">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Name</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($categories as $category): ?>
              <tr>
                <td><?= $category['name'] ?></td>
                <td width="150px;">
                  <a href="<?= base_url('/category/edit/' . $category['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                  <a href="<?= base_url('/category/delete/' . $category['id']) ?>" class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure?')">Delete</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <!-- end list category -->
      <div class="tab-pane fade" id="addCategory" role="tabpanel" aria-labelledby="index-tab">
        <?php if (session()->getFlashdata('status')): ?>
          <p><?= session()->getFlashdata('status') ?></p>
        <?php endif; ?>
        <form action="<?= base_url('/category/create') ?>" method="post">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="image">Upload Image:</label>
            <input type="file" name="image"><br><br>

            <?php if (isset($error)) {
              echo $error;
            } ?>
          </div>
          <button type="submit" class="btn btn-success">Add</button>
        </form>
      </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
<?= $this->endSection() ?>