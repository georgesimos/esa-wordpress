<section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}">
  <div class="row">
    <div class="text-wrapper-top elements-in">
      @if( ! empty( $fields['title'] ) )
        <h2>{!! $fields['title'] !!}</h2>
      @endif

      @if( ! empty( $fields['lead'] ) )
        <h3>{!! $fields['lead'] !!}</h3>
      @endif

      @if( ! empty( $fields['content'] ) )
        <div class="text">
          {!! $fields['content'] !!}
        </div>
      @endif
    </div>
  </div>

  @if( ! empty( $fields['image'] ) )
    <img class="os-opacity os-transform" data-opacity="1" data-transformY="-25%"  src="{{ $fields['image']['url'] }}" alt="" />
  @endif

  <div class="text-wrapper-bottom elements-in">
    @if( ! empty( $fields['title_bottom'] ) )
      <h2>{!! $fields['title_bottom'] !!}</h2>
    @endif

    @if( ! empty( $fields['lead_bottom'] ) )
      <h3>{!! $fields['lead_bottom'] !!}</h3>
    @endif

    @if( ! empty( $fields['content_bottom'] ) )
      <div class="text-bottom">
        {!! $fields['content_bottom'] !!}
      </div>
    @endif
  </div>
</section>
