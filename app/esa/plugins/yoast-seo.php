<?php namespace App\ESA\Plugins\YoastSEO;

/**
 * Move Yoast Meta Box to bottom
 */
add_filter( 'wpseo_metabox_prio', function() {
    return 'low';
} );
