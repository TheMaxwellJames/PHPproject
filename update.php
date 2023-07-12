<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "phpbeginners";

$data = mysqli_connect($host, $user, $password, $db);

if (isset($_GET['id'])) {
  $studentId = $_GET['id'];

  // Fetch the student data based on the ID
  $query = "SELECT * FROM student WHERE id = '$studentId'";
  $result = mysqli_query($data, $query);
  $studentData = mysqli_fetch_assoc($result);

  // Handle form submission
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    // Update the student data
    $updateQuery = "UPDATE student SET name = '$name', phone = '$phone' WHERE id = '$studentId'";
    mysqli_query($data, $updateQuery);

    // Handle image update
    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
      $image = $_FILES['image'];
      $imagePath = "image/" . $image['name'];

      // Move the uploaded image to the desired location
      move_uploaded_file($image['tmp_name'], $imagePath);

      // Update the image path in the database
      $updateImageQuery = "UPDATE student SET image = '$imagePath' WHERE id = '$studentId'";
      mysqli_query($data, $updateImageQuery);
    }

    // Redirect back to the student list
    header("Location: index.php");
    exit;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Update Student</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
  </style>
</head>
<body>

<form method="POST" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="<?php echo $studentData['name']; ?>">
  </div>
  <div class="mb-3">
    <label for="phone" class="form-label">Phone Number</label>
    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $studentData['phone']; ?>">
  </div>
  <div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <input type="file" class="form-control" id="image" name="image">
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
