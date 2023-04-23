@extends("dashboard.layouts.core")

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Send Loan Request</h1>
    </div>

    <div class="col-lg-6">
        @if (session()->has("failed"))
            <div class="alert alert-danger col-lg-8" role="alert">
                {{ session("failed") }}
            </div>
        @endif
        <form method="POST" action="/dashboard/loan" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="book" class="form-label">Choose a Book</label>
                <select class="form-select @error('book_id') is-invalid @enderror" name="book_id">
                    @foreach($books as $b)                      
                        <option value="{{ $b->id }}">{{ $b->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="studentId" class="form-label">Student ID</label>
                <input type="text" class="form-control @error('studentId') is-invalid @enderror" id="studentId" name="studentId" 
                value="{{ old('studentId') }}">
                @error("studentId")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="body" class="form-label">Why are you interested to loan this book ?</label>
                <input id="body" type="hidden" name="body" class="@error('body') is-invalid @enderror" value="{{ old('body') }}">
                <trix-editor input="body"></trix-editor>
                @error("body")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
        
@endsection
