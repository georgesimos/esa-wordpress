@extends('layouts.app')

@section('content')
  @if (!have_posts())
    <div class="alert alert-warning">
      {{ __('Sorry, but the page you were trying to view does not exist.', 'esa') }}
    </div>
    {!! get_search_form(false) !!}
  @endif
@endsection
