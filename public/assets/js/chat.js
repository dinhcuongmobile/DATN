//chat Truc Tiep
document.addEventListener('DOMContentLoaded',()=>{
    chatLS();

    const chatContainer = document.querySelector('#chatContainer .chat-input button');
    const userId = chatContainer.dataset.userid;
    window.Echo.private(`chat.${userId}`)
            .listen('MessageSent', (e) => {
                const chatMessages = document.getElementById('chatMessages');
                const adminMessage = document.createElement('div');
                adminMessage.classList.add('message', 'admin');
                adminMessage.innerText = e.message.message;
                chatMessages.appendChild(adminMessage);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            });
});
function chatLS(){
    const chatLS = document.querySelectorAll('.chatLS');
    const chatContainer = document.getElementById('chatContainer');
    const chatButton = document.getElementById('chatButton');
    if(chatLS){
        chatLS.forEach((el)=>{
            el.addEventListener('click',function(){
                if (chatContainer.style.display === 'none' || chatContainer.style.display === '') {
                    chatContainer.style.display = 'flex'; // Hiện hiển thị
                    setTimeout(() => {
                        chatContainer.classList.add('show'); // Thêm lớp 'show' để hiện thị
                    }, 10); // Thêm độ trễ nhỏ để hiệu ứng hoạt động

                    chatButton.style.display = 'none'; // Ẩn nút chat
                } else {
                    chatContainer.classList.remove('show'); // Xóa lớp 'show' để ẩn đi
                    setTimeout(() => {
                        chatContainer.style.display = 'none'; // Ẩn cửa sổ sau khi ẩn hiệu ứng
                        chatButton.style.display = 'flex'; // Hiện lại nút chat
                    }, 300); // Thời gian trễ phù hợp với hiệu ứng
                }
            });
        });
    }
}

function closeChat() {
    const chatContainer = document.getElementById('chatContainer');
    const chatButton = document.getElementById('chatButton');

    chatContainer.classList.remove('show'); // Xóa lớp 'show' để ẩn đi
    setTimeout(() => {
        chatContainer.style.display = 'none'; // Ẩn cửa sổ sau khi ẩn hiệu ứng
        chatButton.style.display = 'flex'; // Hiện lại nút chat
    }, 300); // Thời gian trễ phù hợp với hiệu ứng
}

function toggleChat(idHienTai) {
    const chatContainer = document.getElementById('chatContainer');
    const chatButton = document.getElementById('chatButton');

    if (chatContainer.style.display === 'none' || chatContainer.style.display === '') {
        chatContainer.style.display = 'flex'; // Hiện hiển thị
        setTimeout(() => {
            chatContainer.classList.add('show'); // Thêm lớp 'show' để hiện thị
        }, 10); // Thêm độ trễ nhỏ để hiệu ứng hoạt động

        chatButton.style.display = 'none'; // Ẩn nút chat
    } else {
        chatContainer.classList.remove('show'); // Xóa lớp 'show' để ẩn đi
        setTimeout(() => {
            chatContainer.style.display = 'none'; // Ẩn cửa sổ sau khi ẩn hiệu ứng
            chatButton.style.display = 'flex'; // Hiện lại nút chat
        }, 300); // Thời gian trễ phù hợp với hiệu ứng
    }

    fetchMessages(idHienTai);
}
function fetchMessages(idHienTai) {
    // Gửi request AJAX để lấy các tin nhắn giữa người dùng hiện tại và receiverId
    fetch(`/home/chat/${idHienTai}`)
        .then(response => response.json())
        .then(data => {
            // Xử lý dữ liệu tin nhắn
            const chatMessages = document.getElementById('chatMessages');
            chatMessages.innerHTML = ''; // Xóa các tin nhắn cũ

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
        });
}


// Hàm gửi tin nhắn
function sendMessage() {
    const messageInput = document.getElementById('messageInput');
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

