@extends('layouts.app')

@section('title', 'Create status')

@section('content')
    <h1 class="display-4">Statuses</h1>

    <div class="card" style="width: 30rem;">
        <div class="card-body">
            <h4 class="card-title">Create status</h4>
            <h6 class="card-subtitle mb-2 text-muted">Create a new task status</h6>
            <p class="card-text">

            {!! Form::open(['route' => 'statuses.store']) !!}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', old('name'), ['class' => 'form-control', 'required', 'autofocus']) !!}

                @if ($errors->has('name'))
                    <span class="help-block text-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                @endif
            </div>

            <div class="form-group">

                {!! Form::submit('Create', ['class' => 'btn btn-primary', 'data-disable-with' => 'Creating...']) !!}
                {!! link_to_route(
                    'statuses.index',
                    $title = 'Cancel',
                    $parameters = [],
                    $attributes = ['class' => 'btn btn-light', 'type' => 'button', 'role' => 'button']) !!}

            </div>
            {!! Form::close() !!}

            </p>
        </div>
    </div>
@endsection
