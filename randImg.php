<?php date_default_timezone_set("Etc/GMT-8"); ?>
<?php include 'function.php';?>
<?php

$r = $_GET["img"];
if($r == '1'){
    header('Location: https://source.unsplash.com/random');
}
else if($r == '2'){
    /// sexy
    header('Location: https://uploadbeta.com/api/pictures/random/?key=%E6%80%A7%E6%84%9F');
}
else if($r == '3'){
    header('Location: https://uploadbeta.com/api/pictures/random/?key=%E5%B7%A8%E4%B9%B3');
}
else{
    header('Location: https://uploadbeta.com/api/pictures/random/');
}

// 


?>
