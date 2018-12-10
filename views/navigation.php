<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><?php echo $config['title']; ?></a>

  <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link <?php if($_SERVER['PHP_SELF'] === "/index.php"){echo 'active';};?>" href="/index.php">Home</a>
      </li><!-- /nav-item -->

      <li class="nav-item">
          <a class="nav-link <?php if($_SERVER['PHP_SELF'] === "/about.php"){echo 'active';};?>" href="/about.php">About</a>
      </li><!-- /nav-item -->
      <li class="nav-item ">
          <a class="nav-link <?php if($_SERVER['PHP_SELF'] === "/login.php"){echo 'active';};?>" href="<?php if(isset($_SESSION['user'])){echo "/app/users/logout.php";} else{echo "/login.php";};?>">
          <?php if(isset($_SESSION['user'])){echo "Logout";} else{echo "Login";};?></a>
      </li><!-- /nav-item -->
  </ul><!-- /navbar-nav -->
</nav><!-- /navbar -->