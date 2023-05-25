<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Support\Str; // <- da importare
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $newProject = new Project();


       $form_data = $request->validated();
       $form_data['slug'] = Project::generateSlug($request->title);

       $checkPost = Project::where('slug', $form_data['slug'])->first();
        if ($checkPost) {
            return back()->withInput()->withErrors(['slug' => 'Impossibile creare lo slug per questo post, cambia il titolo']);
        }

       $newProject = Project::create($form_data);
       // $newProject->fill($form_data);
        //$newProject->save();

        return redirect()->route('admin.projects.show', ['project' => $newProject->slug])->with('status', 'Project creato con successo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {

        //$project = Project::findOrFail($id);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $form_data = $request->validated();
        $form_data['slug'] = Project::generateSlug($request->title);

        $checkPost = Project::where('slug', $form_data['slug'])->where('id', '<>', $project->id)->first();
        if ($checkPost) {
            return back()->withInput()->withErrors(['slug' => 'Impossibile creare lo slug per questo post, cambia il titolo']);
        }
        $project->update($form_data);
        //return redirect()->route('pastas.show', ['pasta' => $pasta->id]);
        return to_route('admin.projects.show', ['project' => $project->slug])->with('status', 'Formato di prggetto aggiornato!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index');
    }
}
