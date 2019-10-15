@if( have_rows('hero_cta') )
  @while( have_rows('hero_cta') ) @php the_row() @endphp

  @php
    $fields = [
      'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( 'hero_cta' . '-' ),
      'title' => get_sub_field( 'title' ),
      'sub_title' => get_sub_field( 'sub_title' ),
      'link' => get_sub_field( 'link' ),
    ];

    $classes = [
      'layout-item',
      'hero_cta',
    ];
  @endphp

  @include( 'flexibles.templates.hero_cta',  [
    'fields' => $fields,
    'classes' => $classes,
  ])
  @endwhile
@endif
