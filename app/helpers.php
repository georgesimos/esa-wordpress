<?php

namespace App;

use Roots\Sage\Container;

/**
 * Get the sage container.
 *
 * @param string $abstract
 * @param array  $parameters
 * @param Container $container
 * @return Container|mixed
 */
function sage($abstract = null, $parameters = [], Container $container = null)
{
    $container = $container ?: Container::getInstance();
    if (!$abstract) {
        return $container;
    }
    return $container->bound($abstract)
        ? $container->makeWith($abstract, $parameters)
        : $container->makeWith("sage.{$abstract}", $parameters);
}

/**
 * Get / set the specified configuration value.
 *
 * If an array is passed as the key, we will assume you want to set an array of values.
 *
 * @param array|string $key
 * @param mixed $default
 * @return mixed|\Roots\Sage\Config
 * @copyright Taylor Otwell
 * @link https://github.com/laravel/framework/blob/c0970285/src/Illuminate/Foundation/helpers.php#L254-L265
 */
function config($key = null, $default = null)
{
    if (is_null($key)) {
        return sage('config');
    }
    if (is_array($key)) {
        return sage('config')->set($key);
    }
    return sage('config')->get($key, $default);
}

/**
 * @param string $file
 * @param array $data
 * @return string
 */
function template($file, $data = [])
{
    if (remove_action('wp_head', 'wp_enqueue_scripts', 1)) {
        wp_enqueue_scripts();
    }

    return sage('blade')->render($file, $data);
}

/**
 * Retrieve path to a compiled blade view
 * @param $file
 * @param array $data
 * @return string
 */
function template_path($file, $data = [])
{
    return sage('blade')->compiledPath($file, $data);
}

/**
 * @param $asset
 * @return string
 */
function asset_path($asset)
{
    return sage('assets')->getUri($asset);
}

/**
 * @param string|string[] $templates Possible template files
 * @return array
 */
function filter_templates($templates)
{
    $paths = apply_filters('sage/filter_templates/paths', [
        'views',
        'resources/views'
    ]);
    $paths_pattern = "#^(" . implode('|', $paths) . ")/#";

    return collect($templates)
        ->map(function ($template) use ($paths_pattern) {
            /** Remove .blade.php/.blade/.php from template names */
            $template = preg_replace('#\.(blade\.?)?(php)?$#', '', ltrim($template));

            /** Remove partial $paths from the beginning of template names */
            if (strpos($template, '/')) {
                $template = preg_replace($paths_pattern, '', $template);
            }

            return $template;
        })
        ->flatMap(function ($template) use ($paths) {
            return collect($paths)
                ->flatMap(function ($path) use ($template) {
                    return [
                        "{$path}/{$template}.blade.php",
                        "{$path}/{$template}.php",
                    ];
                })
                ->concat([
                    "{$template}.blade.php",
                    "{$template}.php",
                ]);
        })
        ->filter()
        ->unique()
        ->all();
}

/**
 * @param string|string[] $templates Relative path to possible template files
 * @return string Location of the template
 */
function locate_template($templates)
{
    return \locate_template(filter_templates($templates));
}

/**
 * Determine whether to show the sidebar
 * @return bool
 */
function display_sidebar()
{
    static $display;
    isset($display) || $display = apply_filters('sage/display_sidebar', false);
    return $display;
}

/**
 * Prints the button markup
 *
 * @param array $args
 *
 * @copyright wpcoders
 * @return string|void
 */
