@extends('layouts.core')

@section('container')
    <div class="container mt-5">
        @foreach ($developers as $d)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="our-team">
                    <div class="picture">
                        <img class="img-fluid person" src="{{ asset('storage/' . $d->dev_photo) }}">
                    </div>
                    <div class="region-flag mb-2">
                        <img
                            src="https://flagcdn.com/h20/{{ $d->region }}.png"
                            srcset="https://flagcdn.com/h40/{{ $d->region }}.png 2x,
                                https://flagcdn.com/h60/{{ $d->region }}.png 3x"
                            height="20"
                            alt="{{ $d->region }}">
                    </div>
                    <div class="team-content">
                        <h3 class="name">{{ $d->name }}</h3>
                        <h4 class="title">{{ $d->role }}</h4>
                    </div>
                    <ul class="social">
                        <li><a href="{{ $d->instagram_link }}"><i class="bi bi-instagram"></i></a></li>
                        <li><a href="{{ $d->github_link }}"><i class="bi bi-github"></i></a></li>
                        <li><a href="mailto:{{ $d->email_link }}"><i class="bi bi-envelope"></i></a></li>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
@endsection