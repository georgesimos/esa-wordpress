@php $footer_style = get_field( 'footer_style', wpc_get_the_id() ) ? get_field( 'footer_style', wpc_get_the_id() ) : 'white'; @endphp
<footer class="{{ $footer_style }}">
  <div class="menu-trigger">
    <div></div>
    <div></div>
    <div></div>
  </div>

  <a class="logo" href="{{ home_url( '/' ) }}" title="{{ get_bloginfo( 'name', 'display' ) }}">
    {!! wpc_get_the_logo_html(); !!}
  </a>

  @if( ! empty ( $footer_contact = get_field( 'esa_footer_contact', 'option' ) ) )
    <p>
      @if( ! empty( $footer_contact['name'] ) )
        <strong>{{ $footer_contact['name'] }}</strong><br>
      @endif

      @if( ! empty( $footer_contact['email'] ) )
        <a href="mailto:{{ $footer_contact['email'] }}">{{ $footer_contact['email'] }}</a><br>
      @endif

      @if( ! empty( $footer_contact['phone'] ) )
        <a href="tel:{{ $footer_contact['phone'] }}">{{ $footer_contact['phone'] }}</a>
      @endif
    </p>
  @endif
</footer>