function the_wpc_button( $args ) {

    if ( empty( $args['data'] ) || ( 'link' === $args['data']['link_type'] && empty( $args['data'][ $args['data']['link_type'] . '_link' ] ) ) ) {
        return;
    }

    $defaults = array(
        'data'    => null,
        'classes' => [ 'btn' ]
    );

    $args = wp_parse_args( $args, $defaults );

    $href    = get_the_wpc_button_link( $args['data'] );
    $label   = get_the_wpc_button_label( $args['data'] );
    $classes = get_the_wpc_button_classes( $args['data'], $args['classes'] );
    $target  = get_the_wpc_button_target( $args['data'] );
    ?>

    <a class="<?= implode( ' ', $classes ); ?>"
       href="<?= $href; ?>"
       title="<?= $label; ?>"
       <?php if ( 'file' === $args['data']['link_type'] ) : ?>download<?php endif; ?>
       <?php if ( '_blank' === $target ) : ?>target="_blank" rel="nofollow"<?php endif; ?>>

        <?php if ( ! empty( $args['data']['icon'] ) ) : ?>
            <i class="<?= $args['data']['icon']; ?> mr-1"></i>
        <?php endif; ?>

        <?= $label; ?>
    </a>
    <?php
}

/**
 * Retrieve the button link
 *
 * @param array $args
 *
 * @return string
 */
function get_the_wpc_button_link( $args ) {

    if ( empty( $args[ $args['link_type'] . '_link' ] ) ) {
        return '';
    }

    $link = $args[ $args['link_type'] . '_link' ];

    if ( 'link' === $args['link_type'] ) {
        $link = $link['url'];
    }

    return $link;
}

/**
 * Retrieve the button label
 *
 * @param array $args
 *
 * @return string
 */
function get_the_wpc_button_label( $args ) {

    if ( empty( $args['label'] ) && empty( $args[ $args['link_type'] . '_link' ] ) ) {
        return '';
    }

    $href  = $args[ $args['link_type'] . '_link' ];
    $label = ! empty ( $args['label'] ) ? $args['label'] : '';

    if ( 'link' === $args['link_type'] ) {
        $label = $href['title'];
    }

    return $label;
}

/**
 * Retrieve the button classes
 *
 * @param array $args
 * @param array $classes
 *
 * @return array
 */
function get_the_wpc_button_classes( $args, $classes = [] ) {

    if ( ! is_array( $classes ) ) {
        $classes = [];
    }

    $classes[] = 'btn';
    $label     = get_the_wpc_button_label( $args );

    $classes[] = 'type-' . $args['link_type'];

    if ( ! empty ( $label ) ) {
        $classes[] = 'has-label';
    }

    if ( 'anchor' === $args['link_type'] ) {
        $classes[] = 'scroll-to';
    }

    if ( ! empty( $args['link_style'] ) ) {
        $classes[] = $args['link_style'];
    } else {
        $classes[] = 'btn-nostyle';
    }

    if ( ! empty ( $args['icon'] ) ) {
        $classes[] = 'has-icon';
    }

    return array_unique( $classes );
}

/**
 * Retrieve the button classes
 *
 * @param array $args
 *
 * @return string
 */
function get_the_wpc_button_target( $args ) {

    $href   = $args[ $args['link_type'] . '_link' ];
    $target = '_self';

    if ( 'link' === $args['link_type'] && ! empty( $href['target'] ) ) {
        $target = '_blank';
    }

    return $target;
}

/**
 * Retrieve responsive image markup
 * @return string
 */
function get_responsive_attachment( $attachment_id, $size = 'medium', $class = null, $sizes = null ) {
    $attr_img_src    = wp_get_attachment_image_url( $attachment_id, $size );
    $attr_img_srcset = wp_get_attachment_image_srcset( $attachment_id, $size );
    $attr_sizes      = wp_get_attachment_image_sizes( $attachment_id, $size );

    if ( ! empty( $sizes ) && constant( $sizes ) ) {

        if ( defined( $sizes ) ) {
            $attr_sizes = constant( $sizes );
        } else {
            $attr_sizes = $sizes;
        }
    }

    return "<img class='{$class}' src='" . esc_url( $attr_img_src ) . "' sizes='" . esc_attr( $attr_sizes ) . "' srcset='" . esc_attr( $attr_img_srcset ) . "' title='" . get_the_title( $attachment_id ) . "' alt='" . get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) . "' />";
}

