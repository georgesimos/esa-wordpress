@if( have_rows('entry_title') )
  @while( have_rows('entry_title') ) @php the_row() @endphp
  @php
    $fields = [
      'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( 'entry_title-' ),
      'title' => get_sub_field( 'title' ),
    ];

    $classes = [
      'content-layout-item',
      'entry_title',
    ];
  @endphp

  @if( ! empty( $fields['title'] ) )
    <section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}">
      <div class="row">
        @if( ! empty( $fields['title'] ) )
          <h1>
            {!! $fields['title'] !!}
          </h1>
        @endif
      </div>
    </section>
  @endif
  @endwhile
@endif

