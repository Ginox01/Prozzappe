const user = document.getElementById('user').textContent;
const btnLogout = document.getElementById('btn-logout');
const btnSearch = document.getElementById('btn-search');
const textBar = document.getElementById('words');


btnLogout.addEventListener('click',userLogout);
function userLogout(){
    fetch("./php/logout.php",{
        method:'POST',
        header:{'Content-Type':'application/json'},
    }).then(res=>res.redirected())
    .then(data=>{
        console.log(data);
    })
}

displayTheUsers();
function displayTheUsers(){
    //
}