<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\CityComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $city = City::findOrFail((int)$request->get('id'));
        $city_id = $city->id;
        return view('comments.add_comments', compact('city_id'))
                ->with(['title' => 'Add comment for ' . $city->name]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {

        CityComment::create($request->only('city_id', 'comment'));
        return redirect('/home')
                ->withSuccess('Comment successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $limit = request()->limit_comments;
        $city_comments = City::with(['comments' => function($q) use($limit) {
            $q->limit($limit);
        }])
        ->whereId($id)
        ->get();

        return view('comments.list_comments', compact('city_comments'))
                ->with(['title' => 'Comments for ' . $city_comments[0]->name]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = CityComment::with('user', 'city')->findOrFail($id);
        return view('comments.edit_comments', compact('comment'))
                ->with(['title' => 'Edit comment for ' . $comment->city->name]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, $id)
    {
        $comment = CityComment::find($id);
        try {
            $comment->fill($request->only('comment', 'user_id', 'city_id'));
            $comment->push();
        } catch (\Throwable $th) {
            info($th->getMessage());
            return redirect("/home/comments/" . $comment->city->id)
                    ->with(['error' => 'We are unable to edit comment.']);
        }


        return redirect("/home/comments/" . $comment->city->id)
                ->withSuccess('City comment successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = CityComment::findOrFail($id);

        if($comment->user_id != Auth::id())
        {
            return redirect("/home/comments/$id")
                    ->with(['error' => 'Forbidden to delete comment which is not your.']);
        }

        try
        {
            $comment->delete();
        }
        catch (\Throwable $th)
        {
            info($th->getMessage());
            return redirect("/home/comments/$id")
                    ->with(['error' => 'We are unable to delete comment.']);
        }

        return redirect("/home")
                ->withSuccess('City comment successfully deleted.');
    }
}
