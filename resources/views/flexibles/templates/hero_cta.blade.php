@if( ! empty( $fields['title'] ) && ! empty( $fields['link'] ) )
  <section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}">
    @php $target = empty( $fields['link']['target'] ) ? '' : ' target="' . $fields['link']['target'] . '" rel="nofollow"' @endphp
    <a class="demo-section" href="{{ $fields['link']['url'] }}" title="{{ $fields['link']['title'] }}"{!! $target !!}>
      <div class="section-bg-wrapper">
        <div class="section-bg"></div>
      </div>

      @if( ! empty( $fields['sub_title'] ) )
        <span class="bg-word">{!! $fields['sub_title'] !!}</span>
      @endif

      <h3>{!! $fields['title'] !!}</h3>
    </a>
  </section>
@endif
