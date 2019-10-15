@if( ! empty( $fields['post'] ) )
  <section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}">
    <a href="{{ get_the_permalink( $fields['post']->ID ) }}" title="{!! get_the_title( $fields['post']->ID ) !!}">
      <div class="row">
        <div class="content">
          <h2>{!! get_the_title( $fields['post']->ID ) !!}</h2>

          <div class="entry-summary">
            {!! get_field( 'excerpt', $fields['post']->ID ) !!}
          </div>
        </div>
      </div>
      <div class="slide-link" data-goto="front">
        <span>{{ __( 'Continue Reading', 'esa' ) }}</span>
      </div>
    </a>
  </section>
@endif
