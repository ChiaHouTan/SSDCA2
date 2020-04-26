<?php
// Connect to the database
require_once('database.php');
// Get admin from users
$queryAdmin = "SELECT * FROM users
where username = 'admin' ";
$statement1 = $db->prepare($queryAdmin);
$statement1->execute();
$admins = $statement1->fetchAll();
$statement1->closeCursor();
// Get all data from users
$queryUser = "SELECT * FROM users
where username != 'admin'
ORDER BY id";
$statement4 = $db->prepare($queryUser);
$statement4->execute();
$users = $statement4->fetchAll();
$statement4->closeCursor();
?>

<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
<title>Users List</title>
<link rel="stylesheet" type="text/css" href="Sass/main.css">
</head>
<!-- the body section -->
<body>

    <!-- the Header -->
<?php include 'header_footer/header.php';?>
<div class="textCenter">
<h1>Users List</h1>
<section>
<!-- display a table of users from the database -->
<table class="usersTable">
<tr>
<th>ID</th>
<th>Username</th>
<th>Password</th>
<th>DateOfBirth</th>
<th>Email</th>
<th>Ban</th>
</tr>
<?php foreach ($admins as $admin) : ?>
<tr>
<td><?php echo $admin['id']; ?></td>
<td><?php echo $admin['username']; ?></td>
<td><?php echo $admin['password']; ?></td>
<td class="textCenter"><?php echo $admin['dateOfBirth']; ?></td>
<td><?php echo $admin['email']; ?></td>
<th></th>
</tr>
<?php endforeach; ?>

<?php foreach ($users as $user) : ?>
<tr>
<td><?php echo $user['id']; ?></td>
<td><?php echo $user['username']; ?></td>
<td><?php echo $user['password']; ?></td>
<td class="textCenter"><?php echo $user['dateOfBirth']; ?></td>
<td><?php echo $user['email']; ?></td>

<td class="textCenter"><form action="delete_user.php" method="post"
id="delete_record_form"> 
<input type="hidden" name="id"
value="<?php echo $user['id']; ?>">
<input class="textBold" type="submit" value="Ban">
</form></td>

</tr>
<?php endforeach; ?>
</table>
</section>


<br>
<p><a href="index.php">Homepage</a></p>

</div>
<?php include 'header_footer/footer.php';?>
</body>
</html>
