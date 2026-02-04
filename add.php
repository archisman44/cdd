<?php
session_start();
require_once "pdo.php";
if ( ! isset($_SESSION['user_id']) ) die("Not logged in");

if ( isset($_POST['first_name']) ) {
    if (
        strlen($_POST['first_name']) < 1 ||
        strlen($_POST['last_name']) < 1 ||
        strlen($_POST['email']) < 1 ||
        strlen($_POST['headline']) < 1 ||
        strlen($_POST['summary']) < 1
    ) {
        $_SESSION['error'] = "All fields are required";
        header("Location: add.php");
        return;
    }
    if ( strpos($_POST['email'], '@') === false ) {
        $_SESSION['error'] = "Email address must contain @";
        header("Location: add.php");
        return;
    }

    $stmt = $pdo->prepare("INSERT INTO Profile
      (user_id, first_name, last_name, email, headline, summary)
      VALUES (:uid, :fn, :ln, :em, :he, :su)");
    $stmt->execute([
        ':uid' => $_SESSION['user_id'],
        ':fn' => $_POST['first_name'],
        ':ln' => $_POST['last_name'],
        ':em' => $_POST['email'],
        ':he' => $_POST['headline'],
        ':su' => $_POST['summary']
    ]);
    header("Location: index.php");
    return;
}
?>
<!DOCTYPE html>
<html>
<head><title>AC04 - Add</title></head>
<body>
<h1>Add Profile</h1>
<?php
if ( isset($_SESSION['error']) ) {
    echo('<p style="color:red">'.htmlentities($_SESSION['error']).'</p>');
    unset($_SESSION['error']);
}
?>
<form method="POST">
First Name <input type="text" name="first_name"><br/>
Last Name <input type="text" name="last_name"><br/>
Email <input type="text" name="email"><br/>
Headline <input type="text" name="headline"><br/>
Summary<br/>
<textarea name="summary"></textarea><br/>
<input type="submit" value="Add">
</form>
</body>
</html>
