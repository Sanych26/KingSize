<?php

/**
 * Output array
 **/
    function print_arr($array)
    {
        echo "<pre>" . print_r($array , true) . "</pre>";
    }

/**
 * Add gallery
 **/
    function add_files($gallery, $dir = '/images/testimonials/')
    {
        $uploadfileGallery = $_SERVER['DOCUMENT_ROOT'] . $dir . basename($gallery['name']);
        if (!is_uploaded_file($gallery['tmp_name'])) {
            echo "Загрузка файла на сервер не удалась";
            die(); //or throw exception...
        }
        //Проверка что это картинка
        if (!getimagesize($gallery['tmp_name'])) {
            echo "Это не картинка...";
            die(); //or throw exception...
        }
        if (move_uploaded_file($gallery['tmp_name'], $uploadfileGallery)) {
            echo "Файл корректен и был успешно загружен.\n";
        } else {
            echo "Возможная атака с помощью файловой загрузки!\n";
        }
        return $dir . $gallery['name'];
    }
?>