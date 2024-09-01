<?php
use App\Models\UserModel;
use WebSocket\Client;
$user = null;
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
	.navbar_custom {
		background-color: #0D7C66;
	}
	.chat-container {
            height: 50vh;
            display: flex;
            flex-direction: column;
            background-color: #ece5dd;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
	.chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 10px;
        }
	.message {
            max-width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 20px;
        }

        .message.sent {
            background-color: #dcf8c6;
            align-self: flex-end;
        }

        .message.received {
            background-color: #ffffff;
            align-self: flex-start;
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
	<button type="button" class="btn btn-primary btn-lg rounded-circle position-fixed"
		style="bottom: 20px; right: 20px;" data-bs-toggle="modal" data-bs-target="#chatModal">
		<i class="bi bi-chat-dots"></i>
	</button>

	<!-- Chat Modal -->
	
	<div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">

	<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content" >
				<div class="modal-header">
					<h5 class="modal-title" id="chatModalLabel">Chat</h5>
					<!-- <input class="modal-title invisible" value="<?= session()->get('username');?>" name="userLabel" id="userLabel"><?= session()->get('username');?></> -->
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body chat-container">
					<!-- Chat Messages -->
					<div class="message chat-messages" id="messages" style="height: 100%; width:100%; overflow-y: auto;">
						<!-- Messages will be appended here -->
						<?php if (!empty($message)): ?>
                            <?php foreach ($message as $chat): ?><br>
								<?php if ($chat['created_by'] === session()->get('id')):?>
									<div class="text-start message sent">
									<?= session()->get('username') .' : ' . ' <br>' . $chat['message'] ?>
									</div>
								<?php else:?>
									<?php if (empty($user['username'])): $user = new UserModel();$user = $user->getUserByID($chat['created_by']); endif;?>
									<div class="text-end message received">
									<?= $user['username'].'('.$user['id'].')'.' : ' . '<br>' . $chat['message'] ?>
									</div>
								<?php endif?>
                               
                            <?php endforeach; ?>
							<?php endif;?>
					</div>
				</div>
				<!-- <div class="modal-footer"> -->
				<form class="row g-3" action="/messaging/store" method="post">	
					<?php if (session()->get('role') == 'admin'): ?>
					<div class="mb-3">
					<input type="text" id="text" name="text"  style="width:80%;margin:10px;" placeholder="Type your message here">
					<input type="text" id="userid" name="userid"  style="width:80%;margin:10px;" placeholder="send to userid">
					<button id="submit" type="submit" value="POST" class="btn btn-primary">Send</button>
					</div>
						<?php else:?>
				<div class="mb-3">
					<input type="text" id="text" name="text"  style="width:80%;margin:10px;" placeholder="Type your message here">
					<button id="submit" type="submit" value="POST" class="btn btn-primary">Send</button>
					<input id="userid" name="userid" value="1" class="invisible" >
					
					</div>
					<?php endif;?>
				</form>
				<!-- </div> -->
				</div>
			</div>
		</div>
		
	</div>


	<!-- Jquery dan Bootsrap JS -->
	<script src="<?= base_url('js/jquery.min.js') ?>"></script>
	<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
	<script>
		var conn = new WebSocket('ws://localhost:8282');

		var client = {
			user_id: <?php echo session()->get('id'); ?>,
			user_name: <?php echo session()->get('id'); ?>,
			recipient_id: null,
			type: 'socket',
			token: null, 
			message: null
		};

		conn.onopen = function (e) {
			conn.send(JSON.stringify(client));
			$('#chatModalLabel').append('<span color="green"> Successfully connected as user ' + client.user_id + '</span><br>');
		};

		conn.onmessage = function (e) {
			var chatMessages = document.querySelector('.chat-messages');
			var data = JSON.parse(e.data);
			
			if (data.message) {
				$('#messages').append('<div class="text-end message received">'  + client.user_name + '(' + data.user_id + ')' + ' : ' + '<br>'+ data.message  + '</div>');
			}
			if (data.type === 'token') {
				$('#token').html('JWT Token : ' + data.token);
			}
			chatMessages.innerHTML += $('#messages').val();
			chatMessages.scrollTop = chatMessages.scrollHeight;
		};

		$('#submit').click(function () {
			send();
		});

		function send() {
			client.message = $('#text').val();
			var chatMessages = document.querySelector('.chat-messages');
			client.token = $('#token').text().split(': ')[1];
			// client.recipient_id = 1;
			client.type = 'chat';
			if ($('#userid').val === '') {
				client.recipient_id = 1;
			} else {
			client.recipient_id = $('#userid').val;
			}
			$('#token').empty();
			$('#recipient_id').empty();
			$('#messages').append('<div class="text-start message sent">'   + ' : ' + '<br>' + client.message + '</div>' );
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
	</script>
</body>
<br>
<footer>
	<div class="card-footer text-center">Made with 🩷</div>
</footer>

</html>