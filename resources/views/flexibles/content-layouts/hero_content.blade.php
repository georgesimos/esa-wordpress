@if( have_rows('hero_content') )
  @while( have_rows('hero_content') ) @php the_row() @endphp
  @php
    $fields = [
      'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( 'hero_content-' ),
      'title' => get_sub_field( 'title' ),
      'content' => get_sub_field( 'content' ),
      'image' => get_sub_field( 'image' ),
    ];

    $classes = [
      'content-layout-item',
      'hero_content'
    ];
  @endphp

  @if( ! empty( $fields['title'] ) || ! empty( $fields['content'] ) || ! empty( $fields['image'] ) )
    <section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}">
      <div class="row elements-in">
        <div class="left">
          @if( ! empty( $fields['title'] ) )
            <h2>
              {!! $fields['title'] !!}
            </h2>
          @endif

          @if( ! empty( $fields['content'] ) )
            <p>
              {!! $fields['content'] !!}
            </p>
          @endif
        </div>
        <div class="right">
          @if( ! empty( $fields['image'] ) )
            {!! \App\get_responsive_attachment( $fields['image']['id'], 'esa-thumbnail-lg' ) !!}
          @endif
        </div>
      </div>
    </section>
  @endif
  @endwhile
@endif
