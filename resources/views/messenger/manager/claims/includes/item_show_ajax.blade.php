<form method="post" action="{{route('manager.claims.update', $item->id)}}">
    @method('PATCH')
    @csrf
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
                        <a href="{{route('manager.uploads.show', $upload->id)}}">{{$upload->fileName()}}</a>
                    @endforeach
                </div>
            </div>
        @endif
        <div class="btn-group d-flex justify-content-center">
            @if(!$item->answered)
                <button type="submit" class="btn btn-primary">Answered</button>
            @else
                <button type="submit" class="btn btn-light">Not answered</button>
        </div>
        @endif

    </div>
</form>


