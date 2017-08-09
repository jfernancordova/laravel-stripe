<!DOCTYPE html>
<html>
<head>
    <title>Your Account is not activated.</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
            font-family: 'Lato', sans-serif;
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 72px;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
<div style="color: black!important;" class="container">
    <div class="content">
        <center>@include('partials.above-navbar-alert')</center>
        <br>
        @if(!Auth::user()->activated)
            <div class="title">Your Account is not activated.</div>
        @else
            <div class="title">Your Account is activated.<br>
                <a href="{{route('profileUser')}}">Visit your profile.</a>
            </div>
        @endif
    </div>
</div>
</body>
</html>
