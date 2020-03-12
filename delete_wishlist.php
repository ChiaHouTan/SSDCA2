<?php
require_once('database.php');
// Get IDs
$game_ID = filter_input(INPUT_POST, 'game_ID', FILTER_VALIDATE_INT);
// Delete the record from the database
if ($game_ID != false) {
    $query = "DELETE FROM wishlists
              WHERE gameID = :game_ID";
    $statement = $db->prepare($query);
    $statement->bindValue(':game_ID', $game_ID);
    $statement->execute();
    $statement->closeCursor();
}
// display the Homepage
include('wishlist_form.php');
?>