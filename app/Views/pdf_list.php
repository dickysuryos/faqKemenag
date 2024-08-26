<?= $this->extend('layout/page_layout') ?>
<?= $this->section('pdf') ?>
<!DOCTYPE html>
<html>
<head>
    <title>PDF List</title>
</head>
<body>
    <div class="container">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="index-tab" data-bs-toggle="tab" data-bs-target="#indexPdf" type="button" role="tab" aria-controls="index" aria-selected="true">PDF List</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="upload-tab" data-bs-toggle="tab" data-bs-target="#uploadPdf" type="button" role="tab" aria-controls="upload" aria-selected="false">Upload PDF</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="indexPdf" role="tabpanel" aria-labelledby="index-tab">
  <h2>Uploaded PDFs by <?= session()->get('username')?></h2>
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
            <td><?= $pdf['title'] ?></td>
            <td><?= $pdf['description'] ?></td>
             <td><?= $pdf['category'] ?></td>
             <td><a href="<?= base_url($pdf['file_path']) ?>" target="_blank"><?= $pdf['file_name'] ?></a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
  <!-- end of pdf list -->
  <div class="tab-pane fade" id="uploadPdf" role="tabpanel" aria-labelledby="upload-tab">
  <h1>Upload PDF</h1>
    <?php if(session()->getFlashdata('status')): ?>
        <p><?= session()->getFlashdata('status') ?></p>
    <?php endif; ?>
    <form action="<?= base_url('/pdf/upload') ?>" method="post" enctype="multipart/form-data">
    <label for="title" class="form-label"> Title</label>   
    <input type="text" class="form-control" name="title" id="title" required>
    <br>
    <label for="desc" class="form-label"> Description</label>   
    <input type="text" class="form-control" name="desc" id="desc" required>
    <br>
    <select class="form-select form-select-lg mb-3" name="category" id="category">
            <option value="KUA">KUA</option>
            <option value="Haji & Umrah">Haji & Umrah</option>
            <option value="Nikah">Nikah</option>
            <option value="Bimas">Bimas</option>
            <option value="Pendidikan">Pendidikan</option>
        </select>
    <br>
    <input type="file" name="pdf" required>
    <button type="submit">Upload</button>
    </form>
  </div>
  </div>
 <!-- end of uploaded -->
</div>
    
</body>
</html>
<?= $this->endSection() ?>