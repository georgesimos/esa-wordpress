@if( have_rows('content_layouts') )
  @while( have_rows('content_layouts') ) @php the_row() @endphp

  @php
    $fields = [
      'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( 'content_layouts' . '-' ),
      'background_type' => get_sub_field( 'background_type' ),
      'padding' => get_sub_field( 'content_layouts_padding' ),
    ];

    $classes = [
      'layout-item',
      'content_layouts',
      'pt-' . $fields['padding']['top'],
      'pb-' . $fields['padding']['bottom'],
      'bg-type-' . $fields['background_type'],
    ];
  @endphp

  @include( 'flexibles.templates.content_layouts',  [
    'fields' => $fields,
    'classes' => $classes,
  ])
  @endwhile
@endif
