@if( $fields['query']->have_posts() )
  <section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}" {{ implode( ' ', $data_tags ) }}>
    @if( ! empty( $fields['title'] ) )
      <h2>{!! $fields['title'] !!}</h2>
    @endif

    <div class="posts-grid">
      @while( $fields['query']->have_posts() ) @php $fields['query']->the_post() @endphp
        <a class="grid-post elements-in" href="{{ get_the_permalink() }}" title="{{ get_the_title() }}">
          <div class="inner-wrapper">
            <h3>{{ get_the_title() }}</h3>

            <div class="entry-summary">
              {!! get_field( 'excerpt' ) !!}
            </div>

            <span class="find-out-link">
              <span>{{ __( 'Find out more', 'esa' ) }}</span>
            </span>

            <div class="section-bg-wrapper">
              <div class="section-bg"></div>
            </div>
          </div>
        </a>
      @endwhile
    </div>

    <div class="load-more-wrapper">
      <button class="btn-load-more find-out-link" type="button">
        <span>
          {{ __( 'Find out more', 'esa' ) }}
        </span>
      </button>
    </div>
  </section>
@endif
