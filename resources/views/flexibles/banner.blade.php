@if( have_rows('banner') )
  @while( have_rows('banner') ) @php the_row() @endphp

  @php
    $fields = [
      'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( 'banner' . '-' ),
      'title' => get_sub_field( 'title' ),
      'image' => get_sub_field( 'image' ),
      'full_screen' => get_sub_field( 'full_screen' ) ? get_sub_field( 'full_screen' ) : 'enabled',
      'text_align' => get_sub_field( 'text_align' ) ? get_sub_field( 'text_align' ) : 'left',
      'hero_settings' => get_sub_field( 'banner_hero_settings' ),
    ];

    $has_threed = ( '3d' === $fields['hero_settings']['background_type'] || 'color' === $fields['hero_settings']['background_type'] );
    $threed = $has_threed && ! empty ( $fields['hero_settings']['3d_settings'] ) ? "data-3d='" . json_encode( $fields['hero_settings']['3d_settings'] ) . "'" : '';
    $bg_color = 'white' === $fields['hero_settings']['bg_type'] ? 'white' : 'dark';

    $classes = [
      'layout-item',
      'banner-layout',
      'section-bg-' . $bg_color,
      'text-align-' . $fields['text_align'],
      'full-screen-' . $fields['full_screen'],
    ];

    if ( $has_threed ) {
      $classes[] = 'has-threed';
    }
  @endphp

  @include( 'flexibles.templates.banner',  [
    'fields' => $fields,
    'classes' => $classes,
    'threed' => $threed,
    'has_threed' => $has_threed,
  ])
  @endwhile
@endif
