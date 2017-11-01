@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
    <div class="container">
        <div>
            <h1 class="display-4">Tasks</h1>

            @if (!empty(($tasks[0])))
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    @foreach ($tasks[0] as $key => $item)
                        @if ($key !== 'password' && $key !== 'remember_token')
                            <th>{{ $key }}</th>
                        @endif
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        @foreach ($task as $key => $item)
                            @if ($key === 'id')
                                <th scope="row">{{ $item }}</th>
                            @elseif ($key === 'email')
                                @php
                                    $email = preg_replace('/\w/', '*', $item, 5);
                                @endphp
                                <td>{{ $email }}</td>
                            @elseif ($key !== 'password' && $key !== 'remember_token')
                                <td>{{ $item }}</td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>

                <p>
                    <nav aria-label="Tasks navigation">
                        {{ $tasks->links('vendor/pagination/bootstrap-4') }}
                    </nav>
                </p>

            @else
            <p>...there is no tasks</p>
            @endif

        </div>
    </div>
@endsection
