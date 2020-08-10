<?php

class UploadController {
    function CheckImageType($fileType) {
        if (($fileType == "image/gif") ||
            ($fileType == "image/jpeg") ||
            ($fileType == "image/jpg") ||
            ($fileType == "image/png")) 
        {
            return true;    
        } else {
            return false;
        }
    }
}

?>
