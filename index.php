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
 
  <!-- carousel-->
  <div id="carouselExampleIndicators" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://source.unsplash.com/2400x700/?coding,code" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://source.unsplash.com/2400x700/?programming,Applle" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://source.unsplash.com/2400x700/?coding,Microsoft" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div> 
  <!-- carousel -->
  <!-- card  -->
 
  <div class="container mb-5">
    <h1 class="text-center my-3">iDiscuss Catagories</h1>
    <div class="row">
    <?php 
      $sql = "SELECT * FROM `catagories`";
      $result = mysqli_query($conn,$sql);
      while($row = mysqli_fetch_assoc($result))
      {
        $id = $row['catagory_id'];
        $name = $row['catagory_name'];
        $desc = $row['catagory_description'];
        echo '<div class="col-sm my-2">
        <div class="card" style="width: 18rem;">
          <img  src="https://source.unsplash.com/500x400/?coding,'.$name.'" width = "200px" class="card-img-top" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title"><a href="threadlist.php?catid='.$id.'">'.$name.'</a></h5>
            <p class="card-text">'.substr($desc,0,50).'....</p>
            <a href="threadlist.php?catid='.$id.'" class="btn btn-primary">view threads</a>
          </div>
        </div>
      </div>';
      }
    ?>

      
    
    </div>
  </div>
   <!-- card  -->
  <?php require 'partials/_footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>