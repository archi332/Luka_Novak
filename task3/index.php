<?php

require_once('image_info.php');

if(isset($_GET['image'])) {
    $image_info = new image_info($_GET['image']);
    $image_info->Manipulation_image();

    echo 'Width of image: ' . $image_info->getWidth() . ' px<br>';
    echo 'Height of image: ' . $image_info->getHeight() . ' px<br>';
    echo 'Count different colors of the image: ' . count($image_info->getColor()).'<br>';
    echo 'Summ of all point colors: ' . array_sum($image_info->getColor()).'<br>';
    echo 'Fact resolution of image: ' . $image_info->getHeight() * $image_info->getWidth();

    echo '<pre>';

    print_r($image_info->getColor());
}

?>
</pre>

<form action="/" method="get">
    Insert URL of image:
    <input type="text" name="image">
    <button type="submit">verify</button>
</form>








