<?php

function CreatePFP($character) {
    $character = strtoupper($character);
    $path = "../../images/pfp/";
    $image = imagecreate(100, 100);
    $red = rand(0, 255);
    $green = rand(0, 255);
    $blue = rand(0, 255);

    imagecolorallocate($image, $red, $green, $blue);
    $textColor = imagecolorallocate($image, 255, 255, 255);

    // create the image with font size 50

    $font = "../../fonts/Roboto/Roboto-Bold.ttf";
    imagettftext($image, 50, 0, 30, 70, $textColor, $font, $character);

    // check if the file exists 
    if (file_exists($path . $character . ".png")) {
        return $path . $character . ".png";
    } else {
        imagepng($image, $path . $character . ".png");
        return $path . $character . ".png";
    }
}

function CheckPFP($pfp, $username) {
    if (file_exists($pfp)) {
        $pfp = $pfp;
    } else {
        $pfp = CreatePFP($username[0]);
    }
}

?>