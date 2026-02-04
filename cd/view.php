<?php
require_once "pdo.php";

$stmt = $pdo->prepare("SELECT * FROM Profile WHERE profile_id = :pid");
$stmt->execute([ ':pid' => $_GET['profile_id'] ]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    die("Profile not found");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>AC04 - View Profile</title>
</head>
<body>
<h1><?= htmlentities($row['first_name'].' '.$row['last_name']) ?></h1>
<p>Email: <?= htmlentities($row['email']) ?></p>
<p>Headline:<br><?= htmlentities($row['headline']) ?></p>
<p>Summary:<br><?= htmlentities($row['summary']) ?></p>
<p><a href="index.php">Done</a></p>
</body>
</html>
