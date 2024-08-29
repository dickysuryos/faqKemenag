<!DOCTYPE html>
<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit FAQ</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Category</h2>
    <form action="<?= base_url('/category/update/' . $category['id']) ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Category</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $category['name'] ?>" required>
        </div>
        <div class="mb-3">
        <label for="images">Upload Image:</label>
        <input type="file" name="images" placeholder="<?= $category['image']?>"><br><br>

        <?php if (isset($error)) { echo 'ini error ' + $error; } ?>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="<?= base_url('/category/categories') ?>" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
<?= $this->endSection() ?>