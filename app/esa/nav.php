<?php namespace App\ESA\Nav;

if ( ! class_exists( 'ESA_Navwalker' ) ) {

    /**
     * ESA_Navwalker class.
     *
     * @extends Walker_Nav_Menu
     */
    class ESA_Navwalker extends \Walker_Nav_Menu {

        public function start_lvl( &$output, $depth = 0, $args = array() ) {
            if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
                $t = '';
                $n = '';
            } else {
                $t = "\t";
                $n = "\n";
            }
            $indent = str_repeat( $t, $depth );
            // Default class to add to the file.
            $classes = [ 'submenu' ];
            /**
             * Filters the CSS class(es) applied to a menu list element.
             *
             * @since WP 4.8.0
             *
             * @param array $classes The CSS classes that are applied to the menu `<ul>` element.
             * @param stdClass $args An object of `wp_nav_menu()` arguments.
             * @param int $depth Depth of menu item. Used for padding.
             */
            $class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

            $output .= "{$n}{$indent}<ul$class_names role=\"menu\">{$n}";
        }

        public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
                $t = '';
            } else {
                $t = "\t";
            }

            if ( ! empty( $esa_nav_post_type = get_field( 'post_type', $item ) ) ) {
                $esa_post_type_order   = get_field( 'order', $item );
                $esa_post_type_orderby = get_field( 'order', $item );

                $esa_post_type_elements = get_posts( [
                    'post_type'      => $esa_nav_post_type,
                    'posts_per_page' => - 1,
                    'post_status'    => 'publish',
                    'order'          => $esa_post_type_order,
                    'orderby'        => $esa_post_type_orderby,
                ] );

                if ( ! empty( $esa_post_type_elements ) ) {
                    $args->has_children = true;
                }
            }

            $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

            $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes = preg_replace( '/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'active', $classes );
            $classes = preg_replace( '/^((menu|page)[-_\w+]+)+/', '', $classes );

            $classes[] = 'menu-item';

            if ( isset( $args->has_children ) && $args->has_children && 0 === $depth ) {
                $classes[] = 'has-submenu';
            }

            $classes = array_unique( array_filter( $classes ) );

            $class_names = join( ' ', $classes );
            $class_names = $class_names ? ' class="' . esc_attr(
                    $class_names ) . '"' : '';

            $output .= $indent . '<li' . $class_names . '>';

            $atts = array();

            if ( empty( $item->attr_title ) ) {
                $atts['title'] = ! empty( $item->title ) ? strip_tags( $item->title ) : '';
            } else {
                $atts['title'] = $item->attr_title;
            }

            $atts['target'] = ! empty( $item->target ) ? $item->target : '';
            $atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';

            // If item has_children add atts to <a>.
            if ( ! ( isset( $args->has_children ) && $args->has_children && 0 === $depth ) ) {
                $atts['href'] = ! empty( $item->url ) ? $item->url : '#';

                if ( $depth > 0 ) {
                    $atts['class'] = '';
                } else {
                    $atts['class'] = 'menu-link';
                }
            }

            $atts       = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
            $attributes = '';

            foreach ( $atts as $attr => $value ) {
                if ( ! empty( $value ) ) {
                    $value      = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            /**
             * START appending the internal item contents to the output.
             */
            $item_output = isset( $args->before ) ? $args->before : '';
            $title       = apply_filters( 'the_title', $item->title, $item->ID );
            $title       = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

            if ( isset( $args->has_children ) && $args->has_children && 0 === $depth ) {
                $item_output .= '<span class="menu-link">' . $title . '</span>';
            } else {
                $item_output .= '<a' . $attributes . '>';

                // Put the item contents into $output.
                $item_output .= isset( $args->link_before ) ? $args->link_before . $title . $args->link_after : '';

                $item_output .= '</a>';
            }

            $item_output .= isset( $args->after ) ? $args->after : '';

            if ( ! empty( $explanation_text = get_field( 'explanation_text', $item ) ) ) {
                $item_output .= '<div class="explanation-text">' . $explanation_text . '</div>';
            }

            if ( ! empty( $esa_post_type_elements ) ) {
                $item_output .= \App\template( 'partials.submenu-post-types', [ 'menu_items' => $esa_post_type_elements ] );
            }

            /**
             * END appending the internal item contents to the output.
             */
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

        }

        public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
            if ( ! $element ) {
                return;
            }
            $id_field = $this->db_fields['id'];
            // Display this element.
            if ( is_object( $args[0] ) ) {
                $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
            }
            parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
        }
    }
}
