@if( have_rows( 'full_width_layouts' ) )
  @while( have_rows( 'full_width_layouts', wpc_get_the_id() ) ) @php( the_row() )
    @include( 'flexibles.' . get_row_layout() )
  @endwhile
@endif
