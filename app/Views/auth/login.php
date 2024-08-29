<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
    <style>
        /* Center the form container */
        .login-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-form {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: #f7f7f7;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-title {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
   
    <div class="container login-container">
    <?php if (session()->getFlashdata('msg')): ?>
        <p><?= session()->getFlashdata('msg') ?></p>
    <?php endif; ?>
    <form class="login-form" action="/auth/login" method="post">
    <div class="mb-3">
    <h1 class="login-title" >Portal HelpDesk Kemenag</h1>
    <h2>Login</h2>
        <label class="form-label" for="username">Username</label>
        <input class="form-control"  type="text" name="username" id="username" required>
        <br>
        <label class="form-label" for="password">Password</label>
        <input class="form-control"  type="password" name="password" id="password" required>
        <br>
        <button class="btn btn-primary mb-3" type="submit">Login</button>
    </div>
    </form>
    </div>
    <script src="<?= base_url('js/jquery.min.js') ?>"></script>
	<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>

</body>
</html>
