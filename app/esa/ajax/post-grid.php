<?php namespace App\IFPA\Ajax\PostGrid;

/**
 * Load more
 */
add_action( 'wp_ajax_esa_post_grid', __NAMESPACE__ . '\\esa_post_grid' );
add_action( 'wp_ajax_nopriv_esa_post_grid', __NAMESPACE__ . '\\esa_post_grid' );
function esa_post_grid() {
    global $wp_query;

    if ( ! wp_verify_nonce( $_REQUEST['nonce'], 'esa-nonce' ) ||
         ! isset( $_REQUEST['posts_per_page'] ) ||
         ! isset( $_REQUEST['order'] ) ||
         ! isset( $_REQUEST['orderby'] ) ||
         ! isset( $_REQUEST['post_type'] ) ||
         ! isset( $_REQUEST['offset'] )
    ) {
        wp_send_json_error();
        exit;
    }

    $posts_per_page = absint( $_REQUEST['posts_per_page'] );
    $offset         = absint( $_REQUEST['offset'] );

    $args = [
        'post_type'      => $_REQUEST['post_type'],
        'post_status'    => 'publish',
        'offset'         => $offset,
        'orderby'        => $_REQUEST['orderby'],
        'order'          => $_REQUEST['order'],
        'posts_per_page' => $posts_per_page,
    ];

    if ( ! empty( $_REQUEST['exclude'] ) ) {
        $exclude = is_array( $_REQUEST['exclude'] ) ? $_REQUEST['exclude'] : [ $_REQUEST['exclude'] ];

        $args['post__not_in'] = $exclude;
    }

    $wp_query = new \WP_Query( $args );

    ob_start(); ?>
    <?php if ( $wp_query->have_posts() ) : ?>
        <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
            <a class="grid-post elements-in" href="<?= get_the_permalink(); ?>" title="<?= get_the_title(); ?>">
                <div class="inner-wrapper">
                    <h3><?= get_the_title(); ?></h3>

                    <div class="entry-summary">
                        <?= get_field( 'excerpt' ) ?>
                    </div>

                    <span class="find-out-link">
                        <span><?= __( 'Find out more', 'esa' ); ?></span>
                    </span>

                    <div class="section-bg-wrapper">
                        <div class="section-bg"></div>
                    </div>
                </div>
            </a>
            <?php endwhile; ?>
    <?php else : ?>
        <?php
        wp_send_json_error();
        exit;
        ?>
    <?php endif; ?>

    <?php $html = ob_get_clean();

    $total_count = 0;
    $count_posts = wp_count_posts( $_REQUEST['post_type'] );

    if ( isset( $count_posts->publish ) ) {
        $total_count = $count_posts->publish;
    }

    wp_send_json_success( [
        'html'   => preg_replace( '/\v(?:[\v\h]+)/', '', $html ),
        'count'  => isset( $wp_query->found_posts ) ? $wp_query->found_posts : $total_count,
        'offset' => $offset,
    ] );

    exit;
}
