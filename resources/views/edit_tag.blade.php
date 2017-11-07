@extends('layouts.app')

@section('title', 'Edit status')

@section('content')
    <div class="card" style="width: 30rem;">
        <div class="card-body">
            <h4 class="card-title">Edit tag</h4>
            <h6 class="card-subtitle mb-2 text-muted">Edit a tag name</h6>
            <p class="card-text">
            <form method="POST" action="{{ route('tags.update', $tag->id) }}">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $tag->name }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Edit" data-disable-with="Saving...">
                    <a type="button" class="btn btn-light" role="button" href="{{ route('tags.index') }}">
                        Cancel
                    </a>
                </div>
            </form>
            </p>
            <p>
                <a href="{{ route('tags.destroy', $tag->id) }}" class="text-danger" rel="nofollow"
                   data-method="delete" data-confirm="Are you sure you want to delete tag?">Delete tag</a>
            </p>
        </div>
    </div>
@endsection
