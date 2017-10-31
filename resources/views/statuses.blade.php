@extends('layouts.app')

@section('title', 'Statuses')

@section('statusesIsActive', 'active')

@section('content')
    <div class="container">
        <div>
            <h1 class="display-4">Statuses</h1>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if (!empty(($statuses[0])))
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    @foreach ($statuses[0] as $key => $item)
                        <th>{{ $key }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach ($statuses as $status)
                    <tr>
                        @foreach ($status as $key => $item)
                            @if ($key === 'id')
                                <th scope="row">{{ $item }}</th>
                            @else
                                <td>{{ $item }}</td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>

            <p>
                <nav aria-label="Users navigation">
                    {{ $statuses->links() }}
                </nav>
            </p>

            @else
            <p>...there is no statuses</p>
            @endif

        </div>
    </div>
@endsection
