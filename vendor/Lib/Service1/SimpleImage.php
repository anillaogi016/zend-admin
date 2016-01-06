<?php   /* * File: SimpleImage.php * Author: Simon Jarvis * Copyright: 2006 Simon Jarvis * Date: 08/11/06 * Link: http://www.white-hat-web-design.co.uk/articles/php-image-resizing.php * * This program is free software; you can redistribute it and/or * modify it under the terms of the GNU General Public License * as published by the Free Software Foundation; either version 2 * of the License, or (at your option) any later version. * * This program is distributed in the hope that it will be useful, * but WITHOUT ANY WARRANTY; without even the implied warranty of * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the * GNU General Public License for more details: * http://www.gnu.org/licenses/gpl.html * */   

namespace Lib\Service1;

class SimpleImage {   
	var $image; var $image_type;   
	
	function load($filename , $orientation=0) { 
	 $image_info = getimagesize($filename);
	 $this->image_type = $image_info[2]; 
	 if( $this->image_type == IMAGETYPE_JPEG ) {   
	 	$this->image = imagecreatefromjpeg($filename); 
	 	} elseif( $this->image_type == IMAGETYPE_GIF ) {   
	 		$this->image = imagecreatefromgif($filename); 
	 	} elseif( $this->image_type == IMAGETYPE_PNG ) {   
	 		$this->image = imagecreatefrompng($filename); 
	 	}
		
		if($orientation != 0) {
			switch($orientation) {
									case 8:
										$this->image = imagerotate($this->image,90,0);
										break;
									case 3:
										$this->image = imagerotate($this->image,180,0);
										break;
									case 6:
										//echo "hiii"; die;
										$this->image = imagerotate($this->image,-90,0);
										break;
								}
		}
		
	}

	
	 	function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {   
	 		if( $image_type == IMAGETYPE_JPEG ) { 
				imagejpeg($this->image,$filename,$compression); 
	 			} elseif( $image_type == IMAGETYPE_GIF ) {   
	 				imagegif($this->image,$filename); 
	 			} elseif( $image_type == IMAGETYPE_PNG ) {   
	 				imagepng($this->image,$filename); 
	 			} if( $permissions != null) {   
	 				chmod($filename,$permissions); 
	 			} 
	 			}
	 	function output($image_type=IMAGETYPE_JPEG) {   
	 		if( $image_type == IMAGETYPE_JPEG ) { 
	 			imagejpeg($this->image); 
	 		} elseif( $image_type == IMAGETYPE_GIF ) {   
	 			imagegif($this->image); 
	 		} elseif( $image_type == IMAGETYPE_PNG ) {   
	 			imagepng($this->image); 
	 		}
	 		} 
	 		function getWidth() {   
	 			return imagesx($this->image); 
	 		} 
	 		function getHeight() {   
	 			return imagesy($this->image); 
	 		} 
	 		function resizeToHeight($height) {   
	 			$ratio = $height / $this->getHeight(); 
	 			$width = $this->getWidth() * $ratio; 
	 			$this->resize($width,$height); 
	 		}   
	 		function resizeToWidth($width) { 
	 			$ratio = $width / $this->getWidth(); 
	 			$height = $this->getheight() * $ratio; 
	 			$this->resize($width,$height); 
	 		}  

	 	private function getSizeByFixedHeight($newHeight)
{
    $ratio = $this->width / $this->height;
    $newWidth = $newHeight * $ratio;
    return $newWidth;
}
 
private function getSizeByFixedWidth($newWidth)
{
    $ratio = $this->height / $this->width;
    $newHeight = $newWidth * $ratio;
    return $newHeight;
}	 
	 		function getSizeByAuto($width,$height)
{
	$this->height=$this->getheight();
	$this->width=$this->getWidth();  
    if ($this->height < $this->width)
    // *** Image to be resized is wider (landscape)
    {
        $optimalWidth = $width;
        $optimalHeight= $this->getSizeByFixedWidth($width);
    }
    elseif ($this->height > $this->width)
    // *** Image to be resized is taller (portrait)
    {
        $optimalWidth = $this->getSizeByFixedHeight($height);
        $optimalHeight= $height;
    }
    else
    // *** Image to be resizerd is a square
    {
        if ($newHeight < $newWidth) {
            $optimalWidth = $newWidth;
            $optimalHeight= $this->getSizeByFixedWidth($newWidth);
        } else if ($newHeight > $newWidth) {
            $optimalWidth = $this->getSizeByFixedHeight($newHeight);
            $optimalHeight= $newHeight;
        } else {
            // *** Sqaure being resized to a square
            $optimalWidth = $newWidth;
            $optimalHeight= $newHeight;
        }
    }
 $this->resize($optimalWidth,$optimalHeight); 
  //  return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
}

	 		function scale($scale) { 
	 			$width = $this->getWidth() * $scale/100; 
	 			$height = $this->getheight() * $scale/100; 
	 			$this->resize($width,$height); 
	 		}  
	 		 function resize($width,$height) { 
	 		 	$new_image = imagecreatetruecolor($width, $height); 
	 		 	imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
	 		 	 $this->image = $new_image; 
	 		 	 }  
	 		 } ?> 