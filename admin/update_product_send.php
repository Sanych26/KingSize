<?php
require "../config.php";
require "../functions.php";
session_start();

if (!$_SESSION['login']){
    header("Location: ../admin.php");
    exit;
}

unset($_SESSION['product_err']);

global $connection;

$prodId = $_SESSION['prodId'];
$art = $_POST['art'] ?? '';
$name = $_POST['name'] ?? '';
$price = $_POST['price'] ?? '';
$categories = $_POST['category'] ?? '';
$size = $_POST['size'] ?? '';
$description = $_POST['description'] ?? '';
$tags = $_POST['tags'] ?? '';

function errRedirect(){
    global $prodId;
    header("Location: update_product.php?id=$prodId");
    exit;
}

function redirect(){
    header("Location: admin_products.php");
    exit;
}



function update_product()
{
    global $connection, $art, $name, $price, $tags, $description, $prodId;
    $updProduct = "UPDATE products SET product_art = '$art', product_name = '$name', product_price = '$price', tags = '$tags', description = '$description' WHERE id = '$prodId'";
    if ($connection->query($updProduct) === TRUE);
}

function update_categories()
{
    global $connection, $categories, $prodId;
    $query = "DELETE FROM categoryOfProduct WHERE product_id = '$prodId'";
    if ($connection->query($query) === TRUE);
    foreach ($categories as $category) {
        $updProdCategory = "INSERT INTO categoryOfProduct (id, category_id, product_id) VALUE (NULL, '$category', '$prodId')";
        if ($connection->query($updProdCategory) === TRUE) ;
    }
}

function update_size()
{
    global $connection, $size, $prodId;
    $query = "DELETE FROM sizeProduct WHERE product_id = '$prodId'";
    if ($connection->query($query) === TRUE);
    foreach ($size as $sizeEl) {
        $updProdSize = "INSERT INTO sizeProduct (id, product_id, size) VALUE (NULL, '$prodId', '$sizeEl')";
        if ($connection->query($updProdSize) === TRUE) ;
    }
}

if (trim($art) == '' || trim($name) == '' || trim($price) == '' || empty($categories) || empty($size)){
    $_SESSION['product_err'] = 'Введіть всі дані!';
    errRedirect();
}else {
    $_SESSION['product_err'] = '';
    if (!empty($_POST)) {
        update_product();
        update_categories();
        update_size();
        redirect();
    }
}

?>
