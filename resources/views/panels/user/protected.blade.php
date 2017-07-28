@extends('layouts.main')

@section('head')

@stop

@section('content')

    <h2>Protected Page</h2>

    <p>This page is protected by <code>activated</code> middleware. Only accounts with activated emails are able pass this middleware. </p>

@stop