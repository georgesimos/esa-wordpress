@if( have_rows('solution') )
  @while( have_rows('solution') ) @php the_row() @endphp

  @php
    $fields = [
      'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( 'solution' . '-' ),
      'title' => get_sub_field( 'title' ),
      'sub_title' => get_sub_field( 'sub_title' ),
      'content' => get_sub_field( 'content' ),
      'main_logo_title' => get_sub_field( 'main_logo_title' ),
      'main_logo' => get_sub_field( 'main_logo' ),
      'logos' => get_sub_field( 'logos' ),
    ];

    $classes = [
      'layout-item',
      'solution',
    ];
  @endphp

  @include( 'flexibles.templates.solution',  [
    'fields' => $fields,
    'classes' => $classes,
  ])
  @endwhile
@endif
