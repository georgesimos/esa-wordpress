@if( have_rows('media_block') )
  @while( have_rows('media_block') ) @php the_row() @endphp
  @php
    $fields = [
      'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( 'media_block-' ),
      'content' => get_sub_field( 'content' ),
      'image' => get_sub_field( 'image' ),
      'text_position' => get_sub_field( 'text_position' ) ? get_sub_field( 'text_position' ) : 'left',
    ];

    $classes = [
      'content-layout-item',
      'media_block',
      'text-position-' . $fields['text_position'],
    ];
  @endphp

  @if( ! empty( $fields['content'] ) && ! empty( $fields['image'] ) )
    <section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}">
      <div class="row">
        <div class="medium-12 large-6 column">
          {!! $fields['content'] !!}
        </div>
        <div class="medium-12 large-6 column">
          {!! \App\get_responsive_attachment( $fields['image']['id'], 'esa-thumbnail-lg' ) !!}
        </div>
      </div>
    </section>
  @endif
  @endwhile
@endif
