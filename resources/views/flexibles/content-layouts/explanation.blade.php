@if( have_rows('explanation') )
  @while( have_rows('explanation') ) @php the_row() @endphp
  @php
    $fields = [
      'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( 'explanation-' ),
      'hero_title' => get_sub_field( 'hero_title' ),
      'title' => get_sub_field( 'title' ),
      'lead' => get_sub_field( 'lead' ),
      'content' => get_sub_field( 'content' ),
    ];

    $classes = [
      'content-layout-item',
      'explanation',
      'elements-in'
    ];
  @endphp

  @if( ! empty( $fields['hero_title'] ) || ! empty( $fields['title'] ) || ! empty( $fields['lead'] ) || ! empty( $fields['content'] ) )
    <section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}">
      <div class="row">
        <div class="text-column">
          @if( ! empty( $fields['hero_title'] ) )
            <h2>{!! $fields['hero_title'] !!}</h2>
          @endif
        </div>
        <div class="text-column">
          @if( ! empty( $fields['title'] ) )
            <h3>{!! $fields['title'] !!}</h3>
          @endif

          @if( ! empty( $fields['lead'] ) )
              <h4>{!! $fields['lead'] !!}</h4>
          @endif

          @if( ! empty( $fields['content'] ) )
            <div class="entry-content">
              {!! $fields['content'] !!}
            </div>
          @endif
        </div>
      </div>
    </section>
  @endif
  @endwhile
@endif
