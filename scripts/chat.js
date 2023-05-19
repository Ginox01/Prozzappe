const wrapChatUser = document.querySelector('.wrap-chat-user');
const mittente = document.getElementById('mittente').value;
const destinatario = document.getElementById('destinatario').value;
const message = document.getElementById('message');

const btnCloseChat = document.getElementById('arrow');
btnCloseChat.addEventListener('click',closeChat);
function closeChat(){
    window.location.href = "./index.php";
}


const btnSendMessage = document.getElementById('send-message');
btnSendMessage.addEventListener('click',sentMessage);
function sentMessage(){
    let formData = new FormData;
    formData.append('mittente',mittente);
    formData.append('destinatario',destinatario);
    formData.append('message',message.value);

    fetch("./php/send_message.php",{
        method:"POST",
        header:{"Content-Type":"application/json"},
        body:formData
    }).then(res=>res.json())
    .then(data => {
        console.log(data);
    })
}