@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
    <div class="card" style="width: 30rem;">
        <div class="card-body">
            <h4 class="card-title"><i class="fa fa-user-circle-o" aria-hidden="true"></i> {{ $user->name }}</h4>
            <h6 class="card-subtitle mb-2 text-muted">Edit your profile information</h6>
            <p class="card-text">
            <form method="POST" action="{{ route('user.update', Auth::user()->id) }}">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                           placeholder="Enter email" value="{{ $user->email }}" required autofocus>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>

                    @if ($errors->has('email'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                    <a type="button" class="btn btn-light" role="button" href="{{ route('user.index') }}">
                        Cancel
                    </a>
                </div>
            </form>

            <form method="POST" id="delete-form" action="{{ route('user.destroy', Auth::user()->id) }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <p>
                    <a href="#" class="text-danger"
                       onclick="document.getElementById('delete-form').submit();">Delete account
                    </a>
                </p>
            </form>

            </p>
        </div>
    </div>
@endsection
