@if( have_rows( 'layout_content_layouts' ) )
  <section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}">
    @while( have_rows( 'layout_content_layouts' ) ) @php the_row() @endphp
      @include( 'flexibles.content-layouts.' . get_row_layout() )
    @endwhile

    @if( 'dynamic' === $fields['background_type'] )
      <div class="section-bg-wrapper white">
        <div class="section-bg"></div>
      </div>
    @endif
  </section>
@endif
