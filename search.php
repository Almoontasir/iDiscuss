<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>idiscuss</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
   <!-- database connection -->
   <?php include 'partials/_dbConnect.php'?>
   <?php// header("location:_header.php"); ?>
  <!-- database connection  -->

  <!-- nav bar  -->
  <?php require 'partials/_header.php'; ?>
  <!-- nav bar  -->
  <div class="container">
    <h1 class="text-center my-3">Following are the serach reasult for <em>"<?php echo $_GET['search'] ?>"</em></h1>
    <?php 
    $check = true;
      $topic = $_GET['search'];
      
      $sql = "SELECT * FROM `threads` WHERE MATCH(`thread_title`,`thread_desc`) against('$topic');";
      $result = mysqli_query($conn,$sql);
     while($row = mysqli_fetch_assoc($result))
     {
      $check = false;
      $title = $row['thread_title'];
      $desc = $row['thread_desc'];
      $thread_id =$row['thread_id'];
      $thread_user_id = $row['thread_user_id'];
      echo '<div class="searchReault">
      <h3><a href="thread.php?threadid='.$thread_id.'&poster='.$thread_user_id.'"class="text-dark">'.$title.'</a></h3>
      <p>'.$desc.'</p>
     </div>';
     } 
     if($check)
     {
       echo '<div class="jumbotron jumbotron-fluid my-5"style="
       background-color: gray; height: 150px; text-align: center; width:70%;margin:auto;border-radius: 25px;">
       <div class="container">
         <p class="display-4">No Result found</p>
         <p class="lead">You may search by using different and correct keyword.</p>
       </div>
     </div>';
     }
      
      ?>
    

  </div>
 
 
  <?php require 'partials/_footer.php';?> 

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>