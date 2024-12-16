//chat Truc Tiep
document.addEventListener('DOMContentLoaded',()=>{
    // const chatContainer = document.querySelector('#chatContainer .chat-input button');
    // const userId = chatContainer.dataset.userid;
    // window.Echo.private(`chat.${userId}`)
    //         .listen('MessageSent', (e) => {
    //             const chatMessages = document.getElementById('chatMessages');
    //             const adminMessage = document.createElement('div');
    //             adminMessage.classList.add('message', 'admin');
    //             adminMessage.innerText = e.message.message;
    //             chatMessages.appendChild(adminMessage);
    //             chatMessages.scrollTop = chatMessages.scrollHeight;
    //         });

    sendMessage();
});


let chatInterval = null;
let isEventAttached = false;

function closeChat() {
    const chatContainer = document.getElementById('chatContainer');
    const chatButton = document.getElementById('chatButton');

    chatContainer.classList.remove('show');
    setTimeout(() => {
        chatContainer.style.display = 'none';
        chatButton.style.display = 'flex';
        // Dừng interval khi đóng chat
        if (chatInterval) {
            clearInterval(chatInterval);
        }
    }, 300);
}

function toggleChat(idHienTai) {
    const chatContainer = document.getElementById('chatContainer');
    const chatButton = document.getElementById('chatButton');

    if (chatContainer.style.display === 'none' || chatContainer.style.display === '') {
        chatContainer.style.display = 'flex';
        setTimeout(() => {
            chatContainer.classList.add('show');
        }, 10);

        chatButton.style.display = 'none';
    } else {
        chatContainer.classList.remove('show');
        setTimeout(() => {
            chatContainer.style.display = 'none';
            chatButton.style.display = 'flex';
        }, 300);
    }

    fetchMessages(idHienTai);

    // Xóa interval cũ nếu có
    if (chatInterval) {
        clearInterval(chatInterval);
    }

    chatInterval = setInterval(() => fetchMessages(idHienTai), 3000);

}
function fetchMessages(idHienTai) {
    fetch(`/home/chat/${idHienTai}`)
        .then(response => response.json())
        .then(data => {

            const chatMessages = document.getElementById('chatMessages');
            chatMessages.innerHTML = '';

            data.messages.forEach(message => {
                const userMessage = document.createElement('div');

                if (message.sender_role === "nhanVien" || message.sender_role === "quanTriVien") {

                    userMessage.classList.add('message', 'admin');
                    userMessage.innerText = message.message;

                } else {

                    userMessage.classList.add('message', 'user');
                    userMessage.innerText = message.message;

                }

                chatMessages.appendChild(userMessage);
            });

            chatMessages.scrollTop = chatMessages.scrollHeight;
        });
}


// Hàm gửi tin nhắn
function sendMessage() {
    const btnGui = document.querySelector('#chatContainer .chat-input button');
    const messageInput = document.querySelector('#chatContainer .chat-input #messageInput');

    if (!isEventAttached) {
        isEventAttached = true;


        if (btnGui) {
            btnGui.addEventListener('click', sendMessageHandler);
        }

        if (messageInput) {
            messageInput.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    sendMessageHandler();
                }
            });
        }
    }


}

function sendMessageHandler() {
    const chatMessages = document.getElementById('chatMessages');
    const messageText = messageInput.value;
    const userId = document.querySelector('#chatContainer .chat-input button').getAttribute('data-userid');
    const receiverId = 1; // ID admin hoặc người nhận

    if (messageText.trim() !== "") {
        fetch("/send-message", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                receiver_id: receiverId,
                message: messageText,
                user_id: userId
            })
        }).then(response => response.json()).then(data => {
            const userMessage = document.createElement('div');
            userMessage.classList.add('message', 'user');
            userMessage.innerText = messageText;
            chatMessages.appendChild(userMessage);
            messageInput.value = '';
            chatMessages.scrollTop = chatMessages.scrollHeight;
        });
    }
}

