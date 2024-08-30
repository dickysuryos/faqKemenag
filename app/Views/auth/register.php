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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php if (session()->getFlashdata('msg')): ?>
        <p><?= session()->getFlashdata('msg') ?></p>
    <?php endif; ?>
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="index-tab" data-bs-toggle="tab" data-bs-target="#registerUser"
                    type="button" role="tab" aria-controls="index" aria-selected="true">New User</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="list-tab" data-bs-toggle="tab" data-bs-target="#listUser" type="button"
                    role="tab" aria-controls="list" aria-selected="false">List User</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="registerUser" role="tabpanel" aria-labelledby="index-tab">
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
                    <label class="form-label" for="category">Category Section</label>
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
                    <button class="btn btn-primary mb-3" type="submit">Register</button>
                </form>
            </div>

            <div class="tab-pane fade" id="listUser" role="tabpanel" aria-labelledby="list-tab">
                <h2>All User <?= session()->get('username') ?></h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Username</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($user)): ?>
                        <?php foreach ($user as $users): ?>
                            <tr>
                                <td><?= $users['username'] ?> </td>
                                <?php if (session()->get('logged_in')): ?>
                                    <?php if (session()->get('role') == 'admin'): ?>
                                        <td>
                                            <a href="<?= base_url('pdf/edit/' . $users['id']) ?>"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <a href="<?= base_url('pdf/delete/' . $users['id']) ?>" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure?')">Delete</a>
                                        </td>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <?php endif; ?>
                    </tbody>
                </table>
            </div>
            </div>
        
        </div>
</body>

</html>
<?= $this->endSection() ?>