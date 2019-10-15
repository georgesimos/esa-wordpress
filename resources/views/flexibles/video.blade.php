@if( have_rows('video') )
  @while( have_rows('video') ) @php the_row() @endphp


  @php
    $source_type = get_sub_field( 'source_type' ) ? get_sub_field( 'source_type' ) : 'link';

    $fields = [
      'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( 'video' . '-' ),
      'source_type' => $source_type,
      'video_url' => get_sub_field( 'video_' . $source_type ),
      'video_type' => null,
      'play_text' => get_sub_field( 'play_text' ) ? get_sub_field( 'play_text' ) : __( 'Play', 'esa' ),
      'background_image' => get_sub_field( 'background_image' ),
    ];

    if ( ! empty( $fields[ 'video_url' ] ) ) {
      $video_path = parse_url( $fields['video_url'], PHP_URL_PATH );
    }

    if ( ! empty( $video_path ) ) {
      $video_file = pathinfo( $video_path, PATHINFO_BASENAME );
    }

    if ( ! empty( $video_file ) ) {
      $video_info = wp_check_filetype( $video_file );
    }

    if ( ! empty( $video_info ) ) {
      $allowed_exts = [ 'mp4', 'mov' ];

      if ( in_array( $video_info['ext'], $allowed_exts ) ) {
        $fields['video_type'] = $video_info['type'];
      }
    }

    $classes = [
      'layout-item',
      'video-layout',
    ];
  @endphp

  @include( 'flexibles.templates.video',  [
    'fields' => $fields,
    'classes' => $classes,
  ])
  @endwhile
@endif
