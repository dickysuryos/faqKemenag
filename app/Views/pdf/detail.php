<?= $this->extend('layout/page_layout') ?>
<?= $this->section('pdf') ?>
<!DOCTYPE html>
<html>

<head>
  <title>PDF List</title>
</head>

<body>
  <div class="container">
        <h1>Detail PDF</h1>
        <br>
        <?php if (session()->getFlashdata('status')): ?>
          <p><?= session()->getFlashdata('status') ?></p>
        <?php endif; ?>
        <form action="<?= base_url('/pdf/update/' . $pdf['id']) ?>" method="post" enctype="multipart/form-data">
          <h2> Title</h2>
          <h3> <?=$pdf['title']?></h3>
          <br>
          <h2> Description</h2>
          <h3> <?=$pdf['description']?></h3>
          <br>
          <h2> Category</label>
          <h3> <?=$pdf['category']?></label>
         <br><br>

         <h2> Link File</h2>
         <a href="<?= base_url($pdf['file_path']) ?>" target="_blank"><?= $pdf['file_name'] ?></a>
         <br>
         <br>
         <a href="<?= base_url('/pdf') ?>"  class="btn btn-secondary"  style="width:100%;">Back</a>
        </form>
    </div>

</body>

</html>
<?= $this->endSection() ?>