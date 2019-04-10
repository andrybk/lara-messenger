@extends('layouts.app')

@php
    /** @var \App\Models\Claim $item */
@endphp
@section('content')

    <form method="post" action="{{route('client.claims.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">New Claim</h5>
                            <div class="form-group">
                                <label for="theme">Theme</label>
                                <input type="text" value=""
                                       name="theme"
                                       id="theme"
                                       class="form-control"
                                       minlength="3"
                                       maxlength="200"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea name="message"
                                          id="message"
                                          rows="3"
                                          class="form-control">{{old('description')}}</textarea>
                            </div>
                            {{--TODO: Make field larger or remove default button--}}
                            <div class="form-group">
                                <label for="upload">Attachment</label>
                                <input type="file" name="upload" class="form-control">
                                <br>
                            </div>

                            <div class="row d-flex justify-content-end pr-4">
                                <div class="btn-group-toggle">
                                    <button type="submit" class="btn btn-lg btn-primary">Send</button>
                                    <a ref="#" class="btn btn-lg btn-light">Cancel</a>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>

    <script type="text/javascript">

        $(document).ready(function () {

            $(".btn-success").click(function () {
                var html = $(".clone").html();
                $(".increment").after(html);
            });

            $("body").on("click", ".btn-danger", function () {
                $(this).parents(".control-group").remove();
            });

        });

    </script>

@endsection