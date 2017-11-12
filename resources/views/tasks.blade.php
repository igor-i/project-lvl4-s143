@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
    <h1 class="display-4">Tasks</h1>

    <nav class="navbar navbar-light bg-light justify-content-between">

        <div>
            <a class="btn btn-sm btn-outline-success" href="{{ route('tasks.create') }}" role="button">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                Add new task
            </a>
            <a class="btn btn-sm btn-outline-warning ml-sm-2" href="{{ route('tasks.index') }}" role="button">
                <i class="fa fa-ban" aria-hidden="true"></i>
                Clear all filters
            </a>
        </div>

        <form class="form-inline" method="get" id="filters-form" href="{{ route('tasks.index') }}">
            @auth
                <div>
                    <i class="fa fa-filter" aria-hidden="true"></i>
                    Quick filters:
                </div>
                <div class="form-check form-check-inline ml-sm-2">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" id="filter-my-tasks"
                               value="{{ Auth::user()->id }}"
                               @if (Auth::user()->id == Request::input('creatorId'))
                               checked
                                @endif
                        > My tasks
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" id="filter-assigned-to-me"
                               value="{{ Auth::user()->id }}"
                               @if (Auth::user()->id == Request::input('assignedtoId'))
                               checked
                                @endif
                        > Assigned to Me
                    </label>
                </div>
            @endauth
            <div class="input-group">
                <input class="form-control form-control-sm" type="search" placeholder="Search by name and description"
                       aria-label="Search" name="fulltext" value="{{ Request::input('fulltext') }}">
                @if (Request::input('fulltext') !== null)
                    <span class="input-group-btn">
                            <a class="btn btn-sm btn-outline-warning" type="button" href="{{ route('tasks.index') }}">
                                <i class="fa fa-ban" aria-hidden="true"></i>
                                Clear full-text search
                            </a>
                        </span>
                @endif
            </div>

            <input type="hidden" name="statusId" data-filter-name="statusId" data-filter-destination
                   value="{{ Request::input('statusId') }}">
            <input type="hidden" name="creatorId" data-filter-name="creatorId" data-filter-destination
                   value="{{ Request::input('creatorId') }}">
            <input type="hidden" name="assignedtoId" data-filter-name="assignedtoId" data-filter-destination
                   value="{{ Request::input('assignedtoId') }}">
            <input type="hidden" name="tagId" data-filter-name="tagId" data-filter-destination
                   value="{{ Request::input('tagId') }}">

            <input type="submit" class="btn btn-sm btn-outline-secondary ml-sm-2 my-2 my-sm-0"
                   value="Search" data-disable-with="Searching...">
        </form>
    </nav>

    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th>#</th>
            <th>name</th>
            <th>status</th>
            <th>creator</th>
            <th>assignedTo</th>
            <th>tags</th>
            <th>created_at</th>
            <th>updated_at</th>
        </tr>
        </thead>
        <tbody>
        <tr id="filters">
            <td scope="row" colspan="2" class="text-right">
                <i class="fa fa-filter" aria-hidden="true"></i>
                Filters:
            </td>
            <td>

                {!! Form::select(
                        'statusId',
                        $statusesArray,
                        Request::input('statusId'),
                        ['placeholder' => '', 'class' => 'form-control-sm', 'data-filter-name' => 'statusId', 'data-filter-source']
                    )
                !!}

            </td>
            <td>

                {!! Form::select(
                        'creatorId',
                        $usersArray,
                        Request::input('creatorId'),
                        ['placeholder' => '', 'class' => 'form-control-sm', 'data-filter-name' => 'creatorId', 'data-filter-source']
                    )
                !!}

            </td>
            <td>

                {!! Form::select(
                        'assignedtoId',
                        $usersArray,
                        Request::input('assignedtoId'),
                        ['placeholder' => '', 'class' => 'form-control-sm', 'data-filter-name' => 'assignedtoId', 'data-filter-source']
                    )
                !!}

            </td>
            <td>

                {!! Form::select(
                        'tagId',
                        $tagsArray,
                        Request::input('tagId'),
                        ['placeholder' => '', 'class' => 'form-control-sm', 'data-filter-name' => 'tagId', 'data-filter-source']
                    )
                !!}

            </td>
            <td></td>
            <td></td>
        </tr>
        @foreach ($tasks as $key => $task)
            <tr>
                <th scope="row">{{ $task->id }}</th>
                <td><a href="{{ route('tasks.edit', $task->id) }}">{{ $task->name }}</a></td>
                <td>{{ $task->status->name }}</td>
                <td>{{ $task->creator->name }}
                    <small>({{ $task->creator->email }})</small>
                </td>
                <td>{{ $task->assignedto->name }}

                    @isset($task->assignedto->email)
                        <small>({{ $task->assignedto->email }})</small>
                    @endisset

                </td>
                <td>
                    @foreach ($task->tags as $tag)
                        @switch($tag->color)
                            @case('red')
                            <span class="badge badge-danger">{{ $tag->name }}</span>
                            @break

                            @case('green')
                            <span class="badge badge-success">{{ $tag->name }}</span>
                            @break

                            @case('blue')
                            <span class="badge badge-primary">{{ $tag->name }}</span>
                            @break

                            @case('grey')
                            <span class="badge badge-secondary">{{ $tag->name }}</span>
                            @break

                            @case('yellow')
                            <span class="badge badge-warning">{{ $tag->name }}</span>
                            @break

                            @case('azure')
                            <span class="badge badge-info">{{ $tag->name }}</span>
                            @break

                            @case('light')
                            <span class="badge badge-light">{{ $tag->name }}</span>
                            @break

                            @case('black')
                            <span class="badge badge-dark">{{ $tag->name }}</span>
                            @break

                            @default
                            <span class="badge badge-light">{{ $tag->name }}</span>
                        @endswitch
                    @endforeach
                </td>
                <td>
                    <small>{{ $task->created_at }}</small>
                </td>
                <td>
                    <small>{{ $task->updated_at }}</small>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <p>
        <nav aria-label="Tasks navigation">
            {{ $tasks->links('vendor/pagination/bootstrap-4') }}
        </nav>
    </p>

    @if ($tasks->count() == 0)
        <p>...there is no tasks</p>
    @endif

@endsection
