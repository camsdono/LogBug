<?php

function CreatePFP($username) {
    $pfp = "https://ui-avatars.com/api/?name=$username&background=random&color=fff&size=128&font-size=0.5&rounded=true&bold=true&length=2&font-family=Arial";
    return $pfp;
}

function CheckPFP($pfp, $username) {
    if (file_exists($pfp)) {
        return $pfp;
    } else {
        $pfp = CreatePFP($username);
        return $pfp;
    }
}

?>