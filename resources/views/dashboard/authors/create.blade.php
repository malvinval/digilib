@extends("dashboard.layouts.core")

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create new Author</h1>
    </div>

    <div class="col-lg-4">
        <form method="POST" action="/dashboard/authors">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" autofocus
                value="{{ old('name') }}">
                @error("name")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" autofocus
                value="{{ old('slug') }}">
                @error("slug")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="region" class="form-label">Region</label>
                <input type="text" class="form-control @error('region') is-invalid @enderror" id="region" name="region"
                value="{{ old('region') }}">
                @error("region")
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>

    <script>
        const name = document.querySelector("#name");
        const slug = document.querySelector("#slug");

        name.addEventListener("keyup", function() {
            slug.value = name.value;
            slug.value = name.value.toLowerCase().replace(/ /g,"-");
        });
    </script>
@endsection
