@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @php /** @var \Illuminate\Support\ViewErrorBag $errors*/ @endphp
    @php /** @var Success $errors*/ @endphp
    @if($errors->any())
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    {{$errors->first()}}
                </div>
            </div>
        </div>
    @endif
    @if(session('success'))
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    {{session()->get('success')}}
                </div>
            </div>
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center ">

            <div class="col-md-5">
                <div class="d-flex justify-content-center">
                    <a class="btn btn-outline-primary" href="{{route('client.claims.create')}}">New Claim</a>
                </div>
                <br>
                <div class="list-group">
                <div class="card">


                        @foreach ($paginator as $claim)
                            <a href="#"
                               class="list-group-item list-group-item-action @if($claim == $paginator->first()) active @endif">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Claim {{$claim->created_at->format('d-m-Y')}}</h5>
                                </div>
                                <div class="d-flex w-100 justify-content-between">
                                    <small>{{$claim->theme}}</small>

                                </div>
                            </a>
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card">

                    <form method="post" action="{{route('client.claims.destroy', $paginator->first()->id)}}">
                        @method('PATCH')
                        @csrf
                        <div class="card-body">
                            <h5 class="card-title">{{$paginator->first()->theme}}</h5>
                            <div class="d-flex w-100 justify-content-between">
                                <span class="align-self-center pl-2">{{$paginator->first()->created_at->format('d M H:i')}}</span>
                                <div class="d-flex flex-column">
                                    <footer class="blockquote-footer">{{$paginator->first()->user->name}}</footer>
                                    <span class="mb-1">{{$paginator->first()->user->email}}</span>
                                </div>
                            </div>
                            <div class="card m-4">
                                <div class="card-body">
                                    <p class="card-text">{{$paginator->first()->message}}</p>
                                </div>
                            </div>

                            <div class="btn-group d-flex justify-content-center">

                                    <button type="submit" class="btn btn-primary">Delete</button>

                            </div>

                        </div>
                </div>
            </div>
        </div>
    </div>
    @if($paginator->total() > $paginator->count())
        <br>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="pagination justify-content-center">
                    {{$paginator->links()}}
                </div>
            </div>
        </div>
    @endif

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="{{-- asset('js/claimajax.js') --}}"></script>

@endsection