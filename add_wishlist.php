<?php
require_once('database.php');
// Get IDs
$record_id = filter_input(INPUT_POST, 'record_id', FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
// Add the record to the wishList
if ($record_id != false && $category_id != false) {
    $query = "INSERT INTO wishlists (gameID,genre,code,name,price, image, dateRelease)
              SELECT records.recordID, categories.categoryName, records.code, records.name,records.price,records.image,records.dateRelease
              FROM records
              Inner JOIN categories
              ON records.categoryID = categories.categoryID
              WHERE records.recordID = :record_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':record_id', $record_id);
    $statement->execute();
    $statement->closeCursor();
}
// display the Homepage
/*INSERT INTO wishlists (gameID,genre,code,name,price, image, dateRelease)
SELECT records.recordID, categories.categoryName, records.code, records.name,records.price,records.image,records.dateRelease
FROM records
Inner JOIN categories
ON records.categoryID = categories.categoryID
WHERE records.recordID = 13;*/
include('index.php');
?>


