@extends('layouts.app')

@section('content')
    //Logic shouldn t be there -_-
    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('manager'))
        @include('manager.home')
    @endif
    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('client'))
        @include('client.home')
    @endif

@endsection
