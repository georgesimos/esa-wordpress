@php $footer_style = get_field( 'footer_style', wpc_get_the_id() ) ? get_field(
'footer_style', wpc_get_the_id() ) : 'white'; @endphp
<footer class="{{ $footer_style }}">
<!--   <div class="menu-trigger">
    <div></div>
    <div></div>
    <div></div>
  </div> -->

  <a class="logo" href="{{ home_url('/') }}" title="{{ get_bloginfo('name', 'display') }}">
    {!! wpc_get_the_logo_html(); !!}
  </a>
	
 <p>
  @if( ! empty ( $footer_contact = get_field( 'esa_footer_contact', 'option' ) ) && ! empty ( $footer_policy = get_field( 'esa_footer_policy', 'option' ) ))
    @if( ! empty( $footer_policy['first_policy_text'] ) )
    <a href="{{ $footer_policy["first_policy_link"] }}" style="margin-right: 10px">
      {{$footer_policy['first_policy_text']}}
    </a>
    @endif @if( ! empty( $footer_policy['second_policy_text'] ) )
    <a href="{{ $footer_policy["second_policy_link"] }}" style="margin-right: 10px">
      {{$footer_policy['second_policy_text']}}
    </a>
    @endif @if( ! empty( $footer_contact['name'] ) )
    <strong>{{ $footer_contact["name"] }}</strong><br />
    @endif @if( ! empty( $footer_contact['email'] ) )
    <a href="mailto:{{ $footer_contact['email'] }}">{{
      $footer_contact["email"]
    }}</a><br />
    @endif @if( ! empty( $footer_contact['phone'] ) )
    <a href="tel:{{ $footer_contact['phone'] }}">{{
      $footer_contact["phone"]
    }}</a>
    @endif
  @endif
	 <a class="linkedIn" href="https://www.linkedin.com/company/earth-science-analytics/" title="Earth Science Analytics linkedIn" target="_blank">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 310 310" style="enable-background:new 0 0 310 310;" xml:space="preserve">
<g id="XMLID_801_">
	<path id="XMLID_802_" d="M72.16,99.73H9.927c-2.762,0-5,2.239-5,5v199.928c0,2.762,2.238,5,5,5H72.16c2.762,0,5-2.238,5-5V104.73
		C77.16,101.969,74.922,99.73,72.16,99.73z"/>
	<path id="XMLID_803_" d="M41.066,0.341C18.422,0.341,0,18.743,0,41.362C0,63.991,18.422,82.4,41.066,82.4
		c22.626,0,41.033-18.41,41.033-41.038C82.1,18.743,63.692,0.341,41.066,0.341z"/>
	<path id="XMLID_804_" d="M230.454,94.761c-24.995,0-43.472,10.745-54.679,22.954V104.73c0-2.761-2.238-5-5-5h-59.599
		c-2.762,0-5,2.239-5,5v199.928c0,2.762,2.238,5,5,5h62.097c2.762,0,5-2.238,5-5v-98.918c0-33.333,9.054-46.319,32.29-46.319
		c25.306,0,27.317,20.818,27.317,48.034v97.204c0,2.762,2.238,5,5,5H305c2.762,0,5-2.238,5-5V194.995
		C310,145.43,300.549,94.761,230.454,94.761z"/>
</g>
</svg>

	  </a>
	  <a class="twitter" href="https://twitter.com/earth_analytics" title="Earth Science Analytics Twitter" target="_blank">
		<svg viewBox="0 -47 512.00203 512" xmlns="http://www.w3.org/2000/svg"><path d="m191.011719 419.042969c-22.140625 0-44.929688-1.792969-67.855469-5.386719-40.378906-6.335938-81.253906-27.457031-92.820312-33.78125l-30.335938-16.585938 32.84375-10.800781c35.902344-11.804687 57.742188-19.128906 84.777344-30.597656-27.070313-13.109375-47.933594-36.691406-57.976563-67.175781l-7.640625-23.195313 6.265625.957031c-5.941406-5.988281-10.632812-12.066406-14.269531-17.59375-12.933594-19.644531-19.78125-43.648437-18.324219-64.21875l1.4375-20.246093 12.121094 4.695312c-5.113281-9.65625-8.808594-19.96875-10.980469-30.777343-5.292968-26.359376-.863281-54.363282 12.476563-78.851563l10.558593-19.382813 14.121094 16.960938c44.660156 53.648438 101.226563 85.472656 168.363282 94.789062-2.742188-18.902343-.6875-37.144531 6.113281-53.496093 7.917969-19.039063 22.003906-35.183594 40.722656-46.691407 20.789063-12.777343 46-18.96875 70.988281-17.433593 26.511719 1.628906 50.582032 11.5625 69.699219 28.746093 9.335937-2.425781 16.214844-5.015624 25.511719-8.515624 5.59375-2.105469 11.9375-4.496094 19.875-7.230469l29.25-10.078125-19.074219 54.476562c1.257813-.105468 2.554687-.195312 3.910156-.253906l31.234375-1.414062-18.460937 25.230468c-1.058594 1.445313-1.328125 1.855469-1.703125 2.421875-1.488282 2.242188-3.339844 5.03125-28.679688 38.867188-6.34375 8.472656-9.511718 19.507812-8.921875 31.078125 2.246094 43.96875-3.148437 83.75-16.042969 118.234375-12.195312 32.625-31.09375 60.617187-56.164062 83.199219-31.023438 27.9375-70.582031 47.066406-117.582031 56.847656-23.054688 4.796875-47.8125 7.203125-73.4375 7.203125zm0 0"/></svg>
	  </a>
	</p>

</footer>