@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                    <center>@include('partials.status-panel')</center>
                    <div class="panel-body">
                        Stripe Plans
                    </div>
                    <div class="panel-body">
                        <div class="bs-example" data-example-id="thumbnails-with-custom-content">
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                        <div class="caption">
                                            <h3>Basic</h3>
                                            <h4>20$ per Month</h4>
                                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                            @include('partials.stripe')
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                        <div class="caption">
                                            <h3>Montly</h3>
                                            <h4>40$</h4>
                                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                            @include('partials.stripe')
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                        <div class="caption">
                                            <h3>Yearly</h3>
                                            <h4>60$</h4>
                                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                            @include('partials.stripe')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

                <button style="margin-top:20px; margin-bottom: 20px" type="submit" class="btn btn-default radius-button-dark">Edit user</button>

                {{Form::close()}}
            </div>
        </div>
    </div>
    <script src="https://js.stripe.com/v3/"></script>
@endsection
