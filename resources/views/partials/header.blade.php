@php $header_style = get_field( 'header_style', wpc_get_the_id() ) ? get_field( 'header_style', wpc_get_the_id() ) : 'white'; @endphp
<nav class="{{ $header_style }}">
  <div class="menu-trigger">
    <div></div>
    <div></div>
    <div></div>
  </div>

  <a class="logo" href="{{ home_url( '/' ) }}" title="{{ get_bloginfo( 'name', 'display' ) }}">
    {!! wpc_get_the_logo_html(); !!}
  </a>


  @if( ! empty( $request_demo = get_field( 'esa_request_a_demo', 'option' ) ) )
    @php $target = empty( $request_demo['target'] ) ? '' : ' target="' . $request_demo['target'] . '" rel="nofollow"' @endphp
    <a class="request-a-demo-link" href="{{ $request_demo['url'] }}" title="{{ $request_demo['title'] }}"{!! $target !!}>
      {{ $request_demo['title'] }}
    </a>
  @endif
</nav>

<div class="menu-wrapper">
  <div class="background"></div>
  <div class="menu-links-wrapper row">
    @if (has_nav_menu('primary_navigation'))
      {!! wp_nav_menu( [
        'theme_location' => 'primary_navigation',
        'menu_class' => 'nav',
        'walker' => new \App\ESA\Nav\ESA_Navwalker()
      ] ) !!}
    @endif
  </div>
</div>
