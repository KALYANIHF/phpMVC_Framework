<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
       <a class="navbar-brand" href="<?php echo URLROOT ?>"><?php echo SITENAME ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URLROOT ?>">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URLROOT ?>/pages/about">About</a>
      </li>
    </ul>
     <?php if (isset($_SESSION['user_id'])): ?>
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link">Welcome <?php echo $_SESSION['user_name'] ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT ?>/users/logout">logout</a>
        </li>
        </ul>
     <?php else: ?>
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT ?>/users/register">Register</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT ?>/users/login">Login</a>
        </li>
        </ul>
     <?php endif;?>
  </div>
  </div>
</nav>
