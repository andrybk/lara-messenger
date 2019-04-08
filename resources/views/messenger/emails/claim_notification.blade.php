<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <main class="py-4">
        <div class="card-body">
            <h5 class="card-title">{{$item->theme}}</h5>
            <div class="d-flex w-100 justify-content-between">
                <span class="align-self-center pl-2">{{$item->created_at->format('d M H:i')}}</span>
                <div class="d-flex flex-column">
                    <footer class="blockquote-footer">{{$item->user->name}}</footer>
                    <span class="mb-1">{{$item->user->email}}</span>
                </div>
            </div>
            <div class="card m-4">
                <div class="card-body">
                    <p class="card-text">{{$item->message}}</p>
                </div>
            </div>
            @if($item->uploads()->count() > 0)
                <div class="card m-4">
                    <div class="card-body">
                        <div class="card-title">Attachments</div>
                        @foreach($item->uploads as $upload)
                            <span>{{$upload->fileName()}}</span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </main>
</div>
</body>
</html>


