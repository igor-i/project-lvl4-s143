@extends('layouts.app')

@section('title', 'Edit status')

@section('content')
    <h1 class="display-4">Statuses</h1>

    <div class="card" style="width: 30rem;">
        <div class="card-body">
            <h4 class="card-title">Edit status</h4>
            <h6 class="card-subtitle mb-2 text-muted">Edit a task status name</h6>
            <p class="card-text">

            {!! Form::model($status, ['route' => ['statuses.update', $status->id], 'method' => 'patch']) !!}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', $status->name, ['class' => 'form-control', 'required', 'autofocus']) !!}

                @if ($errors->has('name'))
                    <span class="help-block text-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                @endif
            </div>
            <div class="form-group">

                {!! Form::submit('Edit', ['class' => 'btn btn-primary', 'data-disable-with' => 'Saving...']) !!}
                {!! link_to_route(
                    'statuses.index',
                    $title = 'Cancel',
                    $parameters = [],
                    $attributes = ['class' => 'btn btn-light', 'type' => 'button', 'role' => 'button']) !!}

            </div>
            {!! Form::close() !!}

            </p>
            <p>
                <a href="{{ route('statuses.destroy', $status->id) }}" class="text-danger" rel="nofollow"
                   data-method="delete" data-confirm="Are you sure you want to delete status?">Delete status</a>
            </p>
        </div>
    </div>
@endsection
