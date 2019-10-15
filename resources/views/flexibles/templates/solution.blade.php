<section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}">
  <div class="row">
    <div class="text-wrapper elements-in">
      @if( ! empty( $fields['title'] ) )
        <h2>{!! $fields['title'] !!}</h2>
      @endif

      @if( ! empty( $fields['sub_title'] ) )
        <h3>{!! $fields['sub_title'] !!}</h3>
      @endif

      @if( ! empty( $fields['content'] ) )
        <div class="entry-content">{!! $fields['content'] !!}</div>
      @endif
    </div>
    <div class="logos elements-in">
      <div class="row">
        <div class="logo-container">
          @if( ! empty( $fields['main_logo_title'] ) )
            <h3>{!! $fields['main_logo_title'] !!}</h3>
          @endif

          @if( ! empty( $fields['main_logo'] ) )
            {!! \App\get_responsive_attachment( $fields['main_logo']['id'], 'esa-thumbnail-lg' ) !!}
          @endif
        </div>
      </div>

      @if( ! empty( $fields['logos'] ) )
        <div class="row">
          @foreach( $fields['logos'] as $logo )
            <div class="logo-container">
              @if( ! empty( $logo['title'] ) )
                <h3>{!! $logo['title'] !!}</h3>
              @endif

              @if( ! empty( $logo['logo'] ) )
                {!! \App\get_responsive_attachment( $logo['logo']['id'], 'esa-thumbnail-lg' ) !!}
              @endif
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </div>
</section>
