<?php
    require "../config.php";
    require "../functions.php";
    session_start();

    if (!$_SESSION['login']){
        header("Location: ../admin.php");
        exit;
    }

    unset($_SESSION['product_err']);


    function redirect(){
        header("Location: admin_products.php");
        exit;
    }


    global $connection;

        $art = $_POST['art'] ?? '';
        $name = $_POST['name'] ?? '';
        $category = $_POST['category'] ?? '';
        $price = $_POST['price'] ?? '';
        $size = $_POST['size'] ?? '';
        $description = $_POST['description'] ?? '';
        $tags = $_POST['tags'] ?? '';
        $mainPhoto = $_FILES['main_photo'];
        $galleryPhoto = $_FILES['gallery'];


        function get_gallery(): array
        {
            $urlArr = [];
            foreach ($_FILES['gallery']['name'] as $key => $photo) {
                $params = [
                    'name' => $photo,
                    'tmp_name' => $_FILES['gallery']['tmp_name'][$key]
                ];

                $urlArr[] = add_files($params, '/images/models/gallery/');
            }
            return (array)$urlArr;
        }



        function add_product()
        {
            global $connection, $art, $name, $price, $mainPhotoUrl, $tags, $description;
            $addProduct = "INSERT IGNORE INTO products (id, product_art, product_name, product_price, product_img, tags, description) VALUE (NULL, '$art', '$name', '$price', '$mainPhotoUrl', '$tags' , '$description')";
            if ($connection->query($addProduct) === TRUE) ;
        }

        function add_category()
        {
            global $connection, $art, $productId, $category;
            $products = $connection->query("SELECT * FROM products WHERE product_art = '$art'");
            $product = $products->fetch_assoc();
            $productId = $product['id'];
            foreach ($category as $cat) {
                $addProdCat = "INSERT INTO categoryOfProduct (id, category_id, product_id) VALUE (NULL, '$cat', '$productId')";
                if ($connection->query($addProdCat) === TRUE) ;
            }
        }

        function add_size()
        {
            global $connection, $size, $productId;
            foreach ($size as $sizeEl) {
                $addProdSize = "INSERT INTO sizeProduct (id, product_id, size) VALUE (NULL, '$productId', '$sizeEl')";
                if ($connection->query($addProdSize) === TRUE) ;
            }
        }

        function add_gallery()
        {
            global $connection, $productId;
            foreach (get_gallery() as $photo) {
                $addGalleryProduct = "INSERT INTO galleryProduct (id, product_id, product_photo) VALUE (NULL, '$productId', '$photo')";
                if ($connection->query($addGalleryProduct) === TRUE) ;
            }
            redirect();
        }


    if (trim($art) == '' || trim($name) == '' || empty($category) || trim($price) == '' || empty($size)){
        $_SESSION['product_err'] = 'Введіть всі дані!';
        redirect();
    }else {
        $_SESSION['product_err'] = '';
        if (!empty($_POST)) {
            $mainPhotoUrl = add_files($mainPhoto);
            add_product();
            add_category();
            add_size();
            add_gallery();
        }
    }

?>