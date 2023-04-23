@extends('layouts.core')

@section('container')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>{{ $title }}</h2>

            <form action="/books/{{ $slug }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="heart-btn btn btn-primary">
                    <i class="{{ $liked == 0 ? 'bi bi-heart' : 'bi bi-heart-fill' }}"></i>
                    {{ $likes_total }}
                </button>
                @if($total_units !== 0)
                    <a href="/dashboard/loan/create" class="btn btn-success">Borrow this Book</a>
                @else
                    <p class="text-danger mt-4">This book is out of stock !</p>
                @endif
            </form>
            
            
            <div class="mt-4">
                <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7); border-bottom-right-radius: 10px;">
                    <a href='#' class="text-white text-decoration-none">{{ $category_name }}</a>
                </div>
                
                @if($book_image)
                    <img src="{{ asset('storage/' . $book_image) }}" class="img-fluid" alt="inet_err" style="height: 300px;">
                @else
                    <img src="https://source.unsplash.com/1200x400?book" class="img-fluid" alt="inet_err" style="height: 300px;">
                @endif
            </div>
            
            <article class="my-4">
                <h6 class="mb-3"><strong>Author :</strong> <a href="/books?author={{ $name }}">{{ $name }}</a></h6>
                <h6 class="mb-3"><strong>Publisher :</strong> {{ $publisher }}</h6>
                <h6 class="mb-3"><strong>Publication year :</strong> {{ $publication_year }}</h6>
                <h6 class="mb-3"><strong>Total Pages :</strong> {{ $total_pages }} pages</h6>
                <h6 class="mb-3"><strong>Total Units :</strong> {{ $total_units }} pcs.</h6>
                <h6 class="mb-3"><strong>Synopsis :</strong></h6>
                {!! $body !!}
            </article>
        </div>
    </div>
</div>

<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <h6 class="text-success">{{ $comments->count() }} comments</h6>
        </div>
    </div>
</div>

<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session()->has("success"))
            <div class="alert alert-success col-lg-8" role="alert">
                {{ session("success") }}
            </div>
            @endif
            <form method="POST" action="/books/{{ $slug }}/comment">
                @csrf
                {{-- @method("create") --}}
                <div class="mb-3">
                    
                    <input id="body" type="hidden" name="body" class="@error('body') is-invalid @enderror"
                    value="{{ old('body') }}">
                    
                    <trix-editor input="body" placeholder="Add a comment..."></trix-editor>
                    @error("body")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Comment</button>
            </form>
        </div>
    </div>    
</div>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        @foreach ($comments as $c)
            <div class="col-md-8 mb-4">
                <div class="comments-heading d-flex align-items-center mb-2">
                    <h6 class="m-0 fw-bold">{{ $c->user->name }}</h6>
                    <span class="badge bg-transparent text-muted fw-normal">{{ $c->created_at->diffForHumans() }}</span>
                </div>
                {!! $c->body !!}
            </div>
        @endforeach
    </div>
</div>
@endsection