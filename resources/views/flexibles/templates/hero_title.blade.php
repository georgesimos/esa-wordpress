@if( ! empty( $fields['title'] ) && ! empty( $fields['sub_title'] ) )
  <section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}">
    <div class="row">
      <span class="background-text os-transform" data-transformX="-20%">
        {!! $fields['sub_title'] !!}
      </span>

      <h1>{!! $fields['title'] !!}</h1>
    </div>
  </section>
@endif
