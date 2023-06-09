const wrapChatUser = document.querySelector('.wrap-chat-user');
const mittente = document.getElementById('mittente').value;
const destinatario = document.getElementById('destinatario').value;
const message = document.getElementById('message');
const wrapChat = document.querySelector('.wrap-chat');

let closeBroswer = true;

function closeChat(){
    closeBroswer = false;
    window.location.href = "./index.php";
}

function clearChat(){
    wrapChat.innerHTML = "";
}

const intervallo = setInterval(()=>{
    getTheInfoOfTheDestinatario();
},500)

function getTheInfoOfTheDestinatario(){
    let formData = new FormData;
    formData.append('username',destinatario);

    fetch("./php/get_single_user.php",{
        method:"POST",
        header:{"Content-Type":"application/json"},
        body:formData
    }).then(res=>res.json())
    .then(data=>{
        console.log(data);

        if(data.response == 1){
             wrapChatUser.innerHTML = `
             <div class="im"><img src="${data.user.img == "default" ? "./src/no-img.png":"./src/images/"+data.user.img}"/></div>
             <div class="info">
                 <p id="arrow">←</p>
                 <h3>${data.user.username}</h3>
                 <span>${data.user.status}</span>
            </div>
             `;
             const btnCloseChat = document.getElementById('arrow');
            btnCloseChat.addEventListener('click',closeChat);
             return;
        }else{
            window.location.href = "./index.php";
        }
    })

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
            console.log(data)
        if(data.response == 1){
            message.value = "";
           
        }
        if(data.response == 0){
            console.log('err');
        }

    })
}

const interv =  setInterval(() => {
    displayMessage();
}, 500);

function displayMessage(){
    let formData = new FormData;
    formData.append('mittente',mittente);
    formData.append('destinatario',destinatario);

    fetch('./php/get_messages.php',{
        method:'POST',
        header:{'Content-Type':'application/json'},
        body:formData
    }).then(res=>res.json())
    .then(data=>{
        console.log(data);
        console.log(mittente);
        console.log(destinatario);

        if(data.response == 1){
            
            clearChat();
            displayTheChat(data);   
             
            
        }else if(data.response == 0){
            window.location.href = "./index.php";
        }
    })

}



function displayTheChat(data){
    data.chat.map(data=>{
        let mex = document.createElement('div'); 
             if(data.mittente == mittente && data.destinatario == destinatario){
                 console.log('Ginox ha inviato il messaggio!');
                 mex.setAttribute('class','txt-outcoming');
                 mex.innerHTML = `
                     <div class="details">
                         <p>${data.message}</p>
                     </div>`;
             }else if(data.mittente == destinatario && data.destinatario == mittente){
                 console.log("Ginox ha ricevuto il messaggio!");
                 mex.setAttribute('class','txt-incoming');
                 mex.innerHTML = `
                     <div class="details">
                         <p>${data.message}</p>
                     </div>`;
                
             }
             wrapChat.appendChild(mex);
            
    })
}

function userLogout(){
    fetch("./php/logout.php",{
        method:'POST',
        header:{'Content-Type':'application/json'},
    }).then(res=>res.json())
    .then(data=>{
        if(data.response==1){
           window.location.href = "./login_page.php";
        }
    })
}


window.addEventListener('beforeunload',()=>{
    if(closeBroswer){
        userLogout();
    }
});