@extends('layouts.app')
@section('content')
<div class="container">
  <br>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Todos List</h2>
        </div>
        <div class="col-md-6">
            <div class="float-right">
                <a href="{{ route('todo.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add new todo</a>
            </div>
        </div>
        <br>
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Task Name</th>
                <th>Task Status</th>
                <th>Created At</th> {{-- NEW --}}
                <th>Updated At</th> {{-- NEW --}}
                <th>Action</th>
            </tr>
            </thead>
        <tbody>
          @forelse ($todos as $todo)
              <tr>
                <td>{{ $todo->id }}</td>
                <td>{{ $todo->title }}</td>
                <td>{{ $todo->status }}</td>
                <td>{{ $todo->created_at->format('d M Y, h:i A') }}</td> {{-- NEW --}}
                <td>{{ $todo->updated_at->format('d M Y, h:i A') }}</td> {{-- NEW --}}
                <td>
                    <a href="{{ route('todo.edit', $todo->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('todo.destroy', $todo->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
                </tr>
          @empty
              <tr>
              <td colspan="4"><center>No data found</center></td>
            </tr>
          @endforelse
        </tbody>
      </table>
        </div>
    </div>
</div>
@endsection