@extends('layouts.app')

@php
    /** @var \App\Models\Claim $item */
@endphp
@section('content')
    @if($item->exists)
        <form method="post" action="{{route('blog.admin.categories.update', $item->id)}}">
            @method('PATCH')

            @else
                <form method="post" action="{{route('blog.admin.categories.store')}}">

                    @endif
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#maindata"
                                                   role="tab">Main data</a>
                                            </li>
                                        </ul>
                                        <br>

                                        <div class="tab-content">
                                            <div class="tab-pane active" id="maindata" role="tabpanel">
                                                <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" value="{{$item->title}}"
                                                           name="title"
                                                           id="title"
                                                           class="form-control"
                                                           minlength="3"
                                                           required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="slug">Slug</label>
                                                    <input type="text" value="{{$item->slug}}"
                                                           name="slug"
                                                           id="slug"
                                                           class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="parent_id">Parent</label>
                                                    <select name="parent_id"
                                                            id="parent_id"
                                                            class="form-control"
                                                            placeholder="Choose category..."
                                                            required>
                                                        @foreach($categoryList as $categoryOption)
                                                            <option value="{{$categoryOption->id}}"
                                                                    @if($categoryOption->id == $item->parent_id) selected @endif>
                                                                {{$categoryOption->id_title}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea name="description"
                                                              id="description"
                                                              rows="3"
                                                              class="form-control">{{old('description', $item->description)}}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>

@endsection