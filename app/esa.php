<?php namespace App;

class ESA {

    protected static $_instance = null;

    public $posts_page_id;
    public $stories_page_id;
    public $case_studies_page_id;

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function __construct() {
        add_action( 'after_setup_theme', [ $this, 'load_defaults' ] );
    }

    public function load_defaults() {
        $this->posts_page_id = wpc_get_default_page_id( 'post' );
        $this->stories_page_id = wpc_get_default_page_id( 'esa_story' );
        $this->case_studies_page_id = wpc_get_default_page_id( 'esa_case_study' );
    }
}

function ESA() {
    return ESA::instance();
}

ESA();
