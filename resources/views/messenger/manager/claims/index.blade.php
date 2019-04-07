@extends('layouts.app')

@section('content')



    <div class="container">
        <div class="row justify-content-center">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="col-md-4">
                <div class="card">

                        <div class="list-group">
                            @foreach ($paginator as $claim)
                                <a href="#"
                                   class="list-group-item list-group-item-action @if($claim == $paginator->first()) active @endif">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{$claim->user->name}}</h5>
                                        <small>{{$claim->created_at->diffForHumans()}}</small>
                                    </div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <small>{{$claim->theme}}</small>
                                        @if($claim->answered)<span
                                                class="badge badge-primary badge-pill float-left align-self-start">New</span>@endif
                                    </div>
                                </a>
                            @endforeach

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$paginator->first()->theme}}</h5>
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