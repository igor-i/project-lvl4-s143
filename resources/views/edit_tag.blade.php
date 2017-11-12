@extends('layouts.app')

@section('title', 'Edit tag')

@section('content')
    <h1 class="display-4">Tags</h1>

    <div class="card" style="width: 30rem;">
        <div class="card-body">
            <h4 class="card-title">Edit tag</h4>
            <h6 class="card-subtitle mb-2 text-muted">Edit a tag name</h6>
            <p class="card-text">

            {!! Form::model($tag, ['route' => ['tags.update', $tag->id], 'method' => 'patch']) !!}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', $tag->name, ['class' => 'form-control', 'required', 'autofocus']) !!}

                @if ($errors->has('name'))
                    <span class="help-block text-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                @endif
            </div>

            <div class="form-group">

                {!! Form::label('color', 'Color') !!}
                {!! Form::select(
                        'color',
                        [
                            'light' => 'light',
                            'red' => 'red',
                            'green' => 'green',
                            'blue' => 'blue',
                            'grey' => 'grey',
                            'yellow' => 'yellow',
                            'azure' => 'azure',
                            'black' => 'black'
                        ],
                        $tag->color,
                        ['placeholder' => 'Pick a color...']
                    )
                !!}

            </div>
            <div class="form-group">

                {!! Form::submit('Edit', ['class' => 'btn btn-primary', 'data-disable-with' => 'Saving...']) !!}
                {!! link_to_route(
                    'tags.index',
                    $title = 'Cancel',
                    $parameters = [],
                    $attributes = ['class' => 'btn btn-light', 'type' => 'button', 'role' => 'button']) !!}

            </div>
            </p>
            <p>
                <a href="{{ route('tags.destroy', $tag->id) }}" class="text-danger" rel="nofollow"
                   data-method="delete" data-confirm="Are you sure you want to delete tag?">Delete tag</a>
            </p>
        </div>
    </div>
@endsection
