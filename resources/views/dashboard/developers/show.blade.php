@extends('dashboard.layouts.core')

@section('container')
<div class="container-fluid">
    <div class="d-flex container-fluid justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $developer->name }}'s Profile Card</h1>
    </div>

    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="our-team">
            <div class="picture">
                <img class="img-fluid person" src="{{ asset('storage/' . $developer->dev_photo) }}">
            </div>
            <div class="region-flag mb-2">
                <img
                    src="https://flagcdn.com/h20/{{ $developer->region }}.png"
                    srcset="https://flagcdn.com/h40/{{ $developer->region }}.png 2x,
                        https://flagcdn.com/h60/{{ $developer->region }}.png 3x"
                    height="20"
                    alt="{{ $developer->region }}">
            </div>
            <div class="team-content">
                <h3 class="name">{{ $developer->name }}</h3>
                <h4 class="title">{{ $developer->role }}</h4>
            </div>
            <ul class="social">
                <li><a href="{{ $developer->instagram_link }}"><i class="bi bi-instagram"></i></a></li>
                <li><a href="{{ $developer->github_link }}"><i class="bi bi-github"></i></a></li>
                <li><a href="mailto:{{ $developer->email_link }}"><i class="bi bi-envelope"></i></a></li>
            </ul>
        </div>
    </div>

</div>
@endsection