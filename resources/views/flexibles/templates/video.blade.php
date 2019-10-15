@if( ! empty( $fields['video_type'] ) )
  <section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}">
    <div class="video-overlay">
      <span class="play-text">{{ $fields['play_text'] }}</span>
      <div class="image-wrapper os-transform" data-transformY="-20%" style="background-image: url('{{ $fields['background_image']['url'] }}');"></div>
    </div>
    <video>
      <source src="{{ $fields['video_url'] }}" type="{{ $fields['video_type'] }}">
    </video>
  </section>
@endif
