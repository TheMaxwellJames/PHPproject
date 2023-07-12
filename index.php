<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .center-form {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .return-link {
      position: fixed;
      top: 10px;
      right: 10px;
    }
  </style>
</head>
<body>


      <?php


          $host="localhost";
          $user="root";
          $password="";
          $db="phpbeginners";


        $data=mysqli_connect($host, $user, $password, $db);


          if(isset($_POST['submit']))
          {
              $sname=$_POST['name'];

              $sphone=$_POST['phone'];

              $file=$_FILES['image'] ['name'];

              $dst="./image/".$file;

              $dst_db="image/".$file;


              move_uploaded_file($_FILES['image'] ['tmp_name'], $dst);


              $query="INSERT INTO student(name, phone, image) VALUES ('$sname', '$sphone', ' $dst_db')";


              $result=mysqli_query($data,$query);

              if ($result) 
              {
                echo '<div class="alert alert-success text-center" role="alert">Upload Success</div>';
              } 
              else
               {
                echo '<div class="alert alert-danger text-center" role="alert">Failed</div>';
              }
              
              


          }















      ?>











<a href="display.php" class="btn btn-primary return-link">Display</a>



  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3 center-form">


        <form action="index.php" method="POST" enctype="multipart/form-data">


          <div class="form-group">
            <label for="name"> Studen Name:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
          </div>


          <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control-file" id="image"  name="image">
          </div>


          <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="phone" class="form-control" id="phone" placeholder="Enter your phone number"  name="phone">
          </div>


          <button type="submit" class="btn btn-primary"  name="submit" value="Upload Data">Submit</button>
        </form>
      </div>
    </div>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" 
  crossorigin="anonymous"></script>
</body>
</html>

