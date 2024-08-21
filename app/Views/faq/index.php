
<?= $this->extend('layout/page_layout') ?>
<?= $this->section('faqs') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>FAQ List</h2>
    <a href="<?= base_url('faqs/create') ?>" class="btn btn-primary mb-3">Add New FAQ</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Question</th>
            <th>Answer</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($faqs) && is_array($faqs)): ?>
            <?php foreach ($faqs as $faq): ?>
                <tr>
                    <td><?= $faq['id'] ?></td>
                    <td><?= $faq['question'] ?></td>
                    <td><?= $faq['answer'] ?></td>
                    <td>
                        <a href="<?= base_url('faqs/edit/' . $faq['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= base_url('faqs/delete/' . $faq['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center">No FAQs found.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
<?= $this->endSection() ?>