@extends('layouts.app')

@section('title', 'Edit status')

@section('content')
    <div class="card" style="width: 30rem;">
        <div class="card-body">
            <h4 class="card-title">Edit status</h4>
            <h6 class="card-subtitle mb-2 text-muted">Edit a task status name</h6>
            <p class="card-text">
            <form method="POST" action="{{ route('status.update', $status->id) }}">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $status->name }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" href="#">
                        Edit
                    </button>
                    <a type="button" class="btn btn-light" role="button" href="{{ route('status.index') }}">
                        Cancel
                    </a>
                </div>
            </form>
            <form method="POST" id="delete-form" action="{{ route('status.destroy', $status->id) }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <p>
                    <a href="#" class="text-danger"
                       onclick="document.getElementById('delete-form').submit();">Delete status
                    </a>
                </p>
            </form>
            </p>
        </div>
    </div>
@endsection
