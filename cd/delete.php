<?php
session_start();
require_once "pdo.php";
if ( ! isset($_SESSION['user_id']) ) die("Not logged in");

$stmt = $pdo->prepare("SELECT * FROM Profile
 WHERE profile_id=:pid AND user_id=:uid");
$stmt->execute([
 ':pid'=>$_GET['profile_id'],
 ':uid'=>$_SESSION['user_id']
]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) die("Access denied");

if ( isset($_POST['delete']) ) {
    $stmt = $pdo->prepare("DELETE FROM Profile WHERE profile_id=:pid");
    $stmt->execute([ ':pid'=>$_POST['profile_id'] ]);
    header("Location: index.php");
    return;
}
?>
<!DOCTYPE html>
<html>
<head><title>AC04 - Delete</title></head>
<body>
<h1>Confirm Delete</h1>
<p><?= htmlentities($row['first_name'].' '.$row['last_name']) ?></p>
<form method="POST">
<input type="hidden" name="profile_id" value="<?= $row['profile_id'] ?>">
<input type="submit" name="delete" value="Delete">
</form>
</body>
</html>
