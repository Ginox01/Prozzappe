<?php require("./src/header.php")?>

<?php 
    session_start();
    if(isset($_SESSION['logged'])){
        header("location: ./index.php");
    }


    if(!isset($_SESSION['crsf'])){
        $token = random_bytes(16);
        $token = bin2hex($token);
        $_SESSION['crsf'] = $token;
    }
    

?>

<body>

    <section class="app">
        <input type="hidden" id="token" value="<?=$_SESSION['crsf']?>"> 
        <div class="wrap-title">
            <div><img src="./src/logo.jpg"/></div>
            <div><h3>Prozzappe</h3></div>
        </div>
        <h2 style="text-align: center;margin-bottom:20px">Welcome new user!</h2>
        <p class="error-msg"></p>
        <div class="wrap-form-new-user">
            <form>
                <div class="row">
                    <div>
                        <input type="mail" class="" placeholder="Insert your mail.." id="mail">
                    </div>
                    <div>
                        <input type="text" placeholder="Insert your Username.." id="username">
                    </div>
                </div>
                <div class="row">
                    <div>
                        <input type="password" placeholder="Insert your best Password.." id="psw">
                    </div>
                    <div>
                        <input type="password" placeholder="Confirm password.." id="confirm-psw">
                    </div>
                </div>
                <button type="submit" id="btn-new-user" class="btn">Sign Up!</button>    
            </form>
            
        </div>
        <p style="text-align: center;position:absolute;left:25px;bottom:50px">Do you have alredy an account?? <a href="./login_page.php" >login</a> now!</p>
    </section>

    <script src="./scripts/registration.js"></script>
</body>
</html>