<?php

generateCaptcha(5,40,120,"#ff0000","#00ff00");

/**
 * creation d'une image captcha
 * @param int $nombreChiffre
 * @param int $hauteur en px
 * @param int $largeur en px
 * @param string $Background ex: #ffffff
 * @param string $couleurTxt ex: #ffffff
 */
function generateCaptcha($nombreChiffre, $hauteur = 40, $largeur = 120, $Background = "#112135", $couleurTxt = "#C5E421") {

    $error = 0;
    if (($hauteur < 40) && ((is_int($hauteur)))){
        echo 'la hauteur est trop petite';
        $error = 1;
    }
    if (!(is_int($hauteur))){
        echo 'la hauteur dois comporter un nombre';
        $error = 1;
    }
    if (($largeur < ($nombreChiffre * 20)) && ((is_int($largeur)))){
        echo 'la largeur est trop petite pour le nombre de caractere';
        $error = 1;
    }
    
    if (!(is_int($largeur))){
        echo 'la largeur dois comporter un nombre';
        $error = 1;
    }
    if (!(is_int($nombreChiffre))){
        echo 'le nombre ne peux avoir que des chiffre';
        $error = 1;
    }
    if ($error != 1){
        $captcha = "";

        for ($i = 0; $i < $nombreChiffre; $i++){
            $captcha .= mt_rand(0, 9);
        }

        $img = imagecreate($largeur, $hauteur);
        list ($backgroundR, $backgroundG, $backgroundB) = colorToDecimal($Background);
        
        if (($backgroundR != '') || ($backgroundR == '0')){
            list ($textR, $textG, $textB) = colorToDecimal($couleurTxt);
            
                if (($textR != '') || ($textR == '0')){
                    $bg = imagecolorallocate($img, $backgroundR, $backgroundG, $backgroundB);
                    $fonts = 'fonts/SIXTY.TTF';
                    colorToDecimal($couleurTxt);
                    $textcolor = imagecolorallocate($img, $textR, $textG, $textB);
                    imagettftext($img, 23, 0, 25, 30, $textcolor, $fonts, $captcha);
                    header('content-type:image/jpeg');
                    imagejpeg($img);
                    imagedestroy($img);
                }
                else {
                    echo 'erreur sur la couleur du text';
                }
        }
        else{
            echo 'erreur sur la couleur du background';
        }

    }
}

/**
 * convertir une couleur de hexadecimal en rgb
 * @param string $color
 * @return array
 */
function colorToDecimal($color) {

    $color = str_replace('#', '', $color);
    if((strlen($color))== 6){
        if (ctype_xdigit($color)){
            $red = hexdec(substr($color, 0, 2));
            $green = hexdec(substr($color, 2, 2));
            $bleu = hexdec(substr($color, 4, 2));
            return array($red, $green, $bleu);
        }
    }
    else {
        return 0;
    }
    
}
