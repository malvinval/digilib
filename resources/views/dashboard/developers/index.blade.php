@extends("dashboard.layouts.core")

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">All Developers</h1>
    </div>

    @if (session()->has("success"))
      <div class="alert alert-success col-lg-8" role="alert">
        {{ session("success") }}
      </div>
    @endif

    <div class="table-responsive col-lg-8">
        <a href="/dashboard/developers/create" class="btn btn-success mb-2">New</a>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th></th>
              <th scope="col">Name</th>
              <th scope="col">Role</th>
              <th scope="col">Created at</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($developers as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->name }}</td>
                    <td>{{ $d->role }}</td>
                    <td>{{ $d->created_at }}</td>
                    <td>
                        
                        <a href="/dashboard/developers/{{ $d->id }}" class="badge bg-primary">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        <a href="/dashboard/developers/{{ $d->id }}/edit" class="badge bg-warning">
                            <i class="bi bi-pen-fill"></i>
                        </a>
                        <form action="/dashboard/developers/{{ $d->id }}" method="POST" class="d-inline">
                          @method('delete')
                          @csrf
                          <button class="badge bg-danger border-0" onclick="return confirm('Are you sure want to remove this developer ?');"><i class="bi bi-trash3-fill"></i></button>
                        </form>                      
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
@endsection