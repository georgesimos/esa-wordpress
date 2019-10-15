@if( have_rows('parallax_image') )
  @while( have_rows('parallax_image') ) @php the_row() @endphp
  @php
    $fields = [
      'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( 'parallax_image-' ),
      'title' => get_sub_field( 'title' ),
      'image' => get_sub_field( 'image' ),
      'text_style' => get_sub_field( 'text_style' ) ? get_sub_field( 'text_style' ) : 'dark',
    ];

    $classes = [
      'content-layout-item',
      'parallax_image',
      'text-style-' . $fields['text_style'],
    ];
  @endphp

  @include( 'flexibles.templates.parallax_image',  [
    'fields' => $fields,
    'classes' => $classes,
  ])
  @endwhile
@endif


