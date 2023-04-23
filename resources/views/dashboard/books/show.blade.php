@extends("dashboard.layouts.core")

@section("container")
    <div class="container">
        <div class="row my-5">
            <div class="col-md-8">
                <h2>{{ $book->title }}</h2>
                
                <div class="my-3">
                    <a href="/dashboard/books/{{ $book->slug }}/edit" class="btn btn-warning text-white">Edit</a>
                    <form action="/dashboard/blogs/{{ $book->slug }}" method="POST" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('Are you sure want to delete ?');">Delete</button>
                    </form>
                </div>
                    
                <div class="mt-4">
                    <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7); border-bottom-right-radius: 10px;">
                        <a href='/books?category={{ $book->category->slug }}' class="text-white text-decoration-none">{{ $book->category->name }}</a>
                    </div>
                    {{-- {{ dd(asset('storage/' . $booklogs[0]->image)) }} --}}

                    @if($book->book_image != NULL)
                        <img src="{{ asset('storage/' . $book->book_image) }}" class="img-fluid" alt="inet_err">
                    @else
                        <img src="https://source.unsplash.com/1200x400?{{ $book->category->name }}" class="img-fluid" alt="inet_err" style="height: 300px;">
                    @endif
                </div>
                
                <article class="my-4">
                    
                        <h6 class="mb-3"><strong>Author :</strong> <a href="/books?author={{ $book->author->name }}">{{ $book->author->name }}</a></h6>
                        <h6 class="mb-3"><strong>Publisher :</strong> {{ $book->publisher }}</h6>
                        <h6 class="mb-3"><strong>Publication year :</strong> {{ $book->published_at }}</h6>
                        <h6 class="mb-3"><strong>Total Pages :</strong> {{ $book->total_pages }} pages</h6>
                        <h6 class="mb-3"><strong>Synopsis :</strong></h6>
                        {!! $book->body !!}
                </article>
            </div>
        </div>
    </div>
@endsection