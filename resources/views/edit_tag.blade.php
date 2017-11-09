@extends('layouts.app')

@section('title', 'Edit tag')

@section('content')
    <h1 class="display-4">Tags</h1>

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
                    <label for="color">Color</label>
                    <select class="form-control" name="color" id="color">
                        <option value="light"
                                @if ("light" == $tag->color)
                                selected
                                @endif
                        >light</option>
                        <option value="red"
                                @if ("red" == $tag->color)
                                selected
                                @endif
                        >red</option>
                        <option value="green"
                                @if ("green" == $tag->color)
                                selected
                                @endif
                        >green</option>
                        <option value="blue"
                                @if ("blue" == $tag->color)
                                selected
                                @endif
                        >blue</option>
                        <option value="grey"
                                @if ("grey" == $tag->color)
                                selected
                                @endif
                        >grey</option>
                        <option value="yellow"
                                @if ("yellow" == $tag->color)
                                selected
                                @endif
                        >yellow</option>
                        <option value="azure"
                                @if ("azure" == $tag->color)
                                selected
                                @endif
                        >azure</option>
                        <option value="black"
                                @if ("black" == $tag->color)
                                selected
                                @endif
                        >black</option>
                    </select>
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
