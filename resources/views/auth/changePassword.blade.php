@extends('layouts.app')

@section('changePassword')
    {{ Form::open(['action' => 'Auth\ChangePasswordController@changePasswordAction', 'class' => 'form-horizontal']) }}
    <div class="col-lg-6 col-lg-offset-3">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading">
                Change your credentials
            </div>
            <div class="panel-body">
                <div class="col-lg-12">
                    <div class="form-group">
                        {{ Form::label('username', 'Username') }}
                        {{ Form::text('username', Auth::user()->name, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('email', 'Email') }}
                        {{ Form::text('email', Auth::user()->email, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('old_password', 'Old password') }}
                        {{ Form::password('old_password', ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('new_password', 'New password') }}
                        {{ Form::password('new_password', ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('repeat_password', 'Repeat new password') }}
                        {{ Form::password('repeat_password', ['class' => 'form-control']) }}
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="pull-right">
                    {{ Form::submit('submit', ['name' => 'submit_password_change','class' => 'btn btn-default']) }}
                </div>
                <div class="clearfix">
                    &nbsp;
                </div>

            </div>
        </div>
    </div>
    {{ Form::close() }}
@endsection