@extends('layouts.app')

@section('title', 'Tags')

@section('content')
    <div class="container">
        <div>
            <h1 class="display-4">Tags</h1>

            <nav class="navbar navbar-light bg-light justify-content-between">
                <form class="form-inline">
                    <a class="btn btn-sm btn-outline-success" href="{{ route('tags.create') }}" role="button">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        Add new tag
                    </a>
                </form>
                <form class="form-inline" method="get" href="{{ route('tags.index') }}">
                    <div class="input-group">
                        <input class="form-control form-control-sm" type="search" placeholder="Search"
                               aria-label="Search" name="name" value="{{ Request::input('name') }}">
                        @if(Request::input('name') !== null)
                            <span class="input-group-btn">
                            <a class="btn btn-sm btn-outline-danger" type="button" href="{{ route('tags.index') }}">
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
                    <th>id</th>
                    <th>name</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tags as $key => $tag)
                    <tr>
                        <th scope="row">{{ $tags->firstItem() + $key }}</th>
                        <td>{{ $tag->id }}</td>
                        <td><a href="{{ route('tags.edit', $tag->id) }}">{{ $tag->name }}</a></td>
                        <td>{{ $tag->created_at }}</td>
                        <td>{{ $tag->updated_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <p>
                <nav aria-label="Tags navigation">
                    {{ $tags->links('vendor/pagination/bootstrap-4') }}
                </nav>
            </p>

            @if ($tags->count() == 0)
            <p>...there is no tags</p>
            @endif

        </div>
    </div>
@endsection
