@extends('dashboard.layouts.core')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Your Loans Activity</h1>
    </div>

    <div class="col-md-6 mt-4">
        @foreach ($loans as $l)
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">{{ $l->created_at }}</p>
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
                    <h5 class="card-title">{{ $l->book->title }} - {{ $l->book->author->name }}</h5>
                    <p class="card-text"><strong>Attachment : </strong></p>
                    <div style="max-height: 500px; overflow: hidden;" class="mb-3">
                        <img src="{{ asset('storage/' . auth()->user()->studentID_image) }}" class="img-fluid w-50" alt="inet_err">
                    </div>
                    <p class="card-text d-inline"><strong>Message :</strong> {!! $l->body !!}</p>
                    
                    @if($l->acceptance_status === 1)
                        <p class="card-text"><strong> Pickup Deadline : </strong><span class="text-danger">{{ $pickup_deadline }}</span></p>
                        <p class="card-text"><strong> Return Deadline : </strong><span class="text-danger">{{ $return_deadline }}</span></p>
                   @endif

                    @if($l->acceptance_status === NULL)
                        <form action="/dashboard/loan/{{ $l->id }}" method="POST" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger border-0" onclick="return confirm('Are you sure want to cancel ?');">Cancel</button>
                         </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection