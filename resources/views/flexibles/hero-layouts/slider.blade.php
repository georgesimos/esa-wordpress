@if( have_rows('hero_slider') )
  @while( have_rows('hero_slider') ) @php the_row() @endphp

  @php
    $fields = [
      'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( 'hero_slider' . '-' ),
      'slides' => get_sub_field( 'slides' ),
      'first_slide_link' => get_sub_field( 'first_slide_link' ),
      'last_slide_link' => get_sub_field( 'last_slide_link' ),
      'hero_settings' => get_sub_field( 'hero_slider_hero_settings' ),
    ];

    $index = 1;
    $threed = 'image' !== $fields['hero_settings']['background_type'] && ! empty ( $fields['hero_settings']['3d_settings'] ) ? "data-3d='" . json_encode( $fields['hero_settings']['3d_settings'] ) . "'" : '';
    $bg_color = 'white' === $fields['hero_settings']['bg_type'] ? 'white' : 'dark';

    $classes = [
      'hero-layout',
      'hero_slider',
      'section-bg-' . $bg_color,
    ];
  @endphp

  @if( ! empty( $fields['slides'] ) )
  <section class="{{ implode( ' ', $classes ) }}" data-slidename="{{ $fields['layout_id'] }}" {!! $threed !!} data-bg-color="{{ $bg_color }}">
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
    @endif

    @if( 'color' === $fields['hero_settings']['background_type'] && ! empty( $fields['hero_settings']['background_color'] ) )
      <div class="coloured-bg" style="background-color: {{ $fields['hero_settings']['background_color'] }}"></div>
    @endif

    @foreach( $fields['slides'] as $slide )
      <div class="slide" data-bg-color="{{ $bg_color }}">
        <div class="content row">
          @if( ! empty( $slide['title'] ) )
            <h1>{!! $slide['title'] !!}</h1>
          @endif

          @if( ! empty( $slide['sub_title'] ) )
            <h2>{!! $slide['sub_title'] !!}</h2>
          @endif

          @if( ! empty( $slide['content'] ) )
            <div class="entry-content">{!! $slide['content'] !!}</div>
          @endif

          @if( ! empty( $slide['page_link'] ) )
            @php $target = empty( $slide['page_link']['target'] ) ? '' : ' target="' . $slide['page_link']['target'] . '" rel="nofollow"' @endphp
            <a class="find-out-link" href="{{ $slide['page_link']['url'] }}" title="{{ $slide['page_link']['title'] }}"{!! $target !!}>
              <span>{{ $slide['page_link']['title'] }}</span>
            </a>
          @endif
        </div>

        @if( 1 === $index && ! empty( $fields['first_slide_link'] ) )
          @php $target = empty( $fields['first_slide_link']['target'] ) ? '' : ' target="' . $fields['first_slide_link']['target'] . '" rel="nofollow"' @endphp
          <a class="slide-link" href="{{ $fields['first_slide_link']['url'] }}" title="{{ $fields['first_slide_link']['title'] }}"{!! $target !!} data-goto="back"></a>
        @else
          <div class="slide-link" data-goto="back"></div>
        @endif

        @if( sizeof( $fields['slides'] ) === $index && ! empty( $fields['last_slide_link'] ) )
          @php $target = empty( $fields['last_slide_link']['target'] ) ? '' : ' target="' . $fields['last_slide_link']['target'] . '" rel="nofollow"' @endphp
          <a class="slide-link" href="{{ $fields['last_slide_link']['url'] }}" title="{{ $fields['last_slide_link']['title'] }}"{!! $target !!} data-goto="front"></a>
        @else
          <div class="slide-link" data-goto="front"></div>
        @endif
      </div>
      @php $index += 1; @endphp
    @endforeach
  </section>
  @endif
  @endwhile
@endif
