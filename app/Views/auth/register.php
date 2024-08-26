<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<?php if (isset($validation)): ?>
    <div>
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
  
    <?php if (session()->getFlashdata('msg')): ?>
        <p><?= session()->getFlashdata('msg') ?></p>
    <?php endif; ?>
    <div class="container">
    <h2>Register New User</h2>
    <form action="/auth/store" method="post">
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" id="username" required>
        <br>
    </div>
        <label class="form-label" for="password">Password</label>
        <input class="form-control" type="password" name="password" id="password" required>
        <br>
        <label class="form-label" for="role">Role</label>
        <select class="form-select form-select-lg mb-3" name="role" id="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <br>
        <button class="btn btn-primary mb-3" type="submit">Register</button>
        
    </form>
    </div>
</body>
</html>
<?= $this->endSection() ?>