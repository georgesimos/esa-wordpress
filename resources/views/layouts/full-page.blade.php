<!doctype html>
<html @php(language_attributes())>
@include('partials.head')
  <body @php(body_class())>
    @include('partials.header')
    @include('partials/mountains')

    <div class="scroll-down-wrapper">
      <div class="scroll-down-notice">
        <span>{!! __( '<strong>Scroll</strong> Down', 'esa' ) !!}</span>
      </div>
    </div>

    <div class="wrap" role="document">
      @yield('content')
    </div>

    @php(do_action('get_footer'))

    @include('partials.footer')

    @php(do_action('get_footer_after'))
    
    @php(wp_footer())
  </body>
</html>
