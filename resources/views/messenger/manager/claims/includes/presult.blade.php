
<table class="table table-bordered">
    <thead>
    <tr>
        <th width="100px">ID</th>
        <th>Name</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($paginator as $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->theme }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

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

