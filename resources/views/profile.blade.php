@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
    <div class="card" style="width: 30rem;">
        <div class="card-body">
            <h4 class="card-title"><i class="fa fa-user-circle-o" aria-hidden="true"></i> {{ $user->name }}</h4>
            <h6 class="card-subtitle mb-2 text-muted">Edit your profile information</h6>
            <p class="card-text">
            <form method="POST" action="{{ route('users.update', Auth::user()->id) }}">
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
                           placeholder="Enter email" value="{{ $user->email }}" required>
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
                    <input type="submit" class="btn btn-primary" value="Edit" data-disable-with="Saving...">
                    <a type="button" class="btn btn-light" role="button" href="{{ route('users.index') }}">
                        Cancel
                    </a>
                </div>
            </form>
            </p>
            <p>
                <a href="{{ route('users.destroy', Auth::user()->id) }}" class="text-danger" rel="nofollow"
                   data-method="delete" data-confirm="Are you sure you want to delete your account?">Delete account</a>
            </p>
        </div>
    </div>
@endsection
