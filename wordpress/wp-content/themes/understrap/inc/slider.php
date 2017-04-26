<?php


if ( ! function_exists( 'get_my_gallery_content' ) ) {
    
    function get_my_gallery_content ($atts) {
        
        $content = '';
        
        $ids = explode(',', $atts['ids']);
        
        $padding = 5;
        $height = $atts['height'];
        $width = $atts['width'];
        $pags = explode(',', $atts['pags']);
        $ws = explode(',', $atts['ws']);
        $hs = explode(',', $atts['hs']);
        

        $content .= '<div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false"
                        style="width: ' . $width .'; height:' . $height . 'px">';
                
        
//        
//        $content .= '<ol class="carousel-indicators">'; // indicators
//                
//        $active = 'active';
//        for($i = 0; $i < sizeof($pags); $i ++){
//            
//           $content .= '<li data-target="#myCarousel" data-slide-to="' . $i . '" '
//                   . 'class="' . $active . '"></li>';
//           
//           $active = '';
//         
//        }
//        $content .= '</ol>';
        
        // wrapper for slides
        $content .= '<div class="carousel-inner" role="listbox">';
        
        $active = 'active';
        $slideN = 0;
        // loop the slides
        for($i = 0; $i < sizeof($pags); $i ++){
            
            $content .= '<div class="carousel-item ' . $active . '" >';
            
            $sameColumn = false;
            $lineHPerc = 0;
            $addStart = '';
            $addEnd = '';
            // loop the images in the slide
            for($j = 0; $j < $pags[$i]; $j ++){
                
                $id = $ids[$slideN];
                
                $w = $ws[$slideN];
                $h = ($height * $hs[$slideN]) / 100;
                
                $addStart = '<div style="width:' . ($w) . '%;height:' . ($height) . ';max-height="' . ($height) . ';">';
                $addEnd = '</div>';
                $addClass = '';
                
                $lineHPerc += $hs[$slideN];// count the percentage of the heights
                
                if($sameColumn){
                    
                    $addStart = '';// remove the start of the column div
                    
                    $h = ($height * $hs[$slideN]) / 102.5;// set height counting with the seperator (the other half)
                    
                    $sameColumn = false;// this is the second part of the column, from now on, behave like a regular column
                }
                
                
                
                
                // if height < 100 and the sum of next img height < 100, set img below
                if($lineHPerc < 100) {
                    $nexthPerc = $hs[$slideN + 1];
                    // if next height fits on current column, insert below, else start a new column
                    if( ($nexthPerc != null) && ($lineHPerc + $nexthPerc) <= 100 ){
                        $sameColumn = true;
                        $addClass = 'margin-bottom:5%;';
                        $h = ($height * ($hs[$slideN])) / 102.5;// set height counting with the seperator (the other half)
                    } else {
                        
                        // reset line Height percentage
                        $lineHPerc = 0;
                    }
                } else {
                    $lineHPerc = 0;
                }
                
                $content .= $addStart;
                $content .= '<div data-slide-to="' . $i . '" class="slide-wrapper" style="' . $addClass . 'height:' . $h . 'px;width:95%;">';
                $content .= '<div class="pop" style="background-image:url(\'' . wp_get_attachment_image_src($id, 'max-width')[0] . '\');width:100%;height:' . ($h) . 'px" class="d-block img-fluid" alt="' . wp_get_attachment_caption($id) . '"></div>';
                $content .= '</div>';
                $content .= $sameColumn ? '' : $addEnd;
                
                $slideN ++;
            }
            
            $active = '';
            $content .= '</div>';
        }
        
        
        
        // Left and right controls
        $content .= '<div class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">';
        $content .= '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
        $content .= '<span class="sr-only">' . _x('Previous', 'understrap carousel') . '</span>';
        $content .= '</div>';
        $content .= '<div class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">';
        $content .= '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
        $content .= '<span class="sr-only">' . _x('Next', 'understrap carousel') . '</span>';
        $content .= '</div>';
        $content .= '</div>';
        
        $content .= '</div>';

        
        //<!-- Creates the bootstrap modal where the image will appear -->
        $content .= '<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'
          . '<div class="vertical-alignment-helper">'
          . '<div class="modal-dialog vertical-align-center">'
            . '<div class="modal-content">'
            . '<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only"></span></button>'
              . '<div class="modal-body">'
                . '<img src="" id="imagepreview" class="img-responsive" >'
              . '</div>'
            . '</div>'
          . '</div>'
          . '</div>'
        . '</div>';
        
       return $content; 
    }
}


