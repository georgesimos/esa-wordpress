<section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}">
  @if( 'left' === $fields['image_position'] )
    <div class="image-wrapper bw">
      @if( ! empty( $fields['image'] ) )
       {!! \App\get_responsive_attachment( $fields['image']['id'], 'esa-thumbnail-lg' ) !!}
      @endif
    </div>
  @endif

  <div class="text-wrapper">
    <div class="text-inner-wrapper">
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

  @if( 'right' === $fields['image_position'] )
    <div class="image-wrapper bw">
      @if( ! empty( $fields['image'] ) )
        {!! \App\get_responsive_attachment( $fields['image']['id'], 'esa-thumbnail-lg' ) !!}
      @endif
    </div>
  @endif
</section>
