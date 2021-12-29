<?php

class Image {


    function __construct() {}


    public function show($imagepath){

        // Read image path, convert to base64 encoding
        $imageData = base64_encode(file_get_contents($imagepath));

        // Format the image SRC:  data:{mime};base64,{data};
        $src = 'data: '.mime_content_type($imagepath).';base64,'.$imageData;

        return $src;

    }
}


// $image = 'images/fra.jpg';


// // Echo out a sample image
// echo '<img src="' . $src . '">';
// echo '<img src="' . $src . '">';
// echo '<img src="' . $src . '">';
// echo '<img src="' . $src . '">';
// echo '<img src="' . $src . '">';