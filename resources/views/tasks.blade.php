@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
    <h1 class="display-4">Tasks</h1>

    <nav class="navbar navbar-light bg-light justify-content-between">
        <form class="form-inline">
            <a class="btn btn-sm btn-outline-success" href="{{ route('tasks.create') }}" role="button">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                Add new task
            </a>
            <a class="btn btn-sm btn-outline-warning ml-sm-2" href="{{ route('tasks.index') }}" role="button">
                <i class="fa fa-ban" aria-hidden="true"></i>
                Clear all filters
            </a>
        </form>
        <form class="form-inline" method="get" id="filters-form" href="{{ route('tasks.index') }}">
            <div>
                <i class="fa fa-filter" aria-hidden="true"></i>
                Quick filters:
            </div>
            <div class="form-check form-check-inline ml-sm-2">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="filter-my-tasks"
                           @auth
                           value="{{ Auth::user()->id }}"

                           @if (Auth::user()->id == Request::input('creator'))
                           checked
                           @endif

                           @endauth
                    > My tasks
                </label>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="filter-assigned-to-me"
                           @auth
                           value="{{ Auth::user()->id }}"

                           @if (Auth::user()->id == Request::input('assignedto'))
                           checked
                           @endif

                           @endauth
                    > Assigned to Me
                </label>
            </div>
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

            <input type="hidden" name="status" data-filter-name="status" data-filter-destination
                   value="{{ Request::input('status') }}">
            <input type="hidden" name="creator" data-filter-name="creator" data-filter-destination
                   value="{{ Request::input('creator') }}">
            <input type="hidden" name="assignedto" data-filter-name="assignedto" data-filter-destination
                   value="{{ Request::input('assignedto') }}">
            <input type="hidden" name="tag" data-filter-name="tag" data-filter-destination
                   value="{{ Request::input('tag') }}">

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
                <select class="form-control-sm" name="status" data-filter-name="status" data-filter-source>
                    <option></option>
                    @foreach ($statuses as $key => $status)
                        <option value="{{ $status->id }}"

                                @if ($status->id == Request::input('status'))
                                selected
                                @endif

                        >{{ $status->name }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="form-control-sm" name="creator" data-filter-name="creator" data-filter-source>
                    <option></option>
                    @foreach ($users as $key => $user)
                        <option value="{{ $user->id }}"

                                @if ($user->id == Request::input('creator'))
                                selected
                                @endif

                        >{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="form-control-sm" name="assignedto" data-filter-name="assignedto" data-filter-source>
                    <option></option>
                    @foreach ($users as $key => $user)
                        <option value="{{ $user->id }}"

                                @if ($user->id == Request::input('assignedto'))
                                selected
                                @endif

                        >{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="form-control-sm" name="assignedto" data-filter-name="tag" data-filter-source>
                    <option></option>
                    @foreach ($tags as $key => $tag)
                        <option value="{{ $tag->id }}"

                                @if ($tag->id == Request::input('tag'))
                                selected
                                @endif

                        >{{ $tag->name }}</option>
                    @endforeach
                </select>
            </td>
            <td></td>
            <td></td>
        </tr>
        @foreach ($tasks as $key => $task)
            <tr>
                <th scope="row">{{ $task->id }}</th>
                <td><a href="{{ route('tasks.edit', $task->id) }}">{{ $task->name }}</a></td>
                <td>{{ $task->status->name }}</td>
                <td>{{ $task->creator->name }} <small>({{ $task->creator->email }})</small></td>
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
                <td><small>{{ $task->created_at }}</small></td>
                <td><small>{{ $task->updated_at }}</small></td>
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
