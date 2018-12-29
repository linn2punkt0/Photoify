<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><?php echo $config['title']; ?></a>

  <ul class="navbar-nav">
  <!-- Home -->
      <li class="nav-item">
          <a class="nav-link <?php if($_SERVER['PHP_SELF'] === "/index.php"){echo 'active';};?>" href="./index.php">Home</a>
      </li>
<!-- About -->
      <li class="nav-item">
          <a class="nav-link <?php if($_SERVER['PHP_SELF'] === "/about.php"){echo 'active';};?>" href="./about.php">About- nonexisting</a>
      </li>
<!-- My pages -->
      <li class="nav-item">
          <a class="nav-link <?php if($_SERVER['PHP_SELF'] === "/my-pages.php"){echo 'active';};?>" href="<?php if(isset($_SESSION['user'])){echo "./my-pages.php";};?>">
          <?php if(isset($_SESSION['user'])){echo "My pages";};?></a>
      </li>
<!-- Create post -->
      <li class="nav-item">
          <a class="nav-link <?php if($_SERVER['PHP_SELF'] === "/new-post.php"){echo 'active';};?>" href="<?php if(isset($_SESSION['user'])){echo "./new-post.php";};?>">
          <?php if(isset($_SESSION['user'])){echo "Create post";};?></a>
      </li>
<!-- Login/Logout -->
      <li class="nav-item">
          <a class="nav-link <?php if($_SERVER['PHP_SELF'] === "/login-page.php"){echo 'active';};?>" href="<?php if(isset($_SESSION['user'])){echo "./app/users/logout.php";} else{echo "./login-page.php";};?>">
          <?php if(isset($_SESSION['user'])){echo "Logout";} else{echo "Login";};?></a>
      </li>
<!-- Register -->
      <li class="nav-item">
        <a class="nav-link <?php if($_SERVER['PHP_SELF'] === "/register-page.php"){echo 'active';};?>" href="<?php if(!isset($_SESSION['user'])){echo "./register-page.php";};?>">
        <?php if(!isset($_SESSION['user'])){echo "Register";};?></a>
      </li>
  </ul>
</nav>