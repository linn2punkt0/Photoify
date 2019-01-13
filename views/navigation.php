<nav class="navbar">
    <a class="navbar-brand" href="#">
        <?php echo $config['title']; ?></a>

    <ul class="navbar-nav">
        <!-- Home -->
        <li class="nav-item">
            <a class="nav-link <?php if($_SERVER['PHP_SELF'] === "/index.php"){echo 'active' ;};?>"
                href="./index.php">Home</a>
        </li>
        <!-- My pages -->
        <li class="nav-item">
            <a class="nav-link <?php if($_SERVER['PHP_SELF'] === "/my-pages.php"){echo 'active' ;};?>" href="
                <?php if(isset($loggedInUser)){echo "./my-pages.php";};?>">
                <?php if(isset($loggedInUser)){echo "My pages";};?></a>
        </li>
        <!-- Create post -->
        <li class="nav-item">
            <a class="nav-link <?php if($_SERVER['PHP_SELF'] === "/new-post.php"){echo 'active' ;};?>" href="
                <?php if(isset($loggedInUser)){echo "./new-post.php";};?>">
                <?php if(isset($loggedInUser)){echo "Create post";};?></a>
        </li>
        <!-- Login/Logout -->
        <li class="nav-item">
            <a class="nav-link <?php if($_SERVER['PHP_SELF'] === "/login-page.php"){echo 'active' ;};?>" href="
                <?php if(isset($loggedInUser)){echo "./app/users/logout.php";} else{echo "./login-page.php";};?>">
                <?php if(isset($loggedInUser)){echo "Logout";} else{echo "Login";};?></a>
        </li>
        <!-- Register -->
        <li class="nav-item">
            <a class="nav-link <?php if($_SERVER['PHP_SELF'] === "/register-page.php"){echo 'active' ;};?>" href="
                <?php if(!isset($loggedInUser)){echo "./register-page.php";};?>">
                <?php if(!isset($loggedInUser)){echo "Register";};?></a>
        </li>
    </ul>
</nav>