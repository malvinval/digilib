@extends('dashboard.layouts.core')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Now Editing : </h1>
    </div>

    <div class="col-lg-8">
        <form method="POST" action="/dashboard/developers/{{ $developer->id }}" enctype="multipart/form-data">
            @csrf
            @method("put")
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" autofocus
                value="{{ $developer->name }}">
                @error("name")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <input type="text" class="form-control @error('role') is-invalid @enderror" id="role" name="role"
                value="{{ $developer->role }}">
                @error("role")
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="region" class="form-label">Region</label>
                <select class="form-select @error('region') is-invalid @enderror" name="region">
                    @foreach($regions as $r)
                        <option>{{ $r["Code"] }}</option>
                    @endforeach
                </select>
                @error("region")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="instagram_link" class="form-label">Instagram Link</label>
                <input type="text" class="form-control @error('instagram_link') is-invalid @enderror" id="instagram_link" name="instagram_link"
                value="{{ $developer->instagram_link }}">
                @error("instagram_link")
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="github_link" class="form-label">Github Link</label>
                <input type="text" class="form-control @error('github_link') is-invalid @enderror" id="github_link" name="github_link"
                value="{{ $developer->github_link }}">
                @error("github_link")
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email_link" class="form-label">Email Link</label>
                <input type="text" class="form-control @error('email_link') is-invalid @enderror" id="email_link" name="email_link"
                value="{{ $developer->email_link }}">
                @error("email_link")
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="dev_photo" class="form-label">Photo</label>
                <input class="form-control @error('dev_photo') is-invalid @enderror" type="file" id="dev_photo" name="dev_photo">

                @error("dev_photo")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Confirm</button>
        </form>
    </div>

@endsection