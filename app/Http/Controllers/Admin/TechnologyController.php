<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Support\Str; // <- da importare
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologies = Technology::all();
        $projects = Project::all();
        return view('admin.technologies.index', compact('technologies', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.technologies.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTechnologyRequest $request)
    {
        $newTechnology = new Technology();



        $form_data = $request->validated();
       $form_data['slug'] = Technology::generateSlug($request->name);

       $checkPost = Technology::where('slug', $form_data['slug'])->first();
        if ($checkPost) {
            return back()->withInput()->withErrors(['slug' => 'Impossibile creare lo slug per questo progetto, cambia il titolo']);
        }

       $newTechnology = Technology::create($form_data);


       if ($request->has('technologies')) {
        $newTechnology->technologies()->attach($request->technologies);
    }

    return redirect()->route('admin.technologies.index', ['technology' => $newTechnology->slug])->with('status', 'Technology creato con successo!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        $projects = Project::all();
        $technologies= Technology::all();
        return view('admin.technologies.index', compact('technologies','projects' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {

        return view('admin.technologies.edit', compact('technology', ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        $form_data = $request->validated();
        $form_data['slug'] = Technology::generateSlug($request->name);

        $checkPost = Technology::where('slug', $form_data['slug'])->where('id', '<>', $technology->id)->first();
        if ($checkPost) {
            return back()->withInput()->withErrors(['slug' => 'Impossibile creare lo slug per questo post, cambia il titolo']);
        }



        $technology->update($form_data);
        //return redirect()->route('pastas.show', ['pasta' => $pasta->id]);
        return to_route('admin.technologies.index', ['technology' => $technology->slug])->with('status', 'Formato di prggetto aggiornato!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();

        return redirect()->route('admin.technologies.index');
    }
}
