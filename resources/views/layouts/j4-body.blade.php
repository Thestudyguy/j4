@extends('dental-front-face-index')

@section('content')
    <div class="body-container">
        <div id="home">@include('layouts.intro-banner')</div>
        <div id="j4-story">@include('layouts.story')</div>
        <div id="j4-doctors">@include('layouts.doctors')</div>
        <div id="why-choose-us">@include('layouts.why-choose-j4dc')</div>
        <div id="services">@include('layouts.services')</div>
        {{-- <div id="footer"></div> --}}
    </div>
@endsection
