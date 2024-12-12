// Đóng box chat
document.getElementById('closeChatBtn').addEventListener('click', function () {
    document.getElementById('chatBox').style.display = 'none';
});

function openChat(senderName, receiverId, idHienTai) {
    // Hiển thị popup chat
    document.getElementById('chatBox').style.display = 'block';

    // Cập nhật tên người gửi trong tiêu đề chat
    document.getElementById('chatUserName').textContent = 'Chat với: ' + senderName;

    document.querySelector('#chatBox .form-chat button').setAttribute('data-receiverid', receiverId);

    // Gọi AJAX hoặc phương thức khác để tải tin nhắn từ server với `receiverId`
    fetchMessages(receiverId, idHienTai);
    sendMessage();
}

function fetchMessages(receiverId, idHienTai) {
    // Gửi request AJAX để lấy các tin nhắn giữa người dùng hiện tại và receiverId
    fetch(`/admin/chat/${receiverId}`)
        .then(response => response.json())
        .then(data => {
            // Xử lý dữ liệu tin nhắn
            const chatMessages = document.getElementById('chatMessages');
            chatMessages.innerHTML = ''; // Xóa các tin nhắn cũ

            data.messages.forEach(message => {
                let messageDiv = document.createElement('div');
                messageDiv.classList.add('chat-message');

                if (message.sender_role === "nhanVien" || message.sender_role === "quanTriVien") {
                    // Tin nhắn của người dùng hiện tại (gửi đi)
                    messageDiv.innerHTML = `<div class="my-message"><div class="bubble"><strong>Me:</strong> ${message.message}</div></div>`;
                } else {
                    let fullName = `${message.sender.ho_va_ten}`;
                    let nameParts = fullName.split(' ');
                    let firstName = nameParts[nameParts.length - 1];
                    // Tin nhắn của người khác (nhận được)
                    messageDiv.innerHTML = `<div class="other-message"><div class="bubble"><strong>${firstName}:</strong> ${message.message}</div></div>`;
                }
                chatMessages.appendChild(messageDiv);
            });

            // Tự động cuộn xuống khi có tin nhắn mới
            chatMessages.scrollTop = chatMessages.scrollHeight;
        });
}

// Hàm gửi tin nhắn
function sendMessage() {
    const btnGui = document.querySelector('#chatBox .form-chat button');
    const messageInput = document.getElementById('messageInput');
    const chatMessages = document.getElementById('chatMessages');

    // Kiểm tra nếu nút gửi tồn tại
    if (btnGui) {
        // Gửi tin nhắn khi nhấn nút gửi
        btnGui.addEventListener('click', function () {
            sendTextMessage(messageInput, chatMessages);
        });

        // Gửi tin nhắn khi nhấn phím Enter
        messageInput.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Ngăn chặn hành động mặc định (ngắt dòng)
                sendTextMessage(messageInput, chatMessages);
            }
        });
    }

    // Hàm xử lý gửi tin nhắn
    function sendTextMessage(messageInput, chatMessages) {
        let receiverId = btnGui.getAttribute('data-receiverid');
        let userId = btnGui.getAttribute('data-userid');
        const messageText = messageInput.value;

        if (messageText.trim() !== "") {
            // Gửi yêu cầu AJAX để gửi tin nhắn
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
                messageDiv.classList.add('chat-message');
                messageDiv.innerHTML = `<div class="my-message"><div class="bubble"><strong>Me:</strong> ${data.data.message}</div></div>`;
                chatMessages.appendChild(messageDiv);
            }).then(() => {
                messageInput.value = ''; // Xóa nội dung sau khi gửi
                chatMessages.scrollTop = chatMessages.scrollHeight; // Tự động cuộn xuống
            });
        }
    }
}
