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
        <div class="col-md-5">

        </div>

        <br>
        <div class="d-flex align-items-center justify-content-center">

            <div class="col-md-5">
                <nav class="navbar navbar-toggleable-md navbar-light bg-faded d-flex justify-content-center ">
                    @if(\Illuminate\Support\Facades\Auth::user()->canClaim())
                        <a class="btn btn-outline-primary" href="{{route('client.claims.create')}}">New Claim</a>
                    @else
                        <a class="btn btn-outline-primary disabled" href="#">
                        <span data-time="{{\Illuminate\Support\Facades\Auth::user()->waitFor()}}" id="countdown"
                              class="timer">
                            {{\Illuminate\Support\Carbon::create()->addSeconds(\Illuminate\Support\Facades\Auth::user()->waitFor())->format('H:i:s')}}
                        </span>
                        </a>
                    @endif
                </nav>
                <div class="list-group">
                    <div class="card">


                        @foreach ($paginator as $claim)
                            <a href="{{route('client.claims.show', $claim->id)}}"
                               class="list-group-item list-group-item-action @if($claim == $paginator->first()) active @endif">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{\Illuminate\Support\Str::limit($claim->theme, 30)}}</h5>
                                </div>
                                <div class="d-flex w-100 justify-content-between">
                                    <small>{{\Illuminate\Support\Str::limit($claim->message, 100)}}</small>
                                </div>
                            </a>
                        @endforeach

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
            </div>
            <div class="col-md-7 @if($paginator->count() == 0) d-none @endif">
                <div class="card" id="tag_container">

                    @include('messenger.client.claims.includes.item_show_ajax')

                </div>
            </div>
        </div>
    </div>


    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="{{ asset('js/claimajax.js') }}"></script>
    {{--TODO: canClaim should be realized as middleware, if yes how to handle it for blade?--}}
    @if(!(\Illuminate\Support\Facades\Auth::user()->canClaim()))
        <script src="{{ asset('js/timer.js') }}"></script>
    @endif
@endsection