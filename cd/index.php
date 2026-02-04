<?php
session_start();
require_once "pdo.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>AC04 - Resume Profiles</title>
</head>
<body>
<h1>Resume Profiles</h1>

<?php
if ( isset($_SESSION['name']) ) {
    echo '<p><a href="add.php">Add New Entry</a> |
          <a href="logout.php">Logout</a></p>';
} else {
    echo '<p><a href="login.php">Please log in</a></p>';
}

$stmt = $pdo->query("SELECT profile_id, first_name, last_name FROM Profile");
echo "<ul>";
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    echo "<li>";
    echo '<a href="view.php?profile_id='.$row['profile_id'].'">';
    echo htmlentities($row['first_name'].' '.$row['last_name']);
    echo "</a>";
    if ( isset($_SESSION['user_id']) ) {
        echo ' <a href="edit.php?profile_id='.$row['profile_id'].'">Edit</a>';
        echo ' <a href="delete.php?profile_id='.$row['profile_id'].'">Delete</a>';
    }
    echo "</li>";
}
echo "</ul>";
?>
</body>
</html>
