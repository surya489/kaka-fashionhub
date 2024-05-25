<?php

/**
 * Crop Images on Fly
 */
function image_on_fly($id, $size, $return = false) {
    $original = wp_get_attachment_image_src($id, 'full');
    $downsize = getCropDimension($size, $original);

    $cropped = fly_get_attachment_image_src($id, $downsize, false);
    $image = [
        'src' => $cropped['src'],
        'width' => $cropped['width'],
        'height' => $cropped['height'],
        'alt' => @$cropped['alt']
    ];

    if ($return !== false)
        return $image;

    set_query_var('image', $image);
    get_template_part('inc/component-image');
}

function image_attributes($id) {
    $original = wp_get_attachment_image_src($id, 'full');
    
    $image = [
        'src' => @$original[0],
        'width' => @$original[1],
        'height' => @$original[2],
        'alt' => "",
    ];

    return $image;
}

function getCropDimension($size, $original) {
    $temp = $size;
    if ($size[1] == 'auto')
        $temp[1] = round($size[0] * $original[2] / $original[1]);
    else if ($size[0] == 'auto')
        $temp[0] = round($size[1] * $original[1] / $original[2]);
    else { //Find the outbound dimensions
        $temp[1] = round($size[0] * $original[2] / $original[1]);
        if ($temp[1] < $size[1]) {
            $temp[0] = round($size[1] * $original[1] / $original[2]);
            $temp[1] = $size[1];
        }
    }

    return $temp;
}