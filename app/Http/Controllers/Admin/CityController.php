<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Http\Requests\CityRequest;
use App\Http\Controllers\Controller;
use Exception;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request()->search;
        $limit_comments = (int) request()->limit_comments;

        $cities = City::when($search, function($q) use($search) {
            return $q->whereName($search);
        })
        ->withCount('comments')
        ->get();

        return view('city.index', compact('cities'))
                ->with(['title' => 'Cities listing']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('city.add_city_form')
                ->with(['title' => 'Add city form']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {

        City::create($request->validated());

        return redirect('/admin/city/create')
                ->withSuccess('City successfully saved.');
    }

    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::findOrFail($id);
        return view('city.edit_city', compact('city'))
                ->with(['title' => 'Edit city ' . $city->name]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, $id)
    {
        $city = City::find($id);
        $city->fill($request->validated());
        $city->push();

        return redirect('/admin/city')
                ->withSuccess('City was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::findOrFail($id);

        try
        {
            $city->delete();
            $city->comments()->delete();
        }
        catch (Exception $e)
        {
            return redirect('/admin/city')->with(['error' => 'Error occured while deleting ' . $e->getMessage()]);
        }

        return redirect('/admin/city')
                ->withSuccess('City successfully deleted');
    }
}
