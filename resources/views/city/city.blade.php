@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Comment</th>
                                <th>User</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ( $comments as $city_comment )
                                <tr>
                                    <td scope="row">{{ $city_comment->comment->comment }}</td>
                                    <td>{{ $city_comment->user->full_name }}</td>
                                    <td>{{ $city_comment->created_at->format('d.m.Y H:i') }}</td>
                                    <td>{{ $city_comment->updated_at->format('d.m.Y H:i') }}</td>

                                    <td>
                                        <a href="/home/city/edit" title="Edit comment">
                                            <i class="fa fa-edit text-info"></i>
                                        </a>
                                        <a href="/admin/city/destroy" title="Delete city">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>
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
