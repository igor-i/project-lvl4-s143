@extends('layouts.app')

@section('title', 'Create tag')

@section('content')
    <h1 class="display-4">Tags</h1>

    <div class="card" style="width: 30rem;">
        <div class="card-body">
            <h4 class="card-title">Create tag</h4>
            <h6 class="card-subtitle mb-2 text-muted">Create a new tag</h6>
            <p class="card-text">
            <form method="POST" action="{{ route('tags.store') }}">
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
                    <label for="color">Color</label>
                    <select class="form-control" name="color" id="color">
                        <option value="light"
                                @if ("light" == old('color'))
                                selected
                                @endif
                        >light</option>
                        <option value="red"
                                @if ("red" == old('color'))
                                selected
                                @endif
                        >red</option>
                        <option value="green"
                                @if ("green" == old('color'))
                                selected
                                @endif
                        >green</option>
                        <option value="blue"
                                @if ("blue" == old('color'))
                                selected
                                @endif
                        >blue</option>
                        <option value="grey"
                                @if ("grey" == old('color'))
                                selected
                                @endif
                        >grey</option>
                        <option value="yellow"
                                @if ("yellow" == old('color'))
                                selected
                                @endif
                        >yellow</option>
                        <option value="azure"
                                @if ("azure" == old('color'))
                                selected
                                @endif
                        >azure</option>
                        <option value="black"
                                @if ("black" == old('color'))
                                selected
                                @endif
                        >black</option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Create" data-disable-with="Creating...">
                    <a type="button" class="btn btn-light" role="button" href="{{ route('tags.index') }}">
                        Cancel
                    </a>
                </div>
            </form>
            </p>
        </div>
    </div>
@endsection
