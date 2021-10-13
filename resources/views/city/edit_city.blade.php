@extends('layouts.app')


@section('content')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}
                    <a href="/admin/city" class="float-right">
                        Return to city list
                        <i class="fa fa-arrow-left font-weight-bolder "></i>
                    </a>
                </div>

                <div class="card-body">
                    <form action="/admin/city/{{ $city->id }}" method="POST">
                        @csrf
                        {{ method_field('PATCH') }}
                        @include('layouts.alert_error')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $city->name }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="country">Country</label>
                            <input name="country" id="country" class="form-control @error('country') is-invalid @enderror" value="{{ $city->country }}">
                            @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="20" rows="6" class="form-control @error('description') is-invalid @enderror">{{ $city->description }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary float-right">Update city</button>
                      </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

