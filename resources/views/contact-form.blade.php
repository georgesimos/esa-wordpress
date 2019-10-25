{{--
  Template Name: Contact Form
--}}

@extends('layouts.app')

<div class="section-bg-wrapper page-bg white">
  <div class="section-bg"></div>
</div>

@section('content')
@while(have_posts()) @php the_post() @endphp
  @php the_content() @endphp
  @include('partials.content-page')
  <section class="layout-item content_layouts">
    <div class=row>
      {!! gravity_form('Contact Us', false, false, false, '', false) !!}
    </div>
  </section>
@endwhile
@endsection