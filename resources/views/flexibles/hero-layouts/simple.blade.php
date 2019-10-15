@if( have_rows('hero_simple') )
  @while( have_rows('hero_simple') ) @php the_row() @endphp

  @php
    $fields = [
      'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( 'banner' . '-' ),
      'title' => get_sub_field( 'title' ),
      'sub_title' => get_sub_field( 'sub_title' ),
      'content' => get_sub_field( 'content' ),
      'page_link' => get_sub_field( 'page_link' ),
      'hero_settings' => get_sub_field( 'simple_hero_settings' ),
    ];

    $threed = 'image' !== $fields['hero_settings']['background_type'] && ! empty ( $fields['hero_settings']['3d_settings'] ) ? "data-3d='" . json_encode( $fields['hero_settings']['3d_settings'] ) . "'" : '';
    $bg_color = 'white' === $fields['hero_settings']['bg_type'] ? 'white' : 'dark';

    $classes = [
      'hero-layout',
      'hero_simple',
      'section-bg-' . $bg_color,
    ];
  @endphp

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

    <div class="content row">
      @if( ! empty( $fields['title'] ) )
        <h1>{!! $fields['title'] !!}</h1>
      @endif

      @if( ! empty( $fields['sub_title'] ) )
        <h2>{!! $fields['sub_title'] !!}</h2>
      @endif

      @if( ! empty( $fields['content'] ) )
        <div class="entry-content">{!! $fields['content'] !!}</div>
      @endif

      @if( ! empty( $fields['page_link'] ) )
        @php $target = empty( $fields['page_link']['target'] ) ? '' : ' target="' . $fields['page_link']['target'] . '" rel="nofollow"' @endphp
        <a class="find-out-link" href="{{ $fields['page_link']['url'] }}" title="{{ $fields['page_link']['title'] }}"{!! $target !!}>
          <span>{{ $fields['page_link']['title'] }}</span>
        </a>
      @endif
    </div>
  </section>
  @endwhile
@endif
