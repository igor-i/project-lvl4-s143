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
            <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
                    <label for="name" class="col-sm-2 col-form-label">Name*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name"
                               value="{{ $task->name }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }} row">
                    <label for="description" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" id="description" name="description"
                                  rows="3">{{ $task->description }}</textarea>

                        @if ($errors->has('description'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }} row">
                    <label for="status" class="col-sm-2 col-form-label">Status*</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="status" name="status" required>
                            @foreach ($statuses as $key => $status)
                                <option value="{{ $status->id }}"
                                        @if ($status->id == $task->status->id)
                                        selected
                                        @endif
                                        >{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if ($errors->has('status'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('status') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">
                    <label for="creator" class="col-sm-2 col-form-label">Creator*</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" id="creator"
                               value="{{ $task->creator->name }} ({{ $task->creator->email }})" required readonly>
                        <input type="hidden" name="creator" value="{{ $task->creator->id }}">
                    </div>

                    @if ($errors->has('creator'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('creator') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('assignedto') ? ' has-error' : '' }} row">
                    <label for="assignedto" class="col-sm-2 col-form-label">AssignedTo</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="assignedto" id="assignedto">
                            <option
                            @if (empty($task->assignedto))
                                selected
                            @endif
                            ></option>
                            @foreach ($users as $key => $user)
                                <option value="{{ $user->id }}"
                                        @if ($user->id == $task->assignedto->id)
                                        selected
                                        @endif
                                >{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>

                    @if ($errors->has('assignedto'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('assignedto') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('tag') ? ' has-error' : '' }} row">
                    <label for="tag" class="col-sm-2 col-form-label">Tag</label>
                    <div class="col-sm-10">
                        <select multiple class="form-control" id="tag" name="tag[]">
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

                    @if ($errors->has('tag'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('tag') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">
                    <span class="col-sm-2"></span>
                    <div class="col-sm-10">
                        <input type="submit" class="btn btn-primary" value="Edit" data-disable-with="Editing...">
                        <a type="button" class="btn btn-light" role="button" href="{{ route('tasks.index') }}">
                            Cancel
                        </a>
                    </div>
                </div>

                <div class="form-group row">
                    <span class="col-sm-2"></span>
                    <div class="col-sm-10">
                        <a href="{{ route('tasks.destroy', $task->id) }}" class="text-danger" rel="nofollow"
                           data-method="delete" data-confirm="Are you sure you want to delete task?">Delete task</a>
                    </div>
                </div>
            </form>
            </p>
        </div>
    </div>
@endsection
