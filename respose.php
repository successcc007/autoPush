<?php

//if ((($_FILES["img"]["type"] == "image/png")
//        || ($_FILES["img"]["type"] == "image/jpeg")
//        || ($_FILES["img"]["type"] == "image/jpg"))
//) {
//    if ($_FILES["img"]["error"] > 0) {
//      echo  "Return Code: ";
//      //  echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
//    } else {
//        echo  "ok";
////        echo "Upload: " . $_FILES["file"]["name"] . "<br />";
////        echo "Type: " . $_FILES["file"]["type"] . "<br />";
////        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
////        echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
//
//
////        if (file_exists("upload/" . $_FILES["file"]["name"]))
////        {
////            echo $_FILES["file"]["name"] . " 已经保存. ";
////        }
////        else
////        {
////            move_uploaded_file($_FILES["file"]["tmp_name"],
////                "upload/" . $_FILES["file"]["name"]);
////            echo "存入: " . "upload/" . $_FILES["file"]["name"];
////        }
//    }
//} else {
//    echo "Invalid file";
////    var_dump($_FILES['img']['size']);
//}

//var_dump($_FILES['img']['tmp_name']);
//var_dump($_FILES['img']['name']);
var_dump($_POST);



?>