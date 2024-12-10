//chat Truc Tiep
document.addEventListener('DOMContentLoaded',()=>{
    chatLS();
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


// Hàm gửi tin nhắn
function sendMessage() {
    const messageInput = document.getElementById('messageInput');
    const chatMessages = document.getElementById('chatMessages');
    const messageText = messageInput.value;
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
                message: messageText
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
