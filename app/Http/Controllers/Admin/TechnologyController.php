<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technology;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->query('search')){
            $technologies = Technology::where('name', 'like', '%' . $request->query('search') . '%')->get();
        }else{
            $technologies = Technology::all();
        }

        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        $formData = $request->validated();
        $slug = Str::slug($formData['name'], '-');
        $formData['slug'] = $slug;

        Technology::create($formData);
        return redirect()->route('admin.technologies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        $formData = $request->validated();
        $slug = Str::slug($formData['name'], '-');
        $formData['slug'] = $slug;

        $technology->update($formData);
        return to_route('admin.technologies.show', $technology);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return to_route('admin.technologies.index')->with('message', "Technology $technology->name deleted");
    }
}
