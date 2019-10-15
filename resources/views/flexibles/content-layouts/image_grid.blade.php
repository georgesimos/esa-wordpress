@if( have_rows('image_grid') )
  @while( have_rows('image_grid') ) @php the_row() @endphp
  @php
    $fields = [
      'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( 'image_grid-' ),
      'images_per_row' => get_sub_field( 'images_per_row' ) ? get_sub_field( 'images_per_row' ) : 'one',
    ];

    $sizes = [
      'one'   => 'nacas-thumbnail-lg',
      'two'   => 'nacas-thumbnail',
      'three' => 'nacas-thumbnail-sm',
    ];

    $classes = [
      'content-layout-item',
      'image_grid',
      'image-grid-' . $fields['images_per_row']
    ];
  @endphp

  @if( have_rows( 'image_grid_' . $fields['images_per_row'] ) )
    <section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}">
      <div class="row">
        @while ( have_rows( 'image_grid_' . $fields['images_per_row'] ) ) @php( the_row() )
        @if ( ! empty( $img = get_sub_field( 'image' ) ) )

          <figure class="image-grid-item">
            <div class="image-grid-image">
              {!! \App\get_responsive_attachment( $img['id'], $sizes[ $fields['images_per_row'] ] ) !!}
            </div>

            @if( array_key_exists( 'caption', $img ) && $img['caption'] !== '' )
              <figcaption>
                {!! $img['caption'] !!}
              </figcaption>
            @endif
          </figure>
        @endif
        @endwhile
      </div>
    </section>
  @endif
  @endwhile
@endif
