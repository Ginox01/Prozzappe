const errorMsg = document.querySelector('.error-msg');

const mail = document.getElementById('mail');
const psw = document.getElementById('psw');
const btnShowOrHidePswField = document.getElementById('btn-show_hide_psw');
const btnLogin = document.getElementById('btn-login');

let token = document.getElementById('token').value;
console.log(token);

btnLogin.addEventListener('click',loginUser);

function loginUser(e){
    e.preventDefault();
    if(checkMail(mail,errorMsg) && checkPsw(psw,errorMsg)){
        console.log('ok');
        // HERE WILL BE SENT THE DATA TO SERVER FOR THE LOGIN +++++++++++++++++++++++++++++++++++
    }
}

function checkMail(field,err){
    let test = /@/;
    let fatherElement = field.parentNode;

    if(field.value.length < 6){
        fatherElement.className = "error";
        field.style.color = "red";
        field.focus();
        err.style.display = "flex";
        err.innerHTML = "Minimun chars required: 6";
        return false;
    }else if(!test.test(field.value)){
        fatherElement.className = "error";
        field.style.color = "red";
        field.focus();
        err.style.display = "flex";
        err.innerHTML = "Miss the char: '@' in mail field";
        return false;
    }else {
        fatherElement.className = "pass";
        field.style.color = "forestgreen";
        err.style.display = "none";
        err.innerHTML = "";
        return true;
    }
}

function checkPsw(field,err){
    let fatherElement = field.parentNode;
    if(field.value.length < 4){
        fatherElement.className = "error";
        field.style.color = "red";
        field.focus();
        err.style.display = "flex";
        err.innerHTML = "Minimun chars required: 4";
        return false;
    }else {
        fatherElement.className = "pass";
        field.style.color = "forestgreen";
        err.style.display = "none";
        err.innerHTML = "";
        return true;
    }
}