{{--
  Template Name: Full Page
--}}

@extends('layouts.full-page')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-full-page')
  @endwhile
@endsection
