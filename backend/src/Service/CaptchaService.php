<?php

namespace App\Service;

use GdImage;



class CaptchaService




{   


    private static array $captchaList = [];

    public static function validate($id,$text){
        if(!empty($captchaList[$id]) && $captchaList[$id]==$text){
            return true;
        }else{
            return false;
        }
    }
    

    public static function createImage() {
         
        $string = "abcdefghijklmnopqrstuvwxyz0123456789"; 
        $str = '';
        $length = strlen($string);
         
        for ($i = 0; $i < 5; $i++) { 
             
            $pos = rand(0, $length - 1); 
            $str .= $string[$pos]; 
        }
        
         
        $width = 60;
        $height = 22;
        $img_handle = imagecreate($width, $height);
        if (!$img_handle) {
            throw new \Exception("Невозможно создать изображение.");
        }
        
         
        $back_color = imagecolorallocate($img_handle, 102, 102, 153); 
        $txt_color  = imagecolorallocate($img_handle, 255, 255, 255);
        
         
        imageString($img_handle, 5, 5, 2, $str, $txt_color);
        
         
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['img_number'] = $str;
        
         
        ob_start();
        imagepng($img_handle);
        $imageData = ob_get_clean();  
        
         
        imagedestroy($img_handle);

        $base64Image = base64_encode($imageData);


        $id = (string)(microtime(true) * 10000);

        self::$captchaList[$id] = $str;


        
        
        return [
            "imageData"=>$base64Image,
            "id"=>$id
        ];
    }


	
}