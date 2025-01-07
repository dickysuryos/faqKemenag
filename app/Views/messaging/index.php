<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<?php
use App\Models\MessagingModel;
use App\Models\UserModel;
use WebSocket\Client;
$user = null;
$counter = 0;
$session = session();
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
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
<div class="container mt-5">
    <!-- Chat Modal -->

    <div id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
        <div class="">
            <div class="">
                <!-- <div class="modal-header"> -->
                <h5 class="modal-title" id="chatModalLabel">Chat</h5><br>
                <div class="chat-container">
                    <!-- Chat Messages -->
                    <div class="message chat-messages" id="messages"
                        style="height: 100%; width:100%; overflow-y: auto;">
                        <!-- Messages will be appended here -->
                        <?php if (!empty($message)): ?>

                            <?php foreach ($message as $chat):
                                ?><br>
                                <?php if ($chat['created_by'] === session()->get('id')): ?>

                                    <div class="text-end message received">
                                        <?= session()->get('username') . ' : ' . ' <br>' . $chat['message'] ?>
                                    </div>

                                <?php else:
                                    ?>
                                    <input id="user_name" name="user_name"
                                        value="<?php $users = new UserModel();
                                        echo $users->getUserByID($chat['created_by'])['username']; ?>"
                                        class="invisible">
                                    <?php if ($chat['isRead'] == 0):
                                        $counter += 1;
                                    endif; ?>
                                    <?php if (empty($user['username'])):
                                        $user = new UserModel();
                                        $user = $user->getUserByID($chat['created_by']);
                                    endif; ?>
                                    <div class="text-start message sent">
                                        <?= $user['username'] . '(' . $user['id'] . ')' . ' : ' . '<br>' . $chat['message'] ?>

                                    </div>
                                <?php endif ?>

                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- <div class="modal-footer"> -->
                <form id="formMessage" class="row g-3" action="/messaging/store" method="post">
                    <?php if (session()->get('role') === 'admin'): ?>
                        <div class="mb-3">
                            <input type="text" id="text" name="text" style="width:80%;margin:10px;"
                                placeholder="Type your message here">
                            <input type="text" id="userid" name="userid" style="width:80%;margin:10px;"
                                placeholder="send to userid">
                            <button id="submit" type="submit" value="POST" class="btn btn-primary">Send</button>
                        </div>

                    <?php else: ?>
                        <div class="mb-3">
                            <input id="userid" name="userid" value="1" class="invisible">
                            <input type="text" id="text" name="text" style="width:80%;margin:10px;"
                                placeholder="Type your message here">
                            <button id="submit" type="submit" value="POST" class="btn btn-primary">Send</button>
                        </div>
                    <?php endif; ?>
                </form>

                <script>

                    var conn = new WebSocket('ws://localhost:8082');

                    var client = {
                        user_id: <?= $session->get('id'); ?>,
                        user_name: $('#user_name').val(),
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
                            $('#messages').append('<div class="text-start message sent">' + client.user_name + '(' + data.user_id + ')' + ' : ' + '<br>' + data.message + '</div>');
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

                    function send() {
                        client.message = $('#text').val();
                        var chatMessages = document.querySelector('.chat-messages');
                        client.token = $('#token').text().split(': ')[1];
                        client.type = 'chat';
                        if ($('#userid').val === null) {
                            client.recipient_id = 1;
                        } else {

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
                            // event.preventDefault(); // Prevent the default form submission
                            send(); // Call the sendMessage function
                            document.getElementById('formMessage').submit();
                        }
                    });

                    window.onload = function () {

                        var chatMessages = document.querySelector('.chat-messages');
                        chatMessages.innerHTML += $('#messages').val();
                        chatMessages.scrollTop = chatMessages.scrollHeight;

                    }
                </script>
            </div>
        </div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<?= $this->endSection() ?>