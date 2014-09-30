<?php
/**
 * Widget html for the front end
 */

//create html based on layout selection
switch( $layout ){
    case 'side':
        $content = <<<CONTENT
            
            <div class='wrap content-blurb-side'>
                <div class='one-fourth first'>
                    $image
                </div>
                <div class='three-fourths text-left'>
                    $title
                    $text
                </div>
            </div>
            
CONTENT;
        break;
    default:
        $content = <<<CONTENT
            
            <div class='wrap content-blurb-top lp-text-center'>
                <div>
                    $image
                </div>
                <div>
                    $title
                    $text
                </div>
            </div>
            
CONTENT;
        break;
}

echo $content;

?>