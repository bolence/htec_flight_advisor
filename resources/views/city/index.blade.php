@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}
                    @admin
                    <a class="btn btn-primary float-right ml-2" href="/admin/city/create">
                    <i class="fa fa-city"></i> Add new city
                    </a>
                    @endadmin
                    <form action="" style="margin-top: -25px;">
                        @csrf
                        <a href="/home" class="btn btn-danger float-right ml-2">Reset filter</a>
                        <button type="submit" class="btn btn-primary float-right"> Search city</button>
                        <input type="text" name="search" id="search" class="form-control float-right mr-2" style="width: 200px" placeholder="Enter city name" value="{{ request()->search ?? request()->search }}">
                    </form>
                </div>

                <div class="card-body">
                    @include('layouts.alert_success')
                    @include('layouts.alert_error')
                    <table class="table table-striped table-bordered">
                        <thead class="thead-inverse">
                            <tr>
                                <th>City name</th>
                                <th>City country</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ( $cities as $city )
                                <tr>
                                    <td>{{ $city->name }}</td>
                                    <td>{{ $city->country }}</td>
                                    <td>{{ $city->description }}</td>

                                    <td>
                                        @admin
                                        <a href="/admin/city/{{ $city->id }}/edit" title="Edit city">
                                            <i class="fa fa-edit text-info"></i>
                                        </a>
                                        <a href="/" title="Delete city" onclick="event.preventDefault();
                                        document.getElementById('delete-city-form').submit();"
                                        >
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>

                                        <form id="delete-city-form" action="{{ route('city.destroy', $city->id) }}" method="POST" class="d-none">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                        </form>

                                        @else
                                        <a href="/home/comments/create?id={{ $city->id }}" title="Add comment">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <a href="/home/comments/{{ $city->id }}" title="View comments">
                                            <i class="fa fa-comment"></i>
                                        </a>
                                        ({{ $city->comments_count }})

                                       @endadmin
                                    </td>
                                </tr>
                                @endforeach


                            </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
