<?php
/**
 * Created by PhpStorm.
 * User: Don
 * Date: 10/17/2015
 * Time: 1:53 PM
 */

namespace MyImage\OOLogic;

class MyImageOOLogic{

    public function logicAction($result){

        $dir = './src/uploads/';

        $handle = opendir('./src/uploads/');

        while (false !== ($file = readdir($handle))) {

            if ($file != "." && $file != "..") {
                if ($file === $result){
                    $image = "<img src='$dir/$file' height='600' width='600'><br>";
                }

            }

        }
        closedir($handle);

        return $image;
    }

}