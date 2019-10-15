@if( ! empty( $fields['title'] ) )
  <section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}"  {!! $threed !!} data-bg-color="{{ $bg_color }}">
    <div class="row elements-in">
      <h1>{!! $fields['title'] !!}</h1>

      @if( ! empty( $fields['image'] ) )
        <img width="222" src="{{ $fields['image']['url'] }}">
      @endif
    </div>

    @if( 'image' === $fields['hero_settings']['background_type'] && ! empty( $fields['hero_settings']['background_image'] ) )
      <div class="bg-wrapper">
        <div style="background-image: url('{{ $fields['hero_settings']['background_image']['url'] }}');"></div>
      </div>
    @endif

    @if( 'dynamic' === $fields['hero_settings']['background_type'] )
      @php $bg_type = 'white' === $fields['hero_settings']['bg_type'] ? ' white' : ''; @endphp
      <div class="section-bg-wrapper{{ $bg_type }}">
        <div class="section-bg"></div>
      </div>

      @if( ! empty( $fields['hero_settings']['background_image'] ) )
        <div class="background" style="background-image: url('{{ $fields['hero_settings']['background_image']['url'] }}');"></div>
      @endif
    @endif

    @if( 'color' === $fields['hero_settings']['background_type'] && ! empty( $fields['hero_settings']['background_color'] ) )
      <div class="coloured-bg" style="background-color: {{ $fields['hero_settings']['background_color'] }}"></div>
    @endif

    @if( $has_threed )
      @include( 'partials.mountains' )
    @endif
  </section>
@endif
