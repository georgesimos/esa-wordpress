<article @php post_class() @endphp>
  @if( have_rows( get_post_type() . '_content_layouts' ) )
    @while( have_rows( get_post_type() . '_content_layouts', wpc_get_the_id() ) ) @php( the_row() )
      @include( 'flexibles.' . get_row_layout() )
    @endwhile
  @endif
</article>
