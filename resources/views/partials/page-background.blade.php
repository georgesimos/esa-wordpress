@if( ! empty( $background_type = get_field( 'background_type' ) ) && 'dynamic' === $background_type )
  @php $background_style = get_field( 'background_style' ) ? get_field( 'background_style' ) : 'dark' @endphp
  <div class="section-bg-wrapper page-bg {{ $background_style }}">
    <div class="section-bg"></div>
  </div>
@endif
