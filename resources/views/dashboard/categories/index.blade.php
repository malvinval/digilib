@extends('dashboard.layouts.core')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">All Categories</h1>
</div>

@if (session()->has("success"))
  <div class="alert alert-success col-lg-6" role="alert">
    {{ session("success") }}
  </div>
@endif
@if (session()->has("warning"))
  <div class="alert alert-warning col-lg-6" role="alert">
    {{ session("warning") }}
  </div>
@endif
@if (session()->has("failed"))
  <div class="alert alert-danger col-lg-6" role="alert">
    {{ session("failed") }}
  </div>
@endif

<div class="table-responsive col-lg-8">
    <a href="/dashboard/categories/create" class="btn btn-success mb-2">New</a>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th></th>
          <th scope="col">Category Name</th>
          <th scope="col">Total of Related Books</th>
          <th scope="col">Created at</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $c)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $c->name }}</td>
                <td>
                  {{ $books->where("category_id", $c->id)->count() }} unit(s)
                </td>
                <td>{{ $c->created_at }}</td>
                <td>
                    <a href="/dashboard/categories/{{ $c->id }}/edit" class="badge bg-warning text-decoration-none">
                        EDIT
                    </a>
                    <form action="/dashboard/categories/{{ $c->id }}" method="POST" class="d-inline">
                      @method('delete')
                      @csrf
                      <button class="badge bg-danger border-0" onclick="return confirm('Are you sure want to delete ?');">DELETE</button>
                    </form>                      
                </td>
            </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection