<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Chat Application</title>
    <style>
        #chat-window{
            position: fixed;
            bottom: 0;
            right: 0;
            padding: 0.75rem;
            margin-bottom: 100px;
            margin-right: 100px;
            border-radius: 10px;
            display: none;
        }
        #toggle-chat{
            position: fixed;
            bottom: 0;
            right: 0;
            margin-bottom: 30px;
            margin-right: 30px;
            width: 50px;
            height: 50px;
            border-radius: 50px;
            background-color: #134A85;
            color: white;
            border: none;
            box-shadow: black 0px 0px 5px;
        }
        
        .carousel-item img {
            border-radius: 10px; /* Sesuaikan dengan radius yang diinginkan */
        }
        .dark-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.2); /* Warna hitam dengan opacity 0.5 */
            border-radius: 10px;
        }
        #chat-messages {
            height: 320px;
            overflow-y: scroll;
            padding: 10px;
            display: flex;
            flex-direction: column;
        }
     
    </style>

</head>
<body>
    <?php include 'header.php'; ?>


    <div style="text-align: center; margin-top: 20px; color: #424242;">
        <h1>Selamat Datang!<br>FILKOM Library</h1>
    </div>

    <button id="toggle-chat" >?</button>
        
    <div id="carouselExample" class="carousel slide" style="width: 600px; position: relative; margin: auto; margin-top: 30px;">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img1.jpg" class="d-block w-100" alt="foto">
                <div class="dark-overlay"></div> <!-- Lapisan gelap -->
            </div>
            <div class="carousel-item">
                <img src="img2.jpg" class="d-block w-100" alt="foto">
                <div class="dark-overlay"></div> <!-- Lapisan gelap -->
            </div>
            <div class="carousel-item">
                <img src="img3.jpg" class="d-block w-100" alt="foto">
                <div class="dark-overlay"></div> <!-- Lapisan gelap -->
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div style="text-align: center; margin-top: 20px; color: #424242;">
        <p>Hubungi kami dengan menekan tombol di kanan bawah</p>
    </div>

    <div id="chat-window" style="background-color: white; box-shadow: rgba(0, 0, 0, 0.300) 0px 0px 10px;">
        <div id="chat-messages"></div>
        <div id="chat-input">
            <input type="text" id="username" class="form-control mb-2" placeholder="Username" />
            <input type="text" id="message" class="form-control mb-2" placeholder="Message" />
            <button id="send-btn" class="btn mb-2" style="background-color: #134A85; color: white;">Send</button>
        </div>
    </div>

    <?php include 'footer.php'; ?>


        
        
        
        
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        
        const chatWindow = document.getElementById('chat-window');
        const chatMessages = document.getElementById('chat-messages');
        const usernameInput = document.getElementById('username');
        const messageInput = document.getElementById('message');
        const sendBtn = document.getElementById('send-btn');
        const toggleChatBtn = document.getElementById('toggle-chat');

        let username = 'Anonymous';

        // Toggle chat window
        toggleChatBtn.addEventListener('click', () => {
            if (chatWindow.style.display === 'none') {
                chatWindow.style.display = 'block';
                toggleChatBtn.textContent = 'Close';
            } else {
                chatWindow.style.display = 'none';
                toggleChatBtn.textContent = 'Chat';
            }
        });

        // Send chat message
        sendBtn.addEventListener('click', () => {
            const message = messageInput.value.trim();
            if (message) {
                sendChatMessage(username, message);
                messageInput.value = '';
            }
        });

        // Update username
        usernameInput.addEventListener('input', () => {
            username = usernameInput.value.trim() || 'Anonymous';
        });

        // Get chat messages periodically
        setInterval(getChatMessages, 500);

        // Send chat message to server
        function sendChatMessage(username, message) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'save_chat.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    console.log('Chat message sent successfully');
                }
            };
            xhr.send('username=' + encodeURIComponent(username) + '&message=' + encodeURIComponent(message));
        }

        // Get chat messages from server
        function getChatMessages() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_chat.php', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    chatMessages.innerHTML = xhr.responseText.replace(/\n/g, '<br>');
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }
            };
            xhr.send();
        }
    </script>



    
</body>
</html>