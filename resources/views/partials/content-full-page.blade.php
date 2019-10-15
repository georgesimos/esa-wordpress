@if( have_rows( 'full_page_hero_layouts', wpc_get_the_id() ) )
  @while( have_rows( 'full_page_hero_layouts', wpc_get_the_id() ) ) @php( the_row() )
    @include( 'flexibles.hero-layouts.' . get_row_layout() )
  @endwhile
@endif
