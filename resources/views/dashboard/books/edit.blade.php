@extends("dashboard.layouts.core")

@section('container')
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Now Editing : {{ $book->title }}</h1>
        </div>

        <div class="col-lg-8">
            <form method="POST" action="/dashboard/books/{{ $book->id }}" enctype="multipart/form-data">
                @method("put")
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" autofocus
                    value="{{ $book->title }}">
                    @error("title")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
    
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                    value="{{ $book->slug }}">
                    @error("slug")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
    
                <div class="mb-3">
                  <label for="author" class="form-label">Author</label>
                  <select class="form-select @error('author_id') is-invalid @enderror" name="author_id">
                      @foreach($authors as $a)
                          @if(old("category_id") == $a->id)
                              <option value="{{ $a->id }}" selected>{{ $a->name }}</option>
                          @else
                              <option value="{{ $a->id }}">{{ $a->name }}</option>
                          @endif
                      @endforeach
                  </select>
                  @error("author_id")
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
                </div>
                
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                        @foreach($categories as $c)
                            @if(old("category_id") == $c->id)
                                <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
                            @else
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error("category_id")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
    
                <div class="mb-3">
                  <label for="publisher" class="form-label">Publisher</label>
                  <input type="text" class="form-control @error('publisher') is-invalid @enderror" id="publisher" name="publisher"
                  value="{{ $book->publisher }}">
                  @error("publisher")
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
    
                <div class="mb-3">
                  <label for="published_at" class="form-label">Year of Publication</label>
                  <input type="text" class="form-control @error('published_at') is-invalid @enderror" id="published_at" name="published_at"
                  value="{{ $book->published_at }}">
                  @error("published_at")
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
                </div>

                <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input type="text" class="form-control @error('isbn') is-invalid @enderror" id="isbn" name="isbn"
                    value="{{ $book->isbn }}">
                    @error("isbn")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
    
                <div class="mb-3">
                  <label for="total_pages" class="form-label">Total of Pages</label>
                  <input type="number" class="form-control @error('total_pages') is-invalid @enderror" id="total_pages" name="total_pages"
                  value="{{ $book->total_pages }}">
                  @error("total_pages")
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
    
                <div class="mb-3">
                  <label for="total_units" class="form-label">Total Units</label>
                  <input type="number" class="form-control @error('total_units') is-invalid @enderror" id="total_units" name="total_units"
                  value="{{ $book->total_units }}">
                  @error("total_units")
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
    
                <div class="mb-3">
                    <label for="book_image" class="form-label">Book image</label>
                    <input class="form-control @error('body') is-invalid @enderror" type="file" id="book_image" name="book_image">
    
                    @error("book_image")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
    
                <div class="mb-3">
                    <label for="body" class="form-label">Synopsis</label>
                    <input id="body" type="hidden" name="body" class="@error('body') is-invalid @enderror" value="{{ $book->body }}">
                    <trix-editor input="body"></trix-editor>
                    @error("body")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Confirm</button>
            </form>
        </div>
    
    <script>
        const title = document.querySelector("#title");
        const slug = document.querySelector("#slug");

        title.addEventListener("keyup", function() {
            let preslug = title.value;
            preslug = preslug.replace(/ /g,"-");
            slug.value = preslug.toLowerCase();
        });

        document.addEventListener("trix-file-accept", function (e) {
            e.preventDefault();
        })
    </script>
@endsection

