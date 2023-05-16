<?php
    session_start();
    if(!isset($_SESSION['logged'])){
        header("location: ./login_page.php");
    }

    $username = $_SESSION['username'];
?>

<?php require("./src/header.php")?>

<body>
    <!-- HERE WILL BE THE USERS LISTS-->
    <section class="users-list-app">
        
        
        <div class="wrap-user-info">
            <div><img src="./src/no-img.png"></div>
            <div>
                <p id="user"><?=$username?></p>
            </div>
            <div>
                <button id="btn-logout" class="btn" >Logout</button>
            </div>
            <span></span>
        </div>

        <div class="users-list-wrap-search">
                <input type="text" id="words" placeholder="Cerca utente.."><div><i id="btn-search" class="fa-brands fa-telegram" style="color:lightgray;background-color:whitesmoke"></i></div>
        </div>

        <div class="users-list-wrap-users">

        
            <div class="wrap-friend">
                <div><img src="./src/no-img.png"></div>
                <div>
                    <p id="user">Mario Rossi</p>
                    <p>Last message</p>
                </div>
                <div class="wrap-friend-online">
                    <div class="online"></div>
                </div>
            </div>
            

        </div>

    </section>
    <script src="./scripts/index.js"></script>
</body>
</html>