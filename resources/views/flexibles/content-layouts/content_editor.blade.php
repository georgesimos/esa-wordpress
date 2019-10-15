@if( have_rows('editor') )
  @while( have_rows('editor') ) @php the_row() @endphp
  @php
    $fields = [
      'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( 'content_editor-' ),
      'content' => get_sub_field( 'content' ),
      'columns' => get_sub_field( 'columns' ) ? get_sub_field( 'columns' ) : 'one',
    ];

    $classes = [
      'content-layout-item',
      'content_editor',
      'content-columns-' . $fields['columns']
    ];
  @endphp

  @if( ! empty( $fields['content'] ) )
    <section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}">
      <div class="row">
        @if( ! empty( $fields['content'] ) )
          <div class="ce-content">
            {!! apply_filters( 'the_content', $fields['content'] ) !!}
          </div>
        @endif
      </div>
    </section>
  @endif
  @endwhile
@endif
