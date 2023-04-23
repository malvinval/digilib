@extends("dashboard.layouts.core")

@section("container")
    <div class="container-fluid d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom dashboard-title">
        <h2 class="text-muted">{{ auth()->user()->name }}'s Room</h2>
    </div>

    <div class="container-fluid profile-container mb-4">
        <h5><strong>Your Personal Informations</strong></h5>

        @if (session()->has("success"))
        <div class="alert alert-success col-md-6" role="alert">
            {{ session("success") }}
        </div>
        @endif

        <div class="col-md-6 mt-4">
            
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ auth()->user()->name }}" readonly>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                value="{{ auth()->user()->username }}" readonly>
            </div>

            <div class="mb-3">
                <label for="studentID_image" class="form-label">Student ID</label>
                @if(auth()->user()->studentID_image)
                    <div style="max-height: 500px; overflow: hidden;">
                        <img src="{{ asset('storage/' . auth()->user()->studentID_image) }}" class="img-fluid w-50" alt="inet_err">
                    </div>
                @else
                    <p class="text-danger"><i class="bi bi-exclamation-circle"></i> Please upload your Student ID</p>
                @endif
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Registered Email</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ auth()->user()->email }}" readonly>
            </div>

            <div class="mb-3">
                <label for="joined-at" class="form-label">Joined Since</label>
                <input type="text" class="form-control @error('joined-at') is-invalid @enderror" id="joined-at" name="joined-at"
                value="{{ auth()->user()->created_at }}" readonly>
            </div>

            <a href="/dashboard/profile/{{ auth()->user()->username }}/edit" class="btn btn-warning text-white me-2">
                Edit Profile
            </a>

            <form action="/dashboard/profile/{{ auth()->user()->name }}" method="POST" class="d-inline">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger text-white" onclick="return confirm('Are you sure want to delete your account ?');">Delete Account</button>
            </form>
            
            
        </div>
    </div>

    <div class="container-fluid">
        <h5><strong>Your Performances</strong></h5>

        <div class="p-0 d-flex justify-content-between dashboard-cards-container mt-4">
            <div class="child-container item-1">
                <h4><i class="bi bi-book-half me-2"></i> {{ $total_loans }}</h4>
                <h6 class="mt-3">Total of Books Borrowed</h6>
            </div>

            <div class="child-container item-2">
                
                <h4><i class="bi bi-eyeglasses"></i> {{ $current_loans }}</h4>
                <h6 class="mt-3">Total of Books Currently Borrowed</h6>
            </div>

            <div class="child-container item-3">
                <h4><i class="bi bi-person-hearts me-2"></i>0</h4>
                <h6 class="mt-3">Total of Interactions</h6>
            </div>
        </div>
    </div>
@endsection