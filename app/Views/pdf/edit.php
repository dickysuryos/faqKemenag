<?= $this->extend('layout/page_layout') ?>
<?= $this->section('pdf') ?>
<!DOCTYPE html>
<html>

<head>
  <title>PDF List</title>
</head>

<body>
  <div class="container">
        <h1>Edit PDF</h1>
        <?php if (session()->getFlashdata('status')): ?>
          <p><?= session()->getFlashdata('status') ?></p>
        <?php endif; ?>
        <form action="<?= base_url('/pdf/update/' . $pdf['id']) ?>" method="post" enctype="multipart/form-data">
          <label for="title" class="form-label"> Title</label>
          <input type="text" class="form-control" name="title" id="title" placeholder="<?=$pdf['title']?>" value="<?=$pdf['title']?>"required>
          <br>
          <label for="desc" class="form-label"> Description</label>
          <input type="text" class="form-control" name="desc" placeholder="<?=$pdf['description']?>" id="desc" value="<?=$pdf['description']?>" required>
          <br>
          <select class="form-select" id="category" name="category">
                    <option selected disabled>Select a category</option>
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['name'] ?>"><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">No categories available</option>
                    <?php endif; ?>
                </select>
          <br>
          <input type="file" name="pdf" value="<?=$pdf['file_path']?>" required>
         <br>
         <br>
          <button type="submit" class="btn btn-success">Upload</button>
          <a href="<?= base_url('/pdf') ?>" class="btn btn-secondary">Back</a>
        </form>
    </div>

</body>

</html>
<?= $this->endSection() ?>