@extends("dashboard.layouts.core")

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Profile</h1>
    </div>

    <div class="col-md-6">
        <form method="POST" action="/dashboard/profile/{{ auth()->user()->username }}" enctype="multipart/form-data">
            @method("put")
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" autofocus
                value="{{ auth()->user()->name }}">
                @error("name")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                value="{{ auth()->user()->username }}">
                @error("username")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="studentID_image" class="form-label">Student ID</label>
                <input class="form-control @error('studentID_image') is-invalid @enderror" type="file" id="studentID_image" name="studentID_image">
            
                @error("studentID_image")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
                
            <button type="submit" class="btn btn-primary">Confirm</button>
        </form>
    </div>
@endsection


