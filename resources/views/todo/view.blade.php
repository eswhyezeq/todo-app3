@extends('layouts.app')
@section('content')
<div class="container">
  <br>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Todo Details</h2>
        </div>
        <div class="col-md-6">
            <div class="float-right">
                <a href="{{ route('todo.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <br>
        <div class="col-md-12">
            <br><br>
            <div class="todo-title">
                <strong>Title: </strong> {{ $todo->title }}
            </div>
            <br>
            <div class="todo-description">
                <strong>Description: </strong> {{ $todo->description }}
            </div>
            <br>
            <div class="todo-status">
                <strong>Status: </strong> {{ $todo->status }}
            </div>
            <br>
            <div class="todo-created">
                <strong>Created At: </strong> {{ $todo->created_at->format('d M Y, h:i A') }}
            </div>
            <br>
            <div class="todo-updated">
                <strong>Last Updated: </strong> {{ $todo->updated_at->format('d M Y, h:i A') }}
            </div>
        </div>
    </div>
</div>
@endsection
