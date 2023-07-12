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

// Handle search
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $searchValue = $_POST['search'];

  // Modify the query to include the search condition
  $query = "SELECT * FROM student WHERE name LIKE '%$searchValue%' OR phone LIKE '%$searchValue%'";
} else {
  // Default query to fetch all students
  $query = "SELECT * FROM student";
}

$result = mysqli_query($data, $query);
?>

<div class="mb-3">
  <form method="POST">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Search by name or phone" name="search">
      <button type="submit" class="btn btn-primary">Search</button>
    </div>
  </form>
</div>

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
          <a href="?delete_id=<?php echo $info['id']; ?>" class="btn btn-danger btn-sm"  onclick="return confirm('Sure to delete?')">Delete</a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
