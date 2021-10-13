@extends('layouts.app')


@section('content')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">
                    <form action="/home/comments" method="POST">
                        @csrf
                        <input type="hidden" name="city_id" value="{{ $city_id }}">

                        @include('layouts.alert_success')
                        @include('layouts.alert_error')

                        @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="pwd">Comment</label>
                            <textarea name="comment" id="comment" cols="30" rows="10" class="form-control @error('comment') is-invalid @enderror"></textarea>
                            @error('comment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>

                        <button type="submit" class="btn btn-primary float-right">Save comment</button>
                      </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

