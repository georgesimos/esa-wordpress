@if( have_rows('lead') )
  @while( have_rows('lead') ) @php the_row() @endphp
  @php
    $fields = [
      'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( 'lead-' ),
      'lead' => get_sub_field( 'lead' ),
    ];

    $classes = [
      'content-layout-item',
      'lead',
    ];
  @endphp

  @if( ! empty( $fields['lead'] ) )
    <section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}">
      <div class="row">
        @if( ! empty( $fields['lead'] ) )
          <div class="lead-text">
            {!! $fields['lead'] !!}
          </div>
        @endif
      </div>
    </section>
  @endif
  @endwhile
@endif

