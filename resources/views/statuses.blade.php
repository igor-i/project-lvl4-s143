@extends('layouts.app')

@section('title', 'Statuses')

@section('content')
    <div class="container">
        <div>
            <h1 class="display-4">Statuses</h1>

            <nav class="navbar navbar-light bg-light justify-content-between">
                <form class="form-inline">
                    <a class="btn btn-sm btn-outline-success" href="{{ route('status.create') }}" role="button">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        Add new status
                    </a>
                </form>
                <form class="form-inline">
                    <input class="form-control form-control-sm mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-sm btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </nav>

            @if ($statuses->count() > 0)
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>id</th>
                        <th>name</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($statuses as $key => $status)
                        <tr>
                            <th scope="row">{{ $statuses->firstItem() + $key }}</th>
                            <td>{{ $status->id }}</td>
                            <td><a href="{{ route('status.edit', $status->id) }}">{{ $status->name }}</a></td>
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

            @else
                <p>...there is no statuses</p>
            @endif

        </div>
    </div>
@endsection
