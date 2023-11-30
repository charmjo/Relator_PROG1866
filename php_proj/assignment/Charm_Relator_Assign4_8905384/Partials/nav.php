<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index">Shop <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="order-list">Order List</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="shop-managers-list">Shop Manager List</a>
      </li>
      <!-- will hide when logged in -->

      <?php
      if(isset($_SESSION['logged_in'])) { 
        
      ?>
      <li class="nav-item">
        <a id="logout" class="nav-link" href="logout.php">Logout</a>
      </li>
      <?php } else { ?>
      <!-- will hide when logged out -->
      <li class="nav-item">
        <a id="login" class="nav-link" href="login-view">Login</a>
      </li>
      <?php } ?>
    </ul>
  </div>
</nav>
