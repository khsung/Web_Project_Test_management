<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
<?php 
    $con = mysqli_connect("localhost", "khsung0", "gmltjd1!", "khsung0");
    mysqli_query($con,'SET NAMES utf8');
    $user_id=$_SESSION["user_id"];
    $title = $_SESSION["title"];
	$query1 = "SELECT * FROM DB_PROJECT_MUSIC WHERE title='$title'";
	$result1=mysqli_query($con,$query1);
$row = mysqli_fetch_array($result1);
echo"$user_id, $title, $row[artist], $row[composer], $row[lyricist], $row[lyrics]";
   $statement = mysqli_prepare($con, "INSERT INTO DB_PROJECT_MY_MUSIC VALUES (?,?,?,?,?,?)");
    mysqli_stmt_bind_param($statement, "ssssss", $user_id, $title, $row[artist], $row[composer], $row[lyricist], $row[lyrics]);
    mysqli_stmt_execute($statement);

Header("Location:./Main.php");



?>

</body>
</html>