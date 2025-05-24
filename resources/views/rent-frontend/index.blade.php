<!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
@extends('rent-frontend.frontend-dashboard')

@section('frontent_content')

<!-- banner -->
@include('rent-frontend.home.banner')
<!-- banner -->

<!-- what you -->
@include('rent-frontend.home.what-you')
<!-- what uou -->

<!-- properties -->
@include('rent-frontend.home.category')
<!-- properties -->

<!-- rewards -->
@include('rent-frontend.home.reward')
<!-- rewards -->

<!-- passport -->
@include('rent-frontend.home.passport')
<!-- passport -->

<!-- rent -->
@include('rent-frontend.home.demo')
<!-- rent -->

<!-- blogs -->
@include('rent-frontend.home.blog')
<!-- blogs -->

<!-- news -->
@include('rent-frontend.home.media-news')
<!-- news -->

<!-- our clients -->
@include('rent-frontend.home.client')
<!-- our clients -->
@endsection
