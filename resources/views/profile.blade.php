@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
    <div class="card" style="width: 30rem;">
        <div class="card-body">
            <h4 class="card-title"><i class="fa fa-user-circle-o" aria-hidden="true"></i> {{ $user->name }}</h4>
            <h6 class="card-subtitle mb-2 text-muted">Edit your profile information</h6>
            <p class="card-text">

            {!! Form::model($user, ['route' => ['users.update', Auth::user()->id], 'method' => 'patch']) !!}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', $user->name, ['class' => 'form-control', 'required', 'autofocus']) !!}

                    @if ($errors->has('name'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                    {!! Form::label('email', 'Email address') !!}
                    {!! Form::text(
                            'email',
                            $user->email,
                            ['class' => 'form-control', 'aria-describedby' => 'emailHelp', 'placeholder' => 'Enter email', 'required']
                        )
                    !!}
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>

                    @if ($errors->has('email'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'required']) !!}

                    @if ($errors->has('password'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">

                    {!! Form::label('password_confirmation', 'Confirm Password') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Password', 'required']) !!}

                </div>

                <div class="form-group">

                    {!! Form::submit('Edit', ['class' => 'btn btn-primary', 'data-disable-with' => 'Saving...']) !!}
                    {!! link_to_route(
                        'users.index',
                        $title = 'Cancel',
                        $parameters = [],
                        $attributes = ['class' => 'btn btn-light', 'type' => 'button', 'role' => 'button']) !!}
                </div>

            </p>
            <p>
                <a href="{{ route('users.destroy', Auth::user()->id) }}" class="text-danger" rel="nofollow"
                   data-method="delete" data-confirm="Are you sure you want to delete your account?">Delete account</a>
            </p>
        </div>
    </div>
@endsection
