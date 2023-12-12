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
  <!-- database connection  -->
  <?php include 'partials/_dbConnect.php'?>
    <!-- database connection  -->
    <!-- nav bar  -->
    <?php require 'partials/_header.php'; ?>
    <!-- nav bar  -->
    <?php 
      $id = $_GET['threadid'];
      $posterid = $_GET['poster'];
      $sql1 = "SELECT * FROM `users`WHERE slno = '$posterid'";
      $result1 = mysqli_query($conn,$sql1);
      $row1 = mysqli_fetch_assoc($result1);
      $poster = $row1['user_name'];
      
      $sql = "SELECT * FROM `threads`WHERE thread_id = $id";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($result);
      $title = $row['thread_title'];
      $desc = $row['thread_desc'];
      
      ?>
  
    <!-- jumbotron  -->
    <div class="container my-4">
        <div class="jumbotron" style="
    background-color: gray; height: 300px; text-align: center; width:70%;margin:auto;border-radius: 25px;">
            <h1 class="display-4" style="color:black;"><?php echo $title; ?></h1>
            <p class="lead"><?php echo $desc; ?></p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <p><b><?php echo $poster; ?> </b></p>
        </div>
    </div>
    <!-- jumbotron  -->
     <!-- form  -->
     <div class="container my-5 "style="width:60%;" >
       <?php 
       $insert = false;
      //  session_start();
     if(isset($_SESSION['login']))
     {
        echo '<h3 class="my-3">Add comments</h3>';
        
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
    
          $comment_By = $_SESSION['sl'];
          $comment_content = $_POST['textarea'];
          $thread_id = $id;
          $comment_content = str_replace("<","&lt",$comment_content);
          $comment_content = str_replace(">","&gt",$comment_content);
          $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`) VALUES ('$comment_content', '$thread_id', '$comment_By')";
          try{
            $insert = true;
            $result = mysqli_query($conn,$sql);
          }
          catch(mysqli_sql_exception $e)
          {
            die("Could not insert data due to this error->".mysqli_error());
          }
        }
       
        echo '<form action = "thread.php?threadid='.$id.'&poster='.$posterid.'" method = "post">
            <div class="form-group">
                <label for="textarea">Add a valid comment</label>
                <textarea class="form-control" id="textarea" name = "textarea" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">comment</button>
        </form>';
      }
        ?>
           <?php 
      if($insert)
      {
           echo'  <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong>Data inserted succesfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      }
      
    ?>
    </div>
    <!-- form  -->
    <!-- media object  -->
    <div class="container mb-5" style="width:60%;" >
        <h3 class="my-3">All comments</h3>
       <?php 
       $s =0;
        $sql = "SELECT * FROM `comments`WHERE thread_id = $id";
        $result = mysqli_query($conn,$sql);
        $check = true;
        while($row=mysqli_fetch_assoc($result))
        {
            $check = false;
            $s++;
            $content = $row['comment_content'];
            $contenterid = $row['comment_by'];
            $sql1 = "SELECT * FROM `users`WHERE slno = '$contenterid'";
            $result1 = mysqli_query($conn,$sql1);
            $row1 = mysqli_fetch_assoc($result1);
            $commentBy = $row1['user_name'];

            echo '<div class="media">
            <img src="https://source.unsplash.com/300x300/?user,profile'.$s.'" width ="50px"class="mr-3" alt="...">
            <h5 class="d-inline">'. $commentBy.'</h5>
            <div class="media-body mb-2">
                <p>'.$content.'</p>
            </div>
        </div>';
        }
        if($check)
        {
          echo '<div class="jumbotron jumbotron-fluid"style="
          background-color: gray; height: 150px; text-align: center; width:70%;margin:auto;border-radius: 25px;">
          <div class="container" style="height:145px;">
            <p class="display-4">No comment found</p>
            <p class="lead">You may ask your problem to get solution.</p>
          </div>
        </div>';
        }
      
      
      ?> 
        
    </div> 
     <!-- media object  -->
    <!-- footer  -->
    <?php require 'partials/_footer.php'; ?>
    <!-- footer  -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>