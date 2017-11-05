@extends('layouts.app')

@section('title', 'Create status')

@section('content')
    <div class="card" style="width: 30rem;">
        <div class="card-body">
            <h4 class="card-title">Create status</h4>
            <h6 class="card-subtitle mb-2 text-muted">Create a new task status</h6>
            <p class="card-text">
            <form method="POST" action="{{ route('statuses.store') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" href="#">
                        Create
                    </button>
                    <a type="button" class="btn btn-light" role="button" href="{{ route('statuses.index') }}">
                        Cancel
                    </a>
                </div>
            </form>
            </p>
        </div>
    </div>
@endsection
