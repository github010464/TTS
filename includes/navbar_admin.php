<?php
    $session_user = 'admin';
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-1">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><small>Navbar</small></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <?php if(isset($_SESSION['auth_admin'])) :?>            
                <li class="nav-item">            
                    <a class="btn btn-link text-decoration-none" href="logout.php"><small>Logout</small></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" title="User_ID = <?php echo $_SESSION["auth_admin"] ?>" alt="user_icon"><small><i class="fa-solid fa-user"></i></small>
                    </a>         
                </li>
            <?php endif ?>
        
            <?php if(!isset($_SESSION['auth_admin'])) :?>
                <li class="nav-item">
                    <a class="btn btn-link text-decoration-none" role="button" data-bs-toggle="modal" data-bs-target="#registerModal"><small>Register</small></a>
                </li>
                <li class="nav-item">            
                    <a class="btn btn-link text-decoration-none" role="button" data-bs-toggle="modal" data-bs-target="#loginModal"><small>Login</small></a>
                </li>
            <?php endif ?> 
      </ul>
    </div>
  </div>
</nav>