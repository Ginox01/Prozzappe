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
    <section class="wrap-form-image">
        
    </section>
    <script src="./scripts/index.js"></script>
</body>
</html>