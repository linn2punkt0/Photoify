<nav class="navbar">
    <a class="navbar-brand" href="/index.php">
        <?php echo $config['title']; ?></a>

    <!-- THIS IS ONLY FOR DESKTOP -->
    <ul class="navbar-nav">
        <!-- Home -->
        <li class="nav-item">
            <a class="nav-link <?php if($_SERVER['PHP_SELF'] === "/index.php"){echo 'active' ;};?>"
                href="./index.php">Home</a>
        </li>
        <!-- My pages -->
        <li class="nav-item <?php if(!isset($loggedInUser)){echo 'hide';};?>">
            <a class="nav-link <?php if($_SERVER['PHP_SELF'] === "/my-pages.php"){echo 'active' ;};?>"
                href="./my-pages.php">My pages</a>
        </li>
        <!-- Create post -->
        <li class="nav-item <?php if(!isset($loggedInUser)){echo 'hide';};?>">
            <a class="nav-link <?php if($_SERVER['PHP_SELF'] === "/new-post.php"){echo 'active' ;};?>"
                href="./new-post.php">Create post</a>
        </li>
        <!-- Login/Logout -->
        <li class="nav-item">
            <a class="nav-link <?php if($_SERVER['PHP_SELF'] === "/login-page.php"){echo 'active' ;};?>" href="
                <?php if(isset($loggedInUser)){echo "./app/users/logout.php";} else{echo "./login-page.php";};?>">
                <?php if(isset($loggedInUser)){echo "Logout";} else{echo "Login";};?></a>
        </li>
        <!-- Register -->
        <li class="nav-item <?php if(isset($loggedInUser)){echo 'hide';};?>">
            <a class="nav-link <?php if($_SERVER['PHP_SELF'] === "/register-page.php"){echo 'active' ;};?>"
                href="./register-page.php">Register</a>
        </li>
    </ul>

    <!-- THIS IS ONLY FOR MOBILE -->
    <div class="nav-icon1">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="mobile-menu">
        <ul class="mobile-nav">
            <!-- Home -->
            <li class="nav-item">
                <a class="nav-link <?php if($_SERVER['PHP_SELF'] === "/index.php"){echo 'active' ;};?>"
                    href="./index.php">Home</a>
            </li>
            <!-- My pages -->
            <li class="nav-item <?php if(!isset($loggedInUser)){echo 'hide';};?>">
                <a class="nav-link <?php if($_SERVER['PHP_SELF'] === "/my-pages.php"){echo 'active' ;};?>"
                    href="./my-pages.php">My pages</a>
            </li>
            <!-- Create post -->
            <li class="nav-item <?php if(!isset($loggedInUser)){echo 'hide';};?>">
                <a class="nav-link <?php if($_SERVER['PHP_SELF'] === "/new-post.php"){echo 'active' ;};?>"
                    href="./new-post.php">Create post</a>
            </li>
            <!-- Login/Logout -->
            <li class="nav-item">
                <a class="nav-link <?php if($_SERVER['PHP_SELF'] === "/login-page.php"){echo 'active' ;};?>" href="
                    <?php if(isset($loggedInUser)){echo "./app/users/logout.php";} else{echo "./login-page.php";};?>">
                    <?php if(isset($loggedInUser)){echo "Logout";} else{echo "Login";};?></a>
            </li>
            <!-- Register -->
            <li class="nav-item <?php if(isset($loggedInUser)){echo 'hide';};?>">
                <a class="nav-link <?php if($_SERVER['PHP_SELF'] === "/register-page.php"){echo 'active' ;};?>"
                    href="./register-page.php">Register</a>
            </li>
        </ul>
    </div>
</nav>