<?php namespace App\ESA\Filters;

/**
 * Background type for default page
 */
add_action( 'get_header_after', function () {
    if ( basename( get_page_template() ) === 'page.blade.php' ) {
        echo \App\template( 'partials.page-background' );
    }
} );

/**
 * Awwards banner
 */
// add_action( 'get_footer', function () {
//     echo \App\template( 'partials.awwards' );
// } );
