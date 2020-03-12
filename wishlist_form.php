<?php
// Connect to the database
require_once('database.php');
// Set the default category to the ID of 1
if (!isset($category_id)) {
$category_id = filter_input(INPUT_GET, 'category_id', 
FILTER_VALIDATE_INT);
if ($category_id == NULL || $category_id == FALSE) {
$category_id = 1;
}
}
// Get all data from wishlist
$queryWishlist = "SELECT * FROM wishlists
ORDER BY wishListID";
$statement4 = $db->prepare($queryWishlist);
$statement4->execute();
$wishlists = $statement4->fetchAll();
$statement4->closeCursor();
?>

<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
<title>PHP CRUD</title>
<link rel="stylesheet" type="text/css" href="Sass/main.css">
</head>
<!-- the body section -->
<body>

    <!-- the Header -->
<?php include 'header_footer/header.php';?>
<main>
        <!-- the Image Zoom LightBox -->
<div id="lb-back">
      <div id="lb-img">

      </div>
    </div>
<h1>Wishlist</h1>
<section>
<!-- display a table of wishlists from the database -->
<table>
<tr>
<th>Image</th>
<th>Code</th>
<th>Name</th>
<th>Genre</th>
<th>Price</th>
<th>Release Date</th>
<th>Remove</th>
</tr>
<?php foreach ($wishlists as $wishlist) : ?>
<tr>
<td class="textCenter"><img class="zoomD" src="image_uploads/<?php echo $wishlist['image']; ?>" width="auto" height="600px" /></td>
<td><?php echo $wishlist['code']; ?></td>
<td><?php echo $wishlist['name']; ?></td>
<td><?php echo $wishlist['genre']; ?></td>
<td class="textRight"><?php echo $wishlist['price']; ?></td>
<td class="textCenter"><?php echo $wishlist['dateRelease']; ?></td>


<td class="textCenter"><form action="delete_wishlist.php" method="post"
id="delete_record_form">
<input type="hidden" name="game_ID"
value="<?php echo $wishlist['gameID']; ?>">
<input class="textBold" type="submit" value="Remove">
</form></td>
</tr>
<?php endforeach; ?>
</table>



<br>
<p><a href="index.php">Homepage</a></p>
</section>
</main>
<?php include 'header_footer/footer.php';?>
<?php
  echo"<script src='javaScript/imageZoom.js'></script>";
?>
</body>
</html>
