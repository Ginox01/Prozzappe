<?php
    session_start();
    if(!isset($_SESSION['logged'])){
        header("location: ./login_page.php");
    }

    $you = $_SESSION['username'];
    $he = $_GET['user'];
    
?>

<?php require("./src/header.php")?>

<body>

    <section class="app">
        <div class="wrap-chat-user">
            <div><img src="./src/no-img.png"/></div>
            <div>
                <p id="arrow">←</p>
                <h3>User Name</h3>
                <span>Offline</span>
            </div>
        </div>

        <div class="wrap-chat">


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

        </div>
        <div class="wrap-chat-form">
            <form>
                <input type="hidden" id="mittente" value="<?=$you?>">
                <input type="hidden" id="destinatario" value="<?=$he?>">
                <input type="text" id="message" placeholder="insert message.."><div><img id="send-message" src="./src/logo.jpg"></div>
            </form>
        </div>

    </section>
    <script src="./scripts/chat.js"></script>
</body>
</html>