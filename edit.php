<?php
session_start();
require_once "pdo.php";
if ( ! isset($_SESSION['user_id']) ) die("Not logged in");

$stmt = $pdo->prepare("SELECT * FROM Profile
  WHERE profile_id = :pid AND user_id = :uid");
$stmt->execute([
  ':pid' => $_GET['profile_id'],
  ':uid' => $_SESSION['user_id']
]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) die("Access denied");

if ( isset($_POST['first_name']) ) {
    if ( strpos($_POST['email'], '@') === false ) {
        $_SESSION['error'] = "Email address must contain @";
        header("Location: edit.php?profile_id=".$_POST['profile_id']);
        return;
    }
    $stmt = $pdo->prepare("UPDATE Profile SET
      first_name=:fn,last_name=:ln,email=:em,
      headline=:he,summary=:su WHERE profile_id=:pid");
    $stmt->execute([
      ':fn'=>$_POST['first_name'], ':ln'=>$_POST['last_name'],
      ':em'=>$_POST['email'], ':he'=>$_POST['headline'],
      ':su'=>$_POST['summary'], ':pid'=>$_POST['profile_id']
    ]);
    header("Location: index.php");
    return;
}
?>
<!DOCTYPE html>
<html>
<head><title>AC04 - Edit</title></head>
<body>
<h1>Edit Profile</h1>
<form method="POST">
<input type="hidden" name="profile_id" value="<?= $row['profile_id'] ?>">
<input name="first_name" value="<?= htmlentities($row['first_name']) ?>"><br/>
<input name="last_name" value="<?= htmlentities($row['last_name']) ?>"><br/>
<input name="email" value="<?= htmlentities($row['email']) ?>"><br/>
<input name="headline" value="<?= htmlentities($row['headline']) ?>"><br/>
<textarea name="summary"><?= htmlentities($row['summary']) ?></textarea><br/>
<input type="submit" value="Save">
</form>
</body>
</html>
