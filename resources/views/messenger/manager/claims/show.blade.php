@extends('layouts.app')

@php /** @var \App\Models\Claim $item */@endphp

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Claim</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{$item->theme}}</h6>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="card-link">Card link</a>

                </div>
            </div>
        </div>
@endsection