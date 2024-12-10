
// Đóng box chat
document.getElementById('closeChatBtn').addEventListener('click', function () {
    document.getElementById('chatBox').style.display = 'none';
});

function openChat(senderName, receiverId, idHienTai) {
    // Hiển thị popup chat
    document.getElementById('chatBox').style.display = 'block';

    // Cập nhật tên người gửi trong tiêu đề chat
    document.getElementById('chatUserName').textContent = 'Chat với: ' + senderName;

    document.querySelector('#chatBox .form-chat button').setAttribute('data-receiverid',receiverId);

    // Gọi AJAX hoặc phương thức khác để tải tin nhắn từ server với `receiverId`
    fetchMessages(receiverId,idHienTai);
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
                    messageDiv.innerHTML = `<div class="my-message"><strong>Me:</strong> ${message.message}</div>`;
                } else {
                    let fullName = `${message.sender.ho_va_ten}`;
                    let nameParts = fullName.split(' ');
                    let firstName = nameParts[nameParts.length - 1];
                    // Tin nhắn của người khác (nhận được)
                    messageDiv.innerHTML = `<div class="other-message"><strong>${firstName}:</strong> ${message.message}</div>`;
                }
                chatMessages.appendChild(messageDiv);
            });
        });
}

// Hàm gửi tin nhắn
function sendMessage() {
    const btnGui = document.querySelector('#chatBox .form-chat button');
    if(btnGui){
        btnGui.addEventListener('click',function(){
            let receiverId = btnGui.getAttribute('data-receiverid');
            let userId = btnGui.getAttribute('data-userid');
            const messageInput = document.getElementById('messageInput');
            const chatMessages = document.getElementById('chatMessages');
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
                    messageDiv.classList.add('chat-message');
                    messageDiv.innerHTML = `<div class="my-message"><strong>Me:</strong> ${data.data.message}</div>`;
                    chatMessages.appendChild(messageDiv);
                }).then(()=>{
                    messageInput.value = '';
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                });
            }
        });
    }
}
