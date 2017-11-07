@extends('layouts.app')

@section('title', 'Edit status')

@section('content')
    <h1 class="display-4">Statuses</h1>

    <div class="card" style="width: 30rem;">
        <div class="card-body">
            <h4 class="card-title">Edit status</h4>
            <h6 class="card-subtitle mb-2 text-muted">Edit a task status name</h6>
            <p class="card-text">
            <form method="POST" action="{{ route('statuses.update', $status->id) }}">
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
                    <input type="submit" class="btn btn-primary" value="Edit" data-disable-with="Saving...">
                    <a type="button" class="btn btn-light" role="button" href="{{ route('statuses.index') }}">
                        Cancel
                    </a>
                </div>
            </form>
            </p>
            <p>
                <a href="{{ route('statuses.destroy', $status->id) }}" class="text-danger" rel="nofollow"
                   data-method="delete" data-confirm="Are you sure you want to delete status?">Delete status</a>
            </p>
        </div>
    </div>
@endsection
