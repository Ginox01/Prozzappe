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
        <div class="wrap-login-form">
            
            <h4 style="text-align: center;margin-bottom:15px">Sign in</h4>
            <div><p class="error-msg"> </p></div>
            <form method="POST" class="login_form">
                <div class="">
                    <input type="text" id="mail" placeholder="Inser your mail.." required>
                </div>
                <div>
                    <input type="password" id="psw" placeholder="Inser your Password.." required>
                </div>
                <button class="btn" id="btn-login" type="submit">Login!</button>
            </form>
        </div>
        <p class="texte" style="text-align: center;">Do you not have alredy an account?? <a href="./registration_page.php" >register</a> now!</p>
    </section>

    <script src="./scripts/login.js"></script>
</body>
</html>