@if( have_rows('hero_title') )
  @while( have_rows('hero_title') ) @php the_row() @endphp

  @php
    $fields = [
      'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( 'hero_title' . '-' ),
      'title' => get_sub_field( 'title' ),
      'sub_title' => get_sub_field( 'sub_title' ),
    ];

    $classes = [
      'layout-item',
      'hero_title',
    ];
  @endphp

  @include( 'flexibles.templates.hero_title',  [
    'fields' => $fields,
    'classes' => $classes,
  ])
  @endwhile
@endif
