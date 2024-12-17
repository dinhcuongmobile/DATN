document.addEventListener('DOMContentLoaded', () => {
    // const chatPopup = document.getElementById('chatPopup');
    // const userId = chatPopup.dataset.userid;

    // window.Echo.private(`chat.${userId}`)
    //     .listen('MessageSent', (e) => {
    //         const chatBody = document.querySelector('#chatPopup .chat-body');
    //         let messageDiv = document.createElement('div');
    //         messageDiv.classList.add('message', 'sender');
    //         let fullName = document.querySelector('#chatPopup .chat-title').textContent;
    //         let nameParts = fullName.split(' ');
    //         let firstName = nameParts[nameParts.length - 1];
    //         messageDiv.innerHTML = `<span class="sender-name">${firstName}:</span> ${message.message}`;
    //         chatBody.appendChild(messageDiv);
    //         chatBody.scrollTop = chatBody.scrollHeight;
    //     });

    sendMessage();
    fetchMessagePopup();
});


let chatInterval = null;
let isEventAttached = false;

function fetchMessagePopup() {
    fetch("/admin/message-popup")
        .then(response => response.json())
        .then(data => {

            const messageCount = document.querySelector('#messagesDropdown span');
            const messageContent = document.querySelector(".liMessagesDropdown #messageContent");

            // Cập nhật badge counter
            messageCount.textContent = data.countMessage > 0 ? `${data.countMessage}+` : "0";

            messageContent.innerHTML = "";

            if (data.messages.length > 0) {
                data.messages.forEach(item => {

                    let html = `
                        <a class="dropdown-item d-flex align-items-center" style="cursor: pointer"
                            onclick="openChat('${item.sender.ho_va_ten}', '${item.user_id}')">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="/assets/images/user/12.jpg" alt="err">
                            </div>
                            <div class="font-weight-bold">
                                <div class="text-truncate">${item.message}</div>
                                <div class="small text-gray-500">${item.sender.ho_va_ten} · ${item.created_at_diff}</div>
                            </div>
                        </a>
                    `;
                    messageContent.insertAdjacentHTML('beforeend', html);
                });
            }
        })
        .catch(error => console.error("Error fetching Messages:", error));
}
setInterval(fetchMessagePopup, 5000);

// Đóng box chat
function closeChat() {
    document.getElementById('chatPopup').style.display = 'none';

    // Dừng interval khi đóng chat
    if (chatInterval) {
        clearInterval(chatInterval);
    }

    setTimeout(() => {
        document.querySelector('.liMessagesDropdown').classList.add('show');
        document.querySelector('.liMessagesDropdown #messagesDropdown').setAttribute('aria-expanded', 'true');
        document.querySelector('.divMessagesDropdown').classList.add('show');
    }, 100);
}

function openChat(senderName, receiverId) {
    const chatPopup = document.getElementById('chatPopup');
    chatPopup.style.display = chatPopup.style.display === 'block' ? 'none' : 'block';

    document.querySelector('#chatPopup .chat-title').textContent = 'Chat với: ' + senderName;
    chatPopup.setAttribute('data-receiverid', receiverId);

    fetchMessages(receiverId);

    // Xóa interval cũ nếu có
    if (chatInterval) {
        clearInterval(chatInterval);
    }

    // Tạo interval mới để load tin nhắn
    chatInterval = setInterval(() => fetchMessages(receiverId), 3000);
}

function fetchMessages(receiverId) {
    fetch(`/admin/chat/${receiverId}`)
        .then(response => response.json())
        .then(data => {
            const chatBody = document.querySelector('#chatPopup .chat-body');
            chatBody.innerHTML = '';

            data.messages.forEach(message => {
                let messageDiv = document.createElement('div');
                if (message.sender_role === "nhanVien" || message.sender_role === "quanTriVien") {
                    messageDiv.classList.add('message', 'receiver');
                    messageDiv.innerHTML = `<span class="receiver-name">Me:</span> ${message.message}`;
                } else {
                    messageDiv.classList.add('message', 'sender');
                    let fullName = `${message.sender.ho_va_ten}`;
                    let nameParts = fullName.split(' ');
                    let firstName = nameParts[nameParts.length - 1];
                    messageDiv.innerHTML = `<span class="sender-name">${firstName}:</span> ${message.message}`;
                }
                chatBody.appendChild(messageDiv);
            });
            chatBody.scrollTop = chatBody.scrollHeight;
        });
}

function sendMessage() {
    const btnGui = document.querySelector('#chatPopup .chat-footer button');
    const messageInput = document.querySelector('#chatPopup #chatInput');

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
    const btnGui = document.querySelector('#chatPopup .chat-footer button');
    const messageInput = document.querySelector('#chatPopup #chatInput');
    const chatBody = document.querySelector('#chatPopup .chat-body');

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
            messageInput.value = '';
            chatBody.scrollTop = chatBody.scrollHeight;
        });
    }
}





