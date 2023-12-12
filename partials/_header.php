<?php
echo ' <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid pe-0">
  <a class="navbar-brand" href="index.php">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="index.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Top Catagories
        </a>
        <ul class="dropdown-menu">';
        
        $sql = "SELECT * FROM `catagories` LIMIT 4";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result))
        {
          echo'<li><a class="dropdown-item" href="threadlist.php?catid='.$row['catagory_id'].'">'.$row['catagory_name'].'</a></li>';
        } 
       echo '</ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contacts</a>
      </li>
    </ul>

    <div class= "d-flex mx-2">';
    session_start();
   if(isset($_SESSION['login']))
     {
      echo 
      '<form class="d-flex" role="search" action = "search.php" method="get">
      <input class="form-control me-2" type="search" name = "search"placeholder="Search" aria-label="Search">
      <button class="btn btn-success " type="submit">Search</button>
      </form>
      <p class="text-light mb-0 mt-2 px-3">welcome '.$_SESSION['username'].'</p>
      <button class="btn btn-outline-success ms-2" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</button>';
     }
     
     else{
      echo  '<button class="btn btn-outline-success ms-2" data-bs-toggle="modal" data-bs-target="#loginModal">logIn</button>
             <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</button>';
     }

    echo'</div>
    
  </div>
</div>
</nav>';
include 'partials/_loginModal.php';
include 'partials/_signupModal.php';
include 'partials/_logoutModal.php';

if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true")
{
  echo'  <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Holy guacamole!</strong>Data inserted succesfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if(isset($_GET['login']) && $_GET['login']=="true")
{
  echo'  <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Holy guacamole!</strong>Data You are successfully login.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if(isset($_GET['error']))
{
  if($_GET['error']=="EmailFound")
  {
  
      echo'  <div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
      <strong>Holy guacamole!</strong>Email was not registered.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  }
  if($_GET['error']=="wrongPassword")
  {
  
      echo'  <div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
      <strong>Holy guacamole!</strong>Wrong password.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  }
  if($_GET['error']=="passwordmatch")
  {
  
      echo'  <div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
      <strong>Holy guacamole!</strong>Password did not Matched.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  }
  if($_GET['error']=="alreadyexist")
  {
  
      echo'  <div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
      <strong>Holy guacamole!</strong>This email is already exist.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  }
}
?>