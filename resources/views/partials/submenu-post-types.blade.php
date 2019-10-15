<ul class="submenu">
  @foreach( $menu_items as $menu_item )
    <li>
      <a href="{{ get_the_permalink( $menu_item->ID ) }}" title="{{ get_the_title( $menu_item->ID ) }}">
        {{ get_the_title( $menu_item->ID ) }}
      </a>
    </li>
  @endforeach
</ul>
