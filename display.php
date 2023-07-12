<!DOCTYPE html>
<html>
<head>
  <title>Student List</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
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
$host = "localhost";
$user = "root";
$password = "";
$db = "phpbeginners";

$data = mysqli_connect($host, $user, $password, $db);

// Handle student deletion
if (isset($_GET['delete_id'])) {
  $deleteId = $_GET['delete_id'];
  $deleteQuery = "DELETE FROM student WHERE id = '$deleteId'";
  mysqli_query($data, $deleteQuery);
}

$query = "SELECT * FROM student";
$result = mysqli_query($data, $query);
?>

<a href="index.php" class="btn btn-primary return-link">Index</a>

<table class="table table-bordered text-center">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Phone Number</th>
      <th>Image</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($info = $result->fetch_assoc()) { ?>
      <tr>
        <td><?php echo $info['id']; ?></td>
        <td><?php echo $info['name']; ?></td>
        <td><?php echo $info['phone']; ?></td>
        <td><img src="<?php echo $info['image']; ?>" alt="Student Image" width="100"></td>
        <td>
          <a href="update.php?id=<?php echo $info['id']; ?>" class="btn btn-primary btn-sm">Update</a>
          <a href="?delete_id=<?php echo $info['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Sure to delete?')">Delete</a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
