
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deyal - Write your thoughts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'dbconnect.php';?>
    <div class="navbar">
        <h1 class="logo-text">দেয়াল</h1>
            <ul id="menuList">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#visit">Visit</a></li>
                <a href="#write" class="btn" data-bs-toggle="modal" data-bs-target="#writeModal"> Write</a>    
                <a href="https://github.com/uthsobcb/deyal">
                <i class="fa fa-github"></i>
              </a>
              </ul>  
    </div>
    <div class="sanimate" id="home">
        <h1 class="banner">দেয়াল</h1>
        <div class="abt">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgb(1, 1, 47)" fill-opacity="1" d="M0,32L60,26.7C120,21,240,11,360,37.3C480,64,600,128,720,138.7C840,149,960,107,1080,117.3C1200,128,1320,192,1380,224L1440,256L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path></svg>
           
           
            <section class="sanimate" id="about">
                <h3>দেয়াল সম্পর্কে</h3>
                <div class="services-grid">
                  <div class="service service1">
                    <i class="fa fa-question-circle"></i>
                    <h4>দেয়াল কি?</h4>
                    <p>দেয়াল একটি সাদা দেয়াল যেখানে আপনি মনের কথাগুলো লিখে রাখতে পারেন। আর অন্যের মনের দুঃখ গুলো পড়তে পারেন। মজার ব্যপার হলো এখানে আপনার পরিচয় ও কেউ জানবে না আর আপনিও কারো পরিচয় জানতে পারবেন না।
                    </p>
                  </div>
              
                  <div class="service service2">
                    <i class="fa fa-pencil-square-o"></i>
                    <h4>কিভাবে এটি কাজ করে?</h4>
                    <p>সাদা দেয়ালে যেমন আপনি যা খুশি লিখতে পারেন তেমনি এখানে কোনায় থাকা 'Write' বাটনে ক্লিক দিয়ে মনের কথা(সুখ,দুঃখ,হাসি,কান্না যা খুশি) লিখতে পারেন। এতে দুঃখে থাকলে আপনার দুঃখ হালকা লাগবে।</p>
                  </div>
              
                  <div class="service service3">
                    <i class="fa fa-user-secret"></i>
                    <h4>গোপনীয়তা রক্ষা কিভাবে হবে?</h4>
                    <p>যেহেতু এখানে লিখতে কোনো রেজিস্ট্রেসন করতে হয় না তাই কেউ আপনার পরিচয় জানবে না।</p>
                  </div>
                </div>
                </section>
              <section class="sanimate" id="visit">
                <h4>দেয়াল পড়ুন</h4>
          <?php
          $sql = "SELECT * FROM `posts`";
          $result = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_assoc($result)) {
            $date = $row['date'];
            $time = $row['time'];
            $post = $row['post'];  
            
            echo ' 
            <div class="card-group">
            <div class="card">
              <div class="card-body">
                <p class="card-text">'. $post .'</p>
                <p class="card-text"><small class="text-muted">Posted: '. $date .' & '. $time .'</small></p>
              </div>
            </div>
          </div>
       ';
        }
            ?>
           </section>
              <section class="write">

    <!-- Modal -->
    <form action="" method="POST">
    <div class="modal fade" id="writeModal" tabindex="-1" aria-labelledby="writeModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 id="writeModalLabel">দেয়ালে লিখুন</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="writebox"  class="form-label" style="color: black;">Write your thoughts...</label>
          <textarea class="form-control" name="writebox" id="writebox" rows="3"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <!-- Form Control php Block -->
<?php
          $showAlert = false; 
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'POST'){
          $post = $_POST['writebox'];
          $sql = "INSERT INTO `posts` ( `date`, `time`, `post`) VALUES (current_timestamp(), current_timestamp(), '$post');";
          $result = mysqli_query($conn, $sql);
          $showAlert = true; 
          if ($showAlert) {
          echo '
          <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Submited!</strong>
       Your thoughts has been added in Deyal. If you could not find here please check again later. Thank You!  
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
          }
        }
        ?>
      </div>
    </div>
  </div>
</div>
</section>
<div class="foot" style="color: white; text-align: center; background: black;">
<h5>Created by Uthsob</h5>
      </div>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>
