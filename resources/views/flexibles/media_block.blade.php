@if( have_rows('media_block') )
  @while( have_rows('media_block') ) @php the_row() @endphp

  @php
    $fields = [
      'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( 'media_block' . '-' ),
      'title' => get_sub_field( 'title' ),
      'lead' => get_sub_field( 'lead' ),
      'content' => get_sub_field( 'content' ),
      'title_bottom' => get_sub_field( 'title_bottom' ),
      'lead_bottom' => get_sub_field( 'lead_bottom' ),
      'content_bottom' => get_sub_field( 'content_bottom' ),
      'image' => get_sub_field( 'image' ),
      'layout_style' => get_sub_field( 'layout_style' ) ? get_sub_field( 'layout_style' ) : 'column',
      'image_position' => get_sub_field( 'image_position' ) ? get_sub_field( 'image_position' ) : 'left',
    ];

    $classes = [
      'layout-item',
      'media_block_' . $fields['layout_style'],
      'image-position-' . $fields['image_position'],
    ];

    if ( 'column' === $fields['layout_style'] ) {
      $classes[] = 'elements-in';
    }
  @endphp

  @include( 'flexibles.templates.media_block_' . $fields['layout_style'],  [
    'fields' => $fields,
    'classes' => $classes,
  ])
  @endwhile
@endif
