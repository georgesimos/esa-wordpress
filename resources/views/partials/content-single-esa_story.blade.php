@if( have_rows( 'esa_story_hero_layouts', wpc_get_the_id() ) )
  @while( have_rows( 'esa_story_hero_layouts', wpc_get_the_id() ) ) @php( the_row() )
    @include( 'flexibles.hero-layouts.' . get_row_layout() )
  @endwhile
@endif
