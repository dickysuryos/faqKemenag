<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Portal HelpDesk Kemenag Yogyakarta Staging</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<div class="container">
			<a class="navbar-brand" href="<?= base_url() ?>">Home</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('about') ?>">About</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('contact') ?>">Contact</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('faq') ?>">Faqs</a>
					</li>
				</ul>
			</div>
			<ul class="navbar-nav list-group">
                    <?php if (session()->get('logged_in')): ?>
                        <?php if (session()->get('role') == 'admin'): ?>
                            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Admin Dashboard</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            					<li><a class="dropdown-item" href="/auth/register">Manage User</a></li>
            					<li><a class="dropdown-item" href="/pdf">Upload Doc</a></li>
            					<li><a class="dropdown-item" href="/faqs">Add Faq</a></li>
          					</ul>
						</li>
                        <?php else: ?>
                            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">User Dashboard</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            					<li><a class="dropdown-item" href="pdf">Upload Doc</a></li>
            					<li><a class="dropdown-item" href="faqs">Add Faq</a></li>
          					</ul>
							  </li>
							<?php endif; ?>
                        <li class="nav-item"><a class="nav-link" href="/auth/logout">Logout (<?= session()->get('username') ?>)</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/auth">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="/auth/register">Register</a></li>
                    <?php endif; ?>
                </ul>
		</div>
		
	</nav>


	<!-- <header class="jumbotron jumbotron-fluid">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 class="h1">Portal HelpDesk Kemenag</h1>
				</div>
			</div>
		</div>
    </header> -->
    <?= $this->renderSection('content') ?>
 	 <?= $this->renderSection('faq') ?>
 	  <?= $this->renderSection('faqs') ?>
	   <?= $this->renderSection('/auth/register') ?>
<?= $this->renderSection('pdf') ?>
 	 
<!-- 	<footer class="jumbotron jumbotron-fluid mt-5 mb-0">
		<div class="container text-center">Copyright &copy <?= Date('Y') ?> CI News</div>
	</footer> -->

	<!-- Jquery dan Bootsrap JS -->
	<script src="<?= base_url('js/jquery.min.js') ?>"></script>
	<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>

</body>
<br>
<footer>
<div class="card-footer text-center">Made with 🩷</div>
</footer>
</html>