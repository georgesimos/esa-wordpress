@if( have_rows('featured_post') )
  @while( have_rows('featured_post') ) @php the_row() @endphp

  @php
    $fields = [
      'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( 'featured_post' . '-' ),
      'post' => get_sub_field( 'post' ),
      'background' => get_sub_field( 'background' ) ? get_sub_field( 'background' ) : 'white',
    ];

    $classes = [
      'layout-item',
      'featured_post',
      'elements-in',
      'background-' . $fields['background'],
    ];
  @endphp

  @include( 'flexibles.templates.featured_post',  [
    'fields' => $fields,
    'classes' => $classes,
  ])
  @endwhile
@endif
