<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New FAQ</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Add New FAQ</h2>
    <form action="<?= base_url('faqs/store') ?>" method="post">
        <div class="mb-3">
            <label for="question" class="form-label">Question</label>
            <input type="text" class="form-control" id="question" name="question" required>
        </div>
        <div class="mb-3">
            <label for="answer" class="form-label">Answer</label>
            <textarea class="form-control" id="answer" name="answer" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="<?= base_url('faqs') ?>" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
