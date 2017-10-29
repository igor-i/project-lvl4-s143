@extends('layouts.app')

@section('content')
    <div class="card" style="width: 30rem;">
        <div class="card-body">
            <h4 class="card-title">Login</h4>
            <h6 class="card-subtitle mb-2 text-muted">Sign in to a different account</h6>
            <p class="card-text">
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                           placeholder="Enter email" value="{{ old('email') }}" required autofocus>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            Remember Me
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a class="btn btn-link" href="{{ route('password.request') }}">Forgot Your Password?</a>
                </div>

            </form>
            </p>
        </div>
    </div>
@endsection
