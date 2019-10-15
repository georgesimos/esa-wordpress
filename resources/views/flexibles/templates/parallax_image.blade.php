@if( ! empty( $fields['image'] ) )
  <section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}">
    <div class="image-wrapper os-transform" data-transformY="-20%" style="background-image: url('{{ $fields['image']['url'] }}');"></div>

    @if( ! empty( $fields['title'] ) )
    <div class="row">
      <h2>{!! $fields['title'] !!}</h2>
    </div>
    @endif
  </section>
@endif
