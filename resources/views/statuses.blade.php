@extends('layouts.app')

@section('title', 'Statuses')

@section('content')
    <h1 class="display-4">Statuses</h1>

    <nav class="navbar navbar-light bg-light justify-content-between">
        <form class="form-inline">
            <a class="btn btn-sm btn-outline-success" href="{{ route('statuses.create') }}" role="button">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                Add new status
            </a>
        </form>
        <form class="form-inline" method="get" href="{{ route('statuses.index') }}">
            <div class="input-group">
                <input class="form-control form-control-sm" type="search" placeholder="Search"
                       aria-label="Search" name="name" value="{{ Request::input('name') }}">
                @if(Request::input('name') !== null)
                    <span class="input-group-btn">
                            <a class="btn btn-sm btn-outline-danger" type="button" href="{{ route('statuses.index') }}">
                                <i class="fa fa-ban" aria-hidden="true"></i>
                            </a>
                        </span>
                @endif
            </div>

            <input type="submit" class="btn btn-sm btn-outline-secondary ml-sm-2 my-2 my-sm-0"
                   value="Search" data-disable-with="Searching...">
        </form>
    </nav>

    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th>#</th>
            <th>name</th>
            <th>created_at</th>
            <th>updated_at</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($statuses as $key => $status)
            <tr>
                <th scope="row">{{ $status->id }}</th>
                <td><a href="{{ route('statuses.edit', $status->id) }}">{{ $status->name }}</a></td>
                <td>{{ $status->created_at }}</td>
                <td>{{ $status->updated_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <p>
        <nav aria-label="Statuses navigation">
            {{ $statuses->links('vendor/pagination/bootstrap-4') }}
        </nav>
    </p>

    @if ($statuses->count() == 0)
        <p>...there is no statuses</p>
    @endif

@endsection
