const utente = document.getElementById('user').textContent;
const btnLogout = document.getElementById('btn-logout');
const btnOpenFormToChangeImage = document.getElementById('btn-open-form-image')
const btnSearch = document.getElementById('btn-search');
const textBar = document.getElementById('words');
const wrapUsers = document.querySelector('.users-list-wrap-users');
const btnCloseImageForm = document.getElementById('btn-close-img-form');
const wrapImageForm = document.querySelector('.wrap-form-image');
const btnImg = document.getElementById('btn-img');

let msgError = document.querySelector('.error-msg');

//GET ALL THE USERS

displayTheUsers();
setInterval(()=>displayTheUsers(),10000); 

function displayTheUsers(){
    fetch("./php/get_users.php").then(res=>res.json())
    .then(data=>{
        //console.log(data);
        if(data.response == 0){
            setError();
            msgError.innerHTML = data.message;
            return;
        }
        if(data.response == 1){
            restoreResult();
            wrapUsers.innerHTML = generateUsers(data.users);

        }
    })
}


btnLogout.addEventListener('click',userLogout);
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

//Display the error from server
function setError(){
    
    let wrapError = document.querySelector('.users-list-wrap-no-results');
    

    wrapUsers.style.display = "none";
    wrapError.style.display = "flex";
    msgError.style.display = "flex";
}

//Restore the wrap users from error
function restoreResult(){
    let wrapError = document.querySelector('.users-list-wrap-no-results');
    

    wrapUsers.style.display = "block";
    wrapError.style.display = "none";
    msgError.style.display = "none";
    msgError.innerHTML = "";
}

function generateUsers(users){
    console.log(users);

    let rows = "";

    users.map(user=>{
        let row = `
            <div data-user=${user.username} style=display:${user.username == utente ? "none":"flex"} class="wrap-friend">
                <div><img src="${user.img == "default" ? "./src/no-img.png":"./src/images/"+user.img}"></div>
                <div>
                    <p><a class="user-link" href="http://localhost/xx_prozzape/chat_area.php?user=${user.username}">${user.username}</a></p>
                    <p>Last message</p>
                </div>
                <div class="wrap-friend-online">
                    <div class="${user.status == "online"?"online":"offline"}"></div>
                </div>
            </div>
        `;
        rows += row;
    })

    return rows;
}


btnSearch.addEventListener('click',activeSearchBar);
function activeSearchBar(){
    if(btnSearch.classList.contains('off')){
        textBar.disabled = false;
        textBar.focus();
        btnSearch.classList.remove('off');
    }else{
        textBar.disabled = true;
        btnSearch.classList.add('off');
    }
}



textBar.addEventListener('keyup',searchUser);
function searchUser(e){
    let elemets =  document.querySelectorAll('.wrap-friend');
    let userInput = e.target.value;
    
    elemets.forEach(element=> {
        if(element.dataset.user.includes(userInput)){
            element.style.display = "flex"
        }else{
            element.style.display = "none";
        }
    })
}




btnOpenFormToChangeImage.addEventListener('click',openImageForm)
function openImageForm(){
    let i = 0;
    wrapImageForm.style.display = "block";
    let interv = setInterval(()=>{
        wrapImageForm.style.opacity = (i/100);
        i++
        if(i == 100){
            clearInterval(interv);
        }
    },2)
}

btnCloseImageForm.addEventListener('click',closeImageForm);
function closeImageForm(){
    let i = 100;
    let inter = setInterval(()=>{
        wrapImageForm.style.opacity = (i/100);
        i--;
        if(i == 0){
            clearInterval(inter);
            wrapImageForm.style.display = "none";
            
        }
    },2)
}

