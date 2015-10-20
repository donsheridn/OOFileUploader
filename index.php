<?php

namespace MyImage;

use MyImage\OOLogic;

include_once('src/controller/MyImageOOLogic.php');

$result = $_GET['result'];

if ($result) {

    include_once 'src/view/FileUploadHeader.php';

    $logic = new OOLogic\MyImageOOLogic();

    $image = $logic->logicAction($result);

    include_once 'src/view/FileUploadBodyResult.php';

    include_once 'src/view/FileUploadFooter.php';
}
else {
    include_once('src/controller/upload.php');

    include_once 'src/view/FileUploadHeader.php';
    include_once 'src/view/FileUploadBody.php';

    include_once 'src/view/FileUploadFooter.php';
}
