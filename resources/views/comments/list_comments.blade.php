@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content">
        <a href="/home" class="float-left">
            Return to city list
            <i class="fa fa-arrow-left font-weight-bolder "></i>

        </a>
        <div class="col-md-12">

            <div class="card">

                <div class="card-header">
                    {{ $title }}
                    <form action="" style="margin-top: -25px;">
                    <button type="submit" class="btn btn-primary float-right">Filter</button>
                    <select name="limit_comments" id="limit_comments" class="form-control float-right mr-2" style="width: 200px" value="{{ request()->limit_comments ?? request()->limit_comments }}">
                        <option value="">All comments</option>
                        <option value="10" {{ request()->limit_comments == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ request()->limit_comments == 20 ? 'selected' : '' }}>20</option>
                        <option value="30" {{ request()->limit_comments == 30 ? 'selected' : '' }}>30</option>
                    </select>
                </form>
                </div>

                <div class="card-body">
                    @include('layouts.alert_success')
                    @include('layouts.alert_error')
                    @if($city_comments[0]->comments->count() > 0)
                    <table class="table table-striped table-bordered">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Comment</th>
                                <th>User</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ( $city_comments[0]->comments as $city_comment )
                                <tr>
                                    <td scope="row">{{ $city_comment->comment }}</td>
                                    <td>{{ $city_comment->user->full_name }}</td>
                                    <td>{{ $city_comment->created_at->format('d.m.Y H:i') }}</td>
                                    <td>{{ $city_comment->updated_at->format('d.m.Y H:i') }}</td>

                                    <td>
                                        @if(Auth::user()->id == $city_comment->user_id)
                                        <a href="/home/comments/{{ $city_comment->id }}/edit" title="Edit comment">
                                            <i class="fa fa-edit text-info"></i>
                                        </a>
                                        <a href="/home/comments/destroy" title="Delete comment" onclick="event.preventDefault();
                                        document.getElementById('delete-comment-form').submit();">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>
                                        <form id="delete-comment-form" action="{{ route('comments.destroy', $city_comment->id) }}" method="POST" class="d-none">
                                            {{ method_field('DELETE') }}
                                            @csrf
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                    </table>

                    @else
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>There is no comments for this city.</strong>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
