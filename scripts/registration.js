//CONTINUARE DA QUI!+++
const token = document.getElementById('token').value;
const errorMsg = document.querySelector('.error-msg');
const mail = document.getElementById('mail');
const username = document.getElementById('username');
const psw = document.getElementById('psw');
const confirmPsw = document.getElementById('confirm-psw');
const btnSubmit = document.getElementById('btn-new-user');

btnSubmit.addEventListener('click',createNewUser);
function createNewUser(e){
    e.preventDefault();
    if(chekFieldMail(mail,errorMsg) && checkSurnameField(username,errorMsg) && checkPassword(psw,confirmPsw,errorMsg)){
        
        let formData = new FormData;
        formData.append('token',token);
        formData.append('mail',mail.value);
        formData.append('username',username.value);
        formData.append('password',psw.value);

        fetch('./php/new_user.php',{
            method:'POST',
            header:{'Content-Type':'application/json'},
            body:formData
        }).then(res=>res.json())
        .then(data=>{
            console.log(data);
        })
    }
}

function chekFieldMail(target,err){
    let test = /@/;
    if(target.value.length < 6){
        err.style.display = "flex";
        err.innerHTML = "Mail min chars required: 6";
        target.className = "invalid";
        return false;
    }else if(!test.test(target.value)){
        err.style.display = "flex";
        err.innerHTML = "Mail miss the '@' char";
        target.className = "invalid";
        return false;
    }else{
        err.innerHTML = "";
        err.style.display = "none";
        target.className = "valid";
        return true;
    }

}

function checkSurnameField(target,err){
    if(target.value.length < 4){
        err.style.display = "flex";
        err.innerHTML = "Username min chars required: 4";
        target.className = "invalid";
        return false;
    }else{
        err.style.display = "none";
        err.innerHTML = "";
        target.className = "valid";
        return true;
    }
}


function checkPassword(target,confirmField,err){
    if(target.value.length < 4){
        err.style.display = "flex";
        err.innerHTML = "Password min chars required: 4";
        target.className = "invalid";
        return false;
    }else if(target.value != confirmField.value){
        err.style.display = "flex";
        err.innerHTML = "Password doesn't match";
        target.className = "invalid";
        confirmField.className = "invalid";
        return false;
    }else {
        err.style.display = "none";
        err.innerHTML = "";
        target.className = "valid";
        confirmField.className = "valid";
        return true;
    }
}