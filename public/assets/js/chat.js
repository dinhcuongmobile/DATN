//chat Truc Tiep
function toggleChat() {
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

function sendMessage() {
    const messageInput = document.getElementById('messageInput');
    const chatMessages = document.getElementById('chatMessages');
    const messageText = messageInput.value;

    if (messageText.trim() !== "") {
        // Tạo phần tử tin nhắn của người dùng
        const userMessage = document.createElement('div');
        userMessage.classList.add('message', 'user');
        userMessage.innerText = messageText;
        chatMessages.appendChild(userMessage);

        // Tạo phần tử tin nhắn của admin (mô phỏng)
        setTimeout(() => {
            const adminMessage = document.createElement('div');
            adminMessage.classList.add('message', 'admin');
            adminMessage.innerText = "Cảm ơn bạn đã nhắn tin! Chúng tôi sẽ trả lời sớm.";
            chatMessages.appendChild(adminMessage);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }, 1000);

        // Cuộn xuống dưới cùng và xóa ô nhập
        chatMessages.scrollTop = chatMessages.scrollHeight;
        messageInput.value = '';
    }
}
