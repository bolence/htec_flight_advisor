@extends('layouts.app')


@section('content')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">
                    <form action="/admin/import" method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="">Import file</label>
                          <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror">
                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Import dataset</button>
                      </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@endsection
