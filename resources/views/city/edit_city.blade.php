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
                    <form action="/home/city/{{ $city->id }}" method="POST">
                        @csrf
                        {{ method_field('PATCH') }}

                        @include('layouts.alert_success')
                        @include('layouts.alert_error')
                        <div class="form-group">
                            <label for="pwd">Name</label>
                            <textarea name="name" id="name" cols="30" rows="10" class="form-control @error('name') is-invalid @enderror">{{ $city->name }}</textarea>
                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $city }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary float-right">Edit city</button>
                      </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

