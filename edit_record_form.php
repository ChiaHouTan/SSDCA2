<?php
require('database.php');
$record_id = filter_input(INPUT_POST, 'record_id', FILTER_VALIDATE_INT);
$query = 'SELECT *
          FROM records
          WHERE recordID = :record_id';
$statement = $db->prepare($query);
$statement->bindValue(':record_id', $record_id);
$statement->execute();
$record = $statement->fetch(PDO::FETCH_ASSOC);
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
        <h1>Edit game</h1>
        <form class="textBold" action="edit_record.php" method="post" enctype="multipart/form-data"
              id="add_record_form">
            <input type="hidden" name="original_image" value="<?php echo $record['image']; ?>" />
            <input type="hidden" name="record_id"
                   value="<?php echo $record['recordID']; ?>">
            <label>Genre ID:</label>
            <input type="category_id" name="category_id"
                   value="<?php echo $record['categoryID']; ?>">
            <br>
            <label>Code:</label>
            <input type="input" name="code"
                   value="<?php echo $record['code']; ?>">
            <br>
            <label>Name:</label>
            <input type="input" name="name"
                   value="<?php echo $record['name']; ?>">
            <br>
            <label>Price:</label>
            <input type="input" name="price"
                   value="<?php echo $record['price']; ?>">
            <br>
            <label>Stock:</label>
            <input pattern="[0-9]+"
            type="input" name="stock"
                   value="<?php echo $record['stock']; ?>"> <h1 class="floatLeft textItalic">e.g 123</h1>
            <br>
            <label>Release Date:</label>
            <input pattern="^(19|20)\d\d([- /.])(0[1-9]|1[012])\2(0[1-9]|[12][0-9]|3[01])$"
            type="input" name="dateRelease"
                   value="<?php echo $record['dateRelease']; ?>"> <h1 class="floatLeft textItalic">e.g yyyy-mm-dd</h1>
            <br>
            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>
            <?php if ($record['image'] != "") { ?>
            <p><img src="image_uploads/<?php echo $record['image']; ?>" height="150" /></p>
            <?php } ?>
            <label>&nbsp;</label>
            <input type="submit" value="Save Changes">
            <br>
        </form>
    </main>
    <footer>
    <?php include 'header_footer/footer.php';?>
    </footer>
</body>
</html>