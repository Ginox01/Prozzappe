<?php
    session_start();
    if(!isset($_SESSION['logged'])){
        header("location: ./login_page.php");
    }

    $username = $_SESSION['username'];
    $image = $_SESSION['img'];
?>

<?php require("./src/header.php")?>

<body>

    <section class="app">
        <div class="wrap-chat-user">
            <div><img src="./src/no-img.png"/></div>
            <h3>User Name</h3>
            <span>Offline</span>
        </div>

        <div class="txt-outcoming">
            <div class="details">
                <p>Ciao sono il messaggio inviato, come va??</p>
            </div>
        </div>

        <div class="txt-incoming">
            <div class="details">
                <p>Ciao messaggio inviato, io sono quello in entrata, tutto bene grazie!</p>
            </div>
        </div>

    </section>

</body>
</html>