@extends('dashboard.layouts.core')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pending Requests</h1>
    </div>

    <div class="col-md-6 mt-4">
        @if (session()->has("success"))
            <div class="alert alert-success col-md-6" role="alert">
                {{ session("success") }}
            </div>
        @endif
        @if (session()->has("warning"))
            <div class="alert alert-warning col-md-6" role="alert">
                {{ session("warning") }}
            </div>
        @endif
        @if (session()->has("failed"))
            <div class="alert alert-danger col-md-6" role="alert">
                {{ session("failed") }}
            </div>
        @endif
        @foreach ($loans as $l)  
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">{{ $l->user->name }} at {{ $l->created_at }}</p>
                    @if($l->acceptance_status === 1)
                        <h5><span class="badge bg-opacity-25 bg-success text-success">Accepted</span></h5>
                    @elseif($l->acceptance_status === 0)
                        <h5><span class="badge bg-opacity-25 bg-danger text-danger">Rejected</span></h5>
                    @elseif($l->acceptance_status === 2)
                        <h5><span class="badge bg-opacity-25 bg-success text-success">Done</span></h5>
                    @else
                        <h5><span class="badge bg-opacity-100 bg-warning text-white">Waiting</span></h5>
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="card-title mb-3">{{ $l->book->title }} - {{ $l->book->author->name }}</h5>
                    <p class="card-text"><strong>Student ID : </strong>{{ $l->studentId }}</p>
                    <p class="card-text"><strong>Attachment : </strong></p>
                    @if(auth()->user()->studentID_image)
                        <div style="max-height: 500px; overflow: hidden;" class="mb-3">
                            <img src="{{ asset('storage/' . auth()->user()->studentID_image) }}" class="img-fluid w-50" alt="inet_err">
                        </div>
                    @else
                        <p class="text-danger"><i class="bi bi-exclamation-circle"></i> Student ID not attached</p>
                    @endif
                    <p class="card-text d-inline"><strong>Message :</strong> {!! $l->body !!}</p>

                    @if($l->acceptance_status === 1)
                        <p class="card-text"><strong>Pickup Deadline : </strong> {{ $pickup_deadline }}</p>
                        <p class="card-text"><strong>Book Return Deadline : </strong> {{ $return_deadline }}</p>
                    @endif

                    @if($l->acceptance_status === NULL)
                        <a href="/dashboard/requests/{{ $l->id }}/accept" class="btn btn-success">Accept</a>
                        <a href="/dashboard/requests/{{ $l->id }}/reject" class="btn btn-danger">Reject</a>
                    @elseif($l->acceptance_status === 1)
                        <a href="/dashboard/requests/{{ $l->id }}/done" class="btn text-success border-success" onclick="return confirm('Finish this Task ?');">Mark as Done</a> 
                        <a href="/dashboard/requests/{{ $l->id }}/cancel" class="btn btn-danger" onclick="return confirm('Are you sure want to cancel ?');">Cancel</a>
                    @elseif($l->acceptance_status !== 2)
                        <a href="/dashboard/requests/{{ $l->id }}/cancel" class="btn btn-danger" onclick="return confirm('Are you sure want to cancel ?');">Cancel</a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection