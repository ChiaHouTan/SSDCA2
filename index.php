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
// Get name for current category
$queryCategory = "SELECT * FROM categories
WHERE categoryID = :category_id";
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$statement1->closeCursor();
$category_name = $category['categoryName'];
// Get all categories
$queryAllCategories = 'SELECT * FROM categories
ORDER BY categoryID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();
// Get records for selected category
$queryRecords = "SELECT * FROM records
WHERE categoryID = :category_id
ORDER BY recordID";
$statement3 = $db->prepare($queryRecords);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$records = $statement3->fetchAll();
$statement3->closeCursor();
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
<h1>PlayStation 4 Games List</h1>
<aside>
<!-- display a list of wishlist that add in the sidebar -->
<p><a href="wishlist_form.php">Wishlist</a></p>
<!-- display a list of categories in the sidebar-->
<h2>Genres</h2>
<nav>
<ul>
<?php foreach ($categories as $category) :?>
<li><a href=".?category_id=<?php echo $category['categoryID']; ?>">

<?php echo $category['categoryName']; ?>
</a>
</li>
<?php endforeach; ?>
</ul>
</nav>
</aside>
<section>
<!-- display a table of records from the database -->
<h2><?php echo $category_name; ?></h2>
<table>
<tr>
<th>Image</th>
<th>Name</th>
<th>Code</th>
<th>Price</th>
<th>Stock</th>
<th>Release Date</th>
<th>Wishlist Add</th>
<th>Delete</th>
<th>Edit</th>
</tr>
<?php foreach ($records as $record) : ?>
<tr>
<td class="textCenter"><img class="zoomD" src="image_uploads/<?php echo $record['image']; ?>" width="auto" height="600px" /></td>
<td><?php echo $record['name']; ?></td>
<td><?php echo $record['code']; ?></td>
<td class="textRight"><?php echo $record['price']; ?></td>
<td class="textRight"><?php echo $record['stock']; ?></td>
<td class="textCenter"><?php echo $record['dateRelease']; ?></td>

<!-- Add to WishList Button -->
<td class="textCenter"><form action="add_wishlist.php" method="post"  
id="delete_record_form">
<input type="hidden" name="record_id"
value="<?php echo $record['recordID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $record['categoryID']; ?>">
<input class="textBold" type="submit" value="Add to Wishlist">
</form></td>

<td class="textCenter"><form action="delete_record.php" method="post"
id="delete_record_form">
<input type="hidden" name="record_id"
value="<?php echo $record['recordID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $record['categoryID']; ?>">
<input class="textBold" type="submit" value="Delete">
</form></td>
<td class="textCenter"><form action="edit_record_form.php" method="post"
id="delete_record_form">
<input type="hidden" name="record_id"
value="<?php echo $record['recordID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $record['categoryID']; ?>">
<input class="textBold" type="submit" value="Edit">
</form></td>
</tr>
<?php endforeach; ?>
</table>
<br>
<button><a href="add_record_form.php">Add Game</a></button>
<br><br>
<button><a href="category_list.php">Edit Genres</a></button>
</section>
</main>
<?php include 'header_footer/footer.php';?>
<?php
  echo"<script src='javaScript/imageZoom.js'></script>";
?>
</body>
</html>