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
      $id = $_GET['catid'];
      $sql = "SELECT * FROM `catagories`WHERE `catagory_id` = '$id'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($result);
            $catName = $row['catagory_name'];
            $catDesc = $row['catagory_description'];
      
      ?>

    <!-- jumbotron  -->
    <div class="container my-4">
        <div class="jumbotron" style="
    background-color: gray; height: 300px; text-align: center; width:70%;margin:auto;border-radius: 25px;">
            <h1 class="display-4 "style ="color:black;">Welcome to <?php echo $catName; ?> foram</h1>
            <p class="lead"><?php echo $catDesc; ?></p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
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
        echo'<h3 class="my-3">Ask Quesitons</h3>';
        
       
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
          $thread_user_id = $_SESSION['sl'];
          $thread_title = $_POST['title'];
          $thread_title = str_replace("<","&lt",$thread_title);
          $thread_title = str_replace(">","&gt",$thread_title);
          $thread_desc = $_POST['textarea'];
          $thread_desc  = str_replace("<","&lt",$thread_desc);
          $thread_desc  = str_replace(">","&gt",$thread_desc);
          $thread_cat_id = $id;

          $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`) VALUES ('$thread_title', '$thread_desc', '$thread_cat_id', '$thread_user_id')";
          try{
            $insert = true;
            $result = mysqli_query($conn,$sql);
          }
          catch(mysqli_sql_exception $e)
          {
            die("Could not insert data due to this error->".mysqli_error());
          }
        }
       
        echo '<form action = "threadlist.php?catid='.$id.'" method = "post">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name ="title" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Insert the name in short.</small>
            </div>
            <div class="form-group">
                <label for="textarea">Thread Description</label>
                <textarea class="form-control" id="textarea" name = "textarea" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
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
    <div class="container my-5 "style="width:60%;">
        <h3 class="my-3">Browse Questions</h3>
        <?php 
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads`WHERE thread_cat_id = $id";
        $result = mysqli_query($conn,$sql);
        $s = 0;
        $check = true;
        while($row=mysqli_fetch_assoc($result))
        {
            $check = false;
             $thread_user_id = $row['thread_user_id'];
            $threadid = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
          echo  '<div class="media">
            <img src="https://source.unsplash.com/700x700/?user,profile'.$s.'" width ="50px"class="mr-3" alt="...">
            <div class="media-body">
                <h5 class="mt-0"><a href="thread.php?threadid='.$threadid.'&poster='.$thread_user_id.'" class="link-dark">'.$title.'</a></h5>
                <p>'.$desc.'</p>
            </div>
          </div>';
          $s++;
        }
        if($check)
        {
          echo '<div class="jumbotron jumbotron-fluid"style="
          background-color: gray; height: 150px; text-align: center; width:70%;margin:auto;border-radius: 25px;">
          <div class="container">
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