<?php
require('database.php');
$query = 'SELECT *
          FROM categories
          ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
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
<?php include 'header_footer/header.php';?>

    <main>
        <h1>Add Game</h1>
        <form class="textBold" action="add_record.php" method="post" enctype="multipart/form-data"
              id="add_record_form">
            <label>Genre:</label>
            <select name="category_id">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>

            <label>Code:</label>
            <input type="input" name="code" required>
            <br>

            <label>Name:</label>
            <input type="input" name="name" required>
            <br>

            <label>Price:</label>
            <input type="input" name="price" required>
            <br>
            <label>Stock:</label>
            <input type="input" name="stock" required
            pattern="[0-9]+"> <h1 class="floatLeft textItalic">e.g 123</h1>
            <br>
            <label>Release Date:</label>
            <input type="input" name="dateRelease" required
            pattern="^(19|20)\d\d([- /.])(0[1-9]|1[012])\2(0[1-9]|[12][0-9]|3[01])$"> <h1 class="floatLeft textItalic">e.g yyyy-mm-dd</h1>
            <br>

            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>
            <label>&nbsp;</label>
            <input type="submit" value="Add Game">
            <br>
        </form>
        <p><a href="index.php">Homepage</a></p>
    </main>
    <?php include 'header_footer/footer.php';?>
</body>
</html>