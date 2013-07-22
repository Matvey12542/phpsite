<?php

class Image{
    public $image;
    public $image_type;
    
    function load($filename){
        $image_info = getimagesize($filename);
        $this->image_type = $image_info[2];                 // array 4 [2] - type image!!!
        if($this->image_type == IMAGETYPE_JPEG){
            $this->image = imagecreatefromjpeg($filename);            
        }elseif($this->image_type == IMAGETYPE_GIF){
            $this->image = imagecreatefromgif($filename);
        }elseif ($this->image_type == IMAGETYPE_PNG) {
            $this->image = imagecreatefrompng($filename);
        }        
    }
    function save($filename,$image_type=IMAGETYPE_JPEG,$compresion=75,$permissions=NULL){
        if($image_type == IMAGETYPE_JPEG){
            imagejpeg($this->image,$filename,$compresion);
        }elseif( $image_type == IMAGETYPE_GIF ) {
            imagegif($this->image,$filename);
        } elseif( $image_type == IMAGETYPE_PNG ) {
            imagepng($this->image,$filename);
        }
        if( $permissions != null) {
           //chmod($filename,$permissions);
            chmod($filename,0777);
        }
    }
    function getWidth() {
      return imagesx($this->image);
   }
   function getHeight() {
      return imagesy($this->image);
   }
    function resize($width,$height){
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $new_image;
    }
}
?>
