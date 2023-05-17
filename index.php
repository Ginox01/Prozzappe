<?php
    session_start();
    if(!isset($_SESSION['logged'])){
        header("location: ./login_page.php");
    }

    $username = $_SESSION['username'];
    $status = $_SESSION['status'];
    $image = $_SESSION['img'];
?>

<?php require("./src/header.php")?>

<body>
    <!-- HERE WILL BE THE USERS LISTS-->
    <section class="users-list-app">
        
        <div class="wrap-user-info">
            <div><img src="<?= $image == "default" ? "./src/no-img.png":""?>"></div>
            <div>
                <p id="user"><?=$username?></p>
            </div>
            <div>
                <button id="btn-open-form-image" type="button" class="btn">Image</button>
                <button id="btn-logout" class="btn" >Logout</button>
            </div>
            <span></span>
        </div>

        <div class="users-list-wrap-search">
                <input disabled type="text" id="words" placeholder="Cerca utente.."><div><i id="btn-search" class="fa-brands fa-telegram off" style="color:lightgray;background-color:whitesmoke"></i></div>
        </div>

        <div class="users-list-wrap-users">
      

        </div>

        <div class="users-list-wrap-no-results">
            <p class="error-msg"></p>
        </div>

    </section>
        <!-- This section appears when you click the btn image -->
    <section class="wrap-form-image">
        
        <div class="wrap-img">
            <img src="<?=$image == "default"?"./src/no-img.png":"" ?>"/>
            <span id="btn-close-img-form">❌</span>
        </div>
        <div id="div-form-img">
            <h3>Change your picture</h3>
            <form method="POST" action="change_img.php">
                <input type="file" placeholder="new img" name="image">
                <button type="submit" class="btn">CHANGE</button>
            </form>
        </div>
    </section>
    

    <script src="./scripts/index.js"></script>
</body>
</html>