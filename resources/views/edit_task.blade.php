@extends('layouts.app')

@section('title', 'Edit task')

@section('content')
    <h1 class="display-4">Tasks</h1>

    <div class="card" style="width: 50rem;">
        <div class="card-header">
            <h4 class="card-title">Edit task</h4>
            <h6 class="card-subtitle mb-2 text-muted">Edit a task information</h6>
            <p class="card-text">
        </div>
        <div class="card-body">

            {!! Form::model($task, ['route' => ['tasks.update', $task->id], 'method' => 'patch']) !!}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">

                    {!! Form::label('name', 'Name*', ['class' => 'col-sm-2 col-form-label']) !!}

                    <div class="col-sm-10">

                        {!! Form::text('name', old('name'), ['class' => 'form-control', 'required', 'autofocus']) !!}


                        @if ($errors->has('name'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }} row">

                    {!! Form::label('description', 'Description', ['class' => 'col-sm-2 col-form-label']) !!}

                    <div class="col-sm-10">

                        {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'rows' => '3']) !!}

                        @if ($errors->has('description'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('status_id') ? ' has-error' : '' }} row">

                    {!! Form::label('status_id', 'Status*', ['class' => 'col-sm-2 col-form-label']) !!}

                    <div class="col-sm-10">

                        {!! Form::select(
                                'status_id',
                                $statusesArray,
                                $task->status->id,
                                ['class' => 'form-control', 'required']
                            )
                        !!}

                    </div>

                    @if ($errors->has('status_id'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('status_id') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">

                    {!! Form::label('creator', 'Creator*', ['class' => 'col-sm-2 col-form-label']) !!}

                    <div class="col-sm-10">

                        {!! Form::text('creator', $task->creator->name . '(' . $task->creator->email . ')', ['class' => 'form-control', 'required', 'readonly']) !!}
                        {!! Form::hidden('creator_id', $task->creator->id) !!}

                    </div>

                    @if ($errors->has('creator_id'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('creator_id') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('assignedto_id') ? ' has-error' : '' }} row">

                    {!! Form::label('assignedto_id', 'AssignedTo', ['class' => 'col-sm-2 col-form-label']) !!}

                    <div class="col-sm-10">

                        {!! Form::select(
                                'assignedto_id',
                                $usersArray,
                                $task->assignedto->id,
                                ['placeholder' => '', 'class' => 'form-control']
                            )
                        !!}

                    </div>

                    @if ($errors->has('assignedto_id'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('assignedto_id') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('tags_ids') ? ' has-error' : '' }} row">

                    {!! Form::label('tags_ids', 'Tags', ['class' => 'col-sm-2 col-form-label']) !!}

                    <div class="col-sm-10">
                        <select multiple class="form-control" id="tags_ids" name="tags_ids[]" data-select2-multiple>
                            @foreach ($tags as $key => $tag)
                                <option value="{{ $tag->id }}"
                                        @foreach ($task->tags as $taskTag)

                                        @if ($tag->id == $taskTag->id)
                                        selected
                                        @endif

                                        @endforeach
                                >{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if ($errors->has('tags_ids'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('tags_ids') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">
                    <span class="col-sm-2"></span>
                    <div class="col-sm-10">

                        {!! Form::submit('Edit', ['class' => 'btn btn-primary', 'data-disable-with' => 'Editing...']) !!}
                        {!! link_to_route(
                            'tasks.index',
                            $title = 'Cancel',
                            $parameters = [],
                            $attributes = ['class' => 'btn btn-light', 'type' => 'button', 'role' => 'button']) !!}

                    </div>
                </div>

                <div class="form-group row">
                    <span class="col-sm-2"></span>
                    <div class="col-sm-10">
                        <a href="{{ route('tasks.destroy', $task->id) }}" class="text-danger" rel="nofollow"
                           data-method="delete" data-confirm="Are you sure you want to delete task?">Delete task</a>
                    </div>
                </div>
            {!! Form::close() !!}

            </p>
        </div>
    </div>
@endsection
