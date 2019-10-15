<!doctype html>
<html @php(language_attributes())>
  @include('partials.head')
  <body @php(body_class())>
    @php(do_action('get_header'))

    @include('partials.header')

    @php(do_action('get_header_after'))

    <div class="wrap" role="document">
      @yield('content')
    </div>

    @php(do_action('get_footer'))

    @include('partials.footer')

    @php(do_action('get_footer_after'))

    @php(wp_footer())
  </body>
</html>
