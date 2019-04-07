@extends('layouts.app')

@section('content')
    //Logic shouldn t be there -_-
    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('manager'))
        @include('messenger.manager.claims.index')
    @endif
    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('client'))
        @include('messenger.client.home')
    @endif

@endsection
