document.addEventListener('DOMContentLoaded', () => {
    const chatPopup = document.getElementById('chatPopup');
    const userId = chatPopup.dataset.userid;

    // Lắng nghe sự kiện trên kênh Private
    window.Echo.private(`chat.${userId}`)
        .listen('MessageSent', (e) => {
            const chatBody = document.querySelector('#chatPopup .chat-body');
            let messageDiv = document.createElement('div');
            messageDiv.classList.add('message', 'sender');
            let fullName = document.querySelector('#chatPopup .chat-title').textContent;
            let nameParts = fullName.split(' ');
            let firstName = nameParts[nameParts.length - 1];
            messageDiv.innerHTML = `<span class="sender-name">${firstName}:</span> ${message.message}`;
            chatBody.appendChild(messageDiv);
            chatBody.scrollTop = chatBody.scrollHeight;
        });
});
// Đóng box chat
function closeChat() {
    document.getElementById('chatPopup').style.display = 'none';
    setTimeout(() => {
        document.querySelector('.liMessagesDropdown').classList.add('show');
        document.querySelector('.liMessagesDropdown #messagesDropdown').setAttribute('aria-expanded','true');
        document.querySelector('.divMessagesDropdown').classList.add('show');
    }, 100);
}

function openChat(senderName, receiverId) {
    const chatPopup = document.getElementById('chatPopup');
    chatPopup.style.display = chatPopup.style.display === 'block' ? 'none' : 'block';
    // Hiển thị popup chat

    // // Cập nhật tên người gửi trong tiêu đề chat
    document.querySelector('#chatPopup .chat-title').textContent = 'Chat với: ' + senderName;
    chatPopup.setAttribute('data-receiverid',receiverId);

    // // Gọi AJAX hoặc phương thức khác để tải tin nhắn từ server với `receiverId`
    fetchMessages(receiverId);
    sendMessage();
}

function fetchMessages(receiverId) {
    // Gửi request AJAX để lấy các tin nhắn giữa người dùng hiện tại và receiverId
    fetch(`/admin/chat/${receiverId}`)
        .then(response => response.json())
        .then(data => {

            // Xử lý dữ liệu tin nhắn
            const chatBody = document.querySelector('#chatPopup .chat-body');
            chatBody.innerHTML = ''; // Xóa các tin nhắn cũ

            data.messages.forEach(message => {
                let messageDiv = document.createElement('div');

                if (message.sender_role === "nhanVien" || message.sender_role === "quanTriVien") {
                    messageDiv.classList.add('message', 'receiver');
                    // Tin nhắn của người dùng hiện tại (gửi đi)
                    messageDiv.innerHTML = `<span class="receiver-name">Me:</span> ${message.message}`;
                } else {
                    messageDiv.classList.add('message', 'sender');
                    let fullName = `${message.sender.ho_va_ten}`;
                    let nameParts = fullName.split(' ');
                    let firstName = nameParts[nameParts.length - 1];
                    // Tin nhắn của người khác (nhận được)
                    messageDiv.innerHTML = `<span class="sender-name">${firstName}:</span> ${message.message}`;
                }
                chatBody.appendChild(messageDiv);
            });
            chatBody.scrollTop = chatBody.scrollHeight;
        });
}

// Hàm gửi tin nhắn
function sendMessage() {
    const btnGui = document.querySelector('#chatPopup .chat-footer button');
    const messageInput = document.querySelector('#chatPopup #chatInput');
    const chatBody = document.querySelector('#chatPopup .chat-body');

    function sendMessageHandler() {
        let receiverId = btnGui.closest('#chatPopup').getAttribute('data-receiverid');
        let userId = btnGui.closest('#chatPopup').getAttribute('data-userid');
        const messageText = messageInput.value;

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
                let messageDiv = document.createElement('div');
                messageDiv.classList.add('message', 'receiver');
                messageDiv.innerHTML = `<span class="receiver-name">Me:</span> ${data.data.message}`;
                chatBody.appendChild(messageDiv);
            }).then(() => {
                messageInput.value = '';
                chatBody.scrollTop = chatBody.scrollHeight;
            });
        }
    }

    // Thêm sự kiện click cho nút "Gửi"
    if (btnGui) {
        btnGui.addEventListener('click', sendMessageHandler);
    }

    // Thêm sự kiện keydown cho ô nhập tin nhắn (nhấn Enter)
    if (messageInput) {
        messageInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault(); // Ngăn form gửi mặc định
                sendMessageHandler(); // Gọi hàm gửi tin nhắn
            }
        });
    }
}


