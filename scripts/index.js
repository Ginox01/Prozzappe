const user = document.getElementById('user').textContent;
const btnLogout = document.getElementById('btn-logout');
const btnSearch = document.getElementById('btn-search');
const textBar = document.getElementById('words');


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

displayTheUsers();
function displayTheUsers(){
    fetch("./php/get_users.php").then(res=>res.json())
    .then(data=>{
        console.log(data);
    })
}