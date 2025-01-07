<?php
use App\Models\MessagingModel;
use App\Models\UserModel;
use WebSocket\Client;
$user = null;
$counter = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Portal HelpDesk Kemenag Yogyakarta Staging</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
</head>
<style>
	.fab {
		position: fixed;
		bottom: 20px;
		right: 20px;
		z-index: 1000;
	}

	.fab .badge {
		position: absolute;
		top: -10px;
		right: -10px;
	}

	.navbar_custom {
		background-color: #0D7C66;
	}
</style>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark navbar_custom">
		<div class="container">
			<a class="navbar-brand" href="<?= base_url() ?>">Home</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
				aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('/pdf/allList') ?>">Document</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('/faq') ?>">Faqs</a>
					</li>
				</ul>
			</div>
			<ul class="navbar-nav list-group">
				<?php if (session()->get('logged_in')): ?>
					<?php if (session()->get('role') == 'admin'): ?>
						<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
								role="button" data-bs-toggle="dropdown" aria-expanded="false">Admin Dashboard</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
								<li><a class="dropdown-item" href="/auth/register">Manage User</a></li>
								<li><a class="dropdown-item" href="/pdf">Upload Doc</a></li>
								<li><a class="dropdown-item" href="/faqs">Add Faq</a></li>
								<li><a class="dropdown-item" href="/category/categories">Add Category</a></li>
							</ul>
						</li>
					<?php else: ?>
						<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
								role="button" data-bs-toggle="dropdown" aria-expanded="false">User Dashboard</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
								<li><a class="dropdown-item" href=<?= base_url('pdf') ?>>Upload Doc</a></li>
								<li><a class="dropdown-item" href=<?= base_url('faqs') ?>>Add Faq</a></li>
							</ul>
						</li>
					<?php endif; ?>
					<li class="nav-item"><a class="nav-link" href="/auth/logout">Logout
							(<?= session()->get('username') ?>)</a></li>
				<?php else: ?>
					<li class="nav-item"><a class="nav-link" href="/auth">Login</a></li>
					<li class="nav-item"><a class="nav-link" href="/auth/register">Register</a></li>
				<?php endif; ?>
			</ul>
		</div>
		</nav>
		<?php if (!empty($message)): ?>
			<?php foreach ($message as $chat):
				?>

				<?php if ($chat['created_by'] === session()->get('id')): ?>

				<?php else:

					?>
					<?php if ($chat['isRead'] == 0):
						$counter += 1;
					endif; ?>
				<?php endif ?>

			<?php endforeach; ?>
		<?php endif; ?>
	


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
	<?= $this->renderSection('/faqs/create') ?>
	<?= $this->renderSection('/auth/register') ?>
	<?= $this->renderSection('/category/categories') ?>
	<?= $this->renderSection('pdf') ?>

	<!-- Floating Action Button (FAB) -->
	<a type="button" class="btn btn-primary btn-lg rounded-circle fab" style="bottom: 20px; right: 20px;"
		href="/messaging/index">
		<i class="bi bi-chat-dots" value></i>
		<span class="badge bg-danger" id="badgeCounter"><?= $counter ?></span>
	</a>


	<!-- Jquery dan Bootsrap JS -->
	<script src="<?= base_url('js/jquery.min.js') ?>"></script>
	<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
	<!-- <script>
		var conn = new WebSocket('ws://localhost:8282');
		var client = {
			user_id: <?php echo session()->get('id'); ?>,
			user_name: <?php echo session()->get('id'); ?>,
			counter: <?php echo $counter; ?>,
			recipient_id: null,
			type: 'socket',
			token: null,
			message: null
		};

		conn.onopen = function (e) {
			conn.send(JSON.stringify(client));

			$('#chatModalLabel').append('<span color="green"> Successfully connected as user ' + client.user_id + '</span><br>');
			// $('#badgeCounter').append(client.counter)
		};

		conn.onmessage = function (e) {
			var chatMessages = document.querySelector('.chat-messages');
			var data = JSON.parse(e.data);

			if (data.message) {
				$('#messages').append('<div class="text-end message received">' + client.user_name + '(' + data.user_id + ')' + ' : ' + '<br>' + data.message + '</div>');
			}
			if (data.type === 'token') {
				$('#token').html('JWT Token : ' + data.token);
			}
			chatMessages.innerHTML += $('#messages').val();
			chatMessages.scrollTop = chatMessages.scrollHeight;
			// $('#badgeCounter').appendTo(0,data.counter=+1)
		};

		$('#submit').click(function () {
			send();
		});

		// $('#closeModal').click(function () {
		// 	// <php foreach ($message as $chat):
		// 	// 	if ($chat['sending_to'] == session()->get('id')):
		// 	// 		$data = ['isRead' => 1];s
		// 	// 		$model = new MessagingModel();
		// 	// 		$model->update($chat['id'], $data);
		// 	// 	endif;
		// 	// endforeach;
		// 	// ?>
		// });

		// const observedElement = document.querySelector('.chat-messages');

		// const observer = new IntersectionObserver((entries) => {
		// 	entries.forEach(entry => {
		// 		if (entry.isIntersecting) {
		// 			// console.log('Element has appeared in the viewport!');
		// 			// alert('The element has appeared in the viewport!');

		// 		}
		// 	});
		// });

		function send() {
			client.message = $('#text').val();
			var chatMessages = document.querySelector('.chat-messages');
			client.token = $('#token').text().split(': ')[1];
			client.type = 'chat';
			if ($('#userid').val === '') {
				client.recipient_id = 1;
			} else {
				client.recipient_id = $('#userid').val;
			}
			$('#token').empty();
			$('#recipient_id').empty();
			$('#messages').append('<div class="text-start message sent">' + ' : ' + '<br>' + client.message + '</div>');
			chatMessages.innerHTML += $('#messages').val();
			chatMessages.scrollTop = chatMessages.scrollHeight;
			conn.send(JSON.stringify(client));
		}

		document.getElementById('text').addEventListener('keypress', function (event) {
			if (event.key === 'Enter') {
				event.preventDefault(); // Prevent the default form submission
				send(); // Call the sendMessage function
			}
		});
	</script> -->
</body>
<br>
<footer>
	<div class="card-footer text-center">Made with 🩷</div>
</footer>

</html>