@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                    <center>@include('partials.status-panel')</center>
                    <div class="panel-body">
                        You are logged in!
                    </div>
                </div>

                <h4> Update User</h4>

                <center>@include('partials.messages')</center>

                {{ Form::model(Auth::user(), array('route' => array('updateUser', Auth::user()->id))) }}

                {{csrf_field()}}

                {{ Form::label('Name', null, ['class' => 'col-md-3 control-label', 'styles' => 'margin-top:20px']) }}

                {{ Form::text('name',Auth::user()->name, ['class' => 'form-control']) }}

                {{ Form::label('Email', null, ['class' => 'col-md-2 control-label']) }}

                {{ Form::text('email', Auth::user()->email, ['class' => 'form-control']) }}

                {{ Form::label('password', null, ['class' => 'col-md-3 control-label']) }}

                {{ Form::password('password', ['class' => 'form-control']) }}

                {{ Form::label('password_confirmation', null, ['class' => 'col-md-5 control-label']) }}

                {{ Form::password('password_confirmation', ['class' => 'form-control']) }}

                <button style="margin-top:20px" type="submit" class="btn btn-default radius-button-dark">Edit user</button>

                {{Form::close()}}

            </div>
        </div>
    </div>
@endsection
