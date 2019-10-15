@if( have_rows('post_grid') )
    @while( have_rows('post_grid') ) @php the_row() @endphp

    @php
        $fields = [
          'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( 'post_grid' . '-' ),
          'title' => get_sub_field( 'title' ),
          'post_type' => get_sub_field( 'post_type' ),
          'exclude' => get_sub_field( 'exclude' ),
          'order' => get_sub_field( 'order' ),
          'orderby' => get_sub_field( 'orderby' ),
          'posts_per_page' => get_sub_field( 'posts_per_page' ),
          'padding' => get_sub_field( 'post_grid_padding' ),
        ];

        $args = [
          'post_type' => $fields['post_type'],
          'post_status' => 'publish',
          'orderby' => $fields['orderby'],
          'order' => $fields['order'],
          'posts_per_page' => -1,
          'paged' => 1,
        ];

        $data = [
        	  'post_type' => $args['post_type'],
        	  'orderby' => $args['orderby'],
            'order' => $args['order'],
            'posts_per_page' => -1,
        ];

        if ( ! empty( $fields['exclude'] ) ) {
          $args['post__not_in'] = $fields['exclude'];
          $data['exclude'] = $args['post__not_in'];
        }

        if ( $fields['posts_per_page'] > 0 ) {
          if ( get_query_var('paged') ) {
            $paged = get_query_var('paged');
          } else if ( get_query_var('page') ) {
            $paged = get_query_var('page');
          } else {
            $paged = 1;
          }

          $args['posts_per_page'] = $fields['posts_per_page'];
          $data['posts_per_page'] = $args['posts_per_page'];
          $args['paged'] = $paged;
        }

        $data_tags = [];

        foreach( $data as $k => $d ) {
          if( is_array( $d ) ) {
            $data_tags[] = 'data-' . $k . '='. implode( ' ', $d );
          } else {
              $data_tags[] = 'data-' . $k . '='. $d;
          }
        }

        $fields['query'] = new WP_Query();
        $fields['query']->query( $args );

        $wp_query = $fields['query'];

        $classes = [
          'layout-item',
          'post_grid',
          'pt-' . $fields['padding']['top'],
          'pb-' . $fields['padding']['bottom']
        ];
    @endphp

    @include( 'flexibles.templates.post_grid',  [
      'fields' => $fields,
      'classes' => $classes,
      'data_tags' => $data_tags,
    ])
    @endwhile
@endif
