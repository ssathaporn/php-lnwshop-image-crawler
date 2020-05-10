<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $path = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'images';
    $dir = '';


    if( isset($_POST) && !empty( $_POST) ){
        global $path, $dir;
        // preg_match_all('/<img(.*?)data-original="(.*?)"(.*?)>/s', $_POST['txt_source'], $images);
        // preg_match_all('@class="image_img" src="([^"]+)" data-src="([^"]+)"@', $_POST['txt_source'], $images);
        // $src = array_pop($images);
        // echo "<pre>";
        // print_r($src);
        // echo "</pre>";

        $decode = json_decode($_POST['txt_source'], true);
        // echo "<pre>";
        // print_r($decode);
        // echo "</pre>";

        if( !empty($decode) ){
            $product_id = $decode['product']['id'];
            $product_name = $decode['product']['pdata']['name'];
            $product_price = $decode['product']['pdata']['price'];
            $images = $decode['product']['varname']['images'];
            
            createDir($product_id); 
            if( !empty($images) ){

                foreach($images as $key => $value){
                    $file = file_get_contents($value);
                    $tmp = explode('/', $value);
                    $fileName = array_pop($tmp);
                    file_put_contents($path . $dir . DIRECTORY_SEPARATOR . $fileName, $file);
                    $filepath = $path . $dir . DIRECTORY_SEPARATOR . $fileName;
                    echo "\tdownload product image..";
                }

            }

        }
    }


    function createDir($id) {
        global $path, $dir;
    
        if (!is_dir($path)) {
            if (!mkdir($path)){
                die('Failed to create folders...');
            }
        }
    
        $link = $path . $dir . DIRECTORY_SEPARATOR . $id;
    
        if (!is_dir($link)) {
            if (!mkdir($link)){
                die('Failed to create folders...');
            }
    
            echo 'create folder `' . $id . '`';
        } else {
            echo 'existing folder `' . $id . '`';
        }
    
        $dir .= DIRECTORY_SEPARATOR . $id ;
    }
?>