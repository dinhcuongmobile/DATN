function openChat(userName, message) {
    // Đảm bảo danh sách tin nhắn không bị ẩn
    document.getElementById("messagesDropdown").classList.add("show");

    // Cập nhật tên người chat và tin nhắn đầu tiên
    document.getElementById("chatUserName").innerText = "Chat với: " + userName;
    document.getElementById("chatMessages").innerHTML = `<div class="message">${message}</div>`;

    // Hiển thị khu vực chat
    document.getElementById("chatBox").style.display = 'block';

    // Lưu tên người đang chat
    currentChatUser = userName;
}

// Đóng màn hình chat khi bấm nút "X"
document.getElementById("closeChatBtn").addEventListener("click", function() {
    document.getElementById("chatBox").style.display = 'none';
});

// Gửi tin nhắn (nếu cần)
function sendMessage(event) {
    if (event.key === 'Enter') {
        const message = event.target.value;
        if (message.trim() !== "") {
            const chatMessages = document.getElementById("chatMessages");
            chatMessages.innerHTML += `<div class="message">${message}</div>`;
            event.target.value = "";
        }
    }
}
