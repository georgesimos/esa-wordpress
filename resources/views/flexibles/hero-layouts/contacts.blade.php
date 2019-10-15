@if( have_rows('hero_contacts') )
  @while( have_rows('hero_contacts') ) @php the_row() @endphp

  @php
    $fields = [
      'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( 'banner' . '-' ),
      'title' => get_sub_field( 'title' ),
      'sub_title' => get_sub_field( 'sub_title' ),
      'featured_contacts' => get_sub_field( 'featured_contacts' ),
      'contacts_title' => get_sub_field( 'contacts_title' ),
      'contacts' => get_sub_field( 'contacts' ),
    ];

    $classes = [
      'hero-layout',
      'contacts-section',
      'hero_contacts',
    ];
  @endphp

  <section class="{{ implode( ' ', $classes ) }}" data-slidename="{{ $fields['layout_id'] }}">
    <div class="slide">
      <div class="section-bg-wrapper">
        <div class="section-bg"></div>
      </div>

      <div class="content row">
        @if( ! empty( $fields['title'] ) )
          <h1>{!! $fields['title'] !!}</h1>
        @endif

        @if( ! empty( $fields['sub_title'] ) )
          <h2>{!! $fields['sub_title'] !!}</h2>
        @endif

        @if( ! empty( $fields['featured_contacts'] ) )
          <div class="contacts-info">
            @foreach( $fields['featured_contacts'] as $contact )

              @if( ! empty( $contact['name'] ) )
                <strong>{{ $contact['name'] }}</strong><br>
              @endif

              @if( ! empty( $contact['email'] ) )
                <a href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a><br>
              @endif

              @if( ! empty( $contact['phone'] ) )
                <a href="tel:{{ $contact['phone'] }}">{{ $contact['phone'] }}</a><br><br>
              @endif
            @endforeach
          </div>
        @endif
      </div>

      <div class="slide-link" data-goto="front">
        <span>{{ __( 'Drag to contact us', 'esa' ) }}</span>
      </div>
    </div>

    <div class="slide slide-2 contacts-slide-2" data-bg-color="white">

      <div class="slide-link" data-goto="back"></div>

      <div class="section-bg-wrapper white">
        <div class="section-bg"></div>
      </div>

      <div class="content row">

        @if( ! empty( $fields['contacts_title'] ) )
          <h2>{!! $fields['contacts_title'] !!}</h2>
        @endif

        @if( ! empty( $fields['contacts'] ) )
        <div class="contacts-info row">
          @foreach( $fields['contacts'] as $contact )
            <div class="small-12 medium-4 column">
              @if( ! empty( $contact['name'] ) )
                <strong>{{ $contact['name'] }}</strong><br>
              @endif

              @if( ! empty( $contact['email'] ) )
                <a href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a><br>
              @endif

              @if( ! empty( $contact['phone'] ) )
                <a href="tel:{{ $contact['phone'] }}">{{ $contact['phone'] }}</a><br><br>
              @endif
            </div>
          @endforeach
        </div>
        @endif
      </div>
    </div>
  </section>
  @endwhile
@endif
