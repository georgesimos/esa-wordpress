@extends('layouts.full-page')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-single-esa_story')
  @endwhile
@endsection
