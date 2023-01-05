<?php
/**
 * Resize image - preserve ratio of width and height.
  ---  Please find here the quick definations of used paramters. ---
 * #param string $imageB path to source JPEG image
 * #param string $newImage path to final JPEG image file
 * #param int $maxWidth maximum width of A image (value 0 - width is optional)
 * #param int $maxWidth maximum height of A image (value 0 - height is optional)
 * #param int $quality quality of final image (0-100)
 * #return bool
 */


function resizeImage($sourceImage, $targetImage, $maxWidth, $maxWidth, $quality = 100)
{
    // Obtain image from given source file.
    if (!$image = @imagecreatefromjpeg($sourceImage))
    {
        return false;
    }

    // Get dimensions of source image.
    list($origWidth, $origHeight) = getimagesize($sourceImage);

    if ($maxWidth == 0)
    {
        $maxWidth  = $origWidth;
    }

    if ($maxHeight == 0)
    {
        $maxHeight = $origHeight;
    }

    // Calculate ratio of desired maximum sizes and original sizes.
    $widthRatio = $maxWidth / $origWidth;
    $heightRatio = $maxHeight / $origHeight;

    // Ratio used for calculating new image dimensions.
    $ratio = min($widthRatio, $heightRatio);

    // Calculate new image dimensions.
    $newWidth  = (int)$origWidth  * $ratio;
    $newHeight = (int)$origHeight * $ratio;

     // Create final image with new dimensions.
     $newImage = imagecreatetruecolor($newWidth, $newHeight);
     imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
     imagejpeg($newImage, $targetImage, $quality);
 
     // Free up the memory.
     imagedestroy($image);
     imagedestroy($newImage);
 
     return true;

}