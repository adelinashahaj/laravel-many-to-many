<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Str; // <- da importare
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
       // $newProject = new Project();

       $form_data = $request->validated();
       $form_data['slug'] = Project::generateSlug($request->title);

       $checkPost = Project::where('slug', $form_data['slug'])->first();
        if ($checkPost) {
            return back()->withInput()->withErrors(['slug' => 'Impossibile creare lo slug per questo progetto, cambia il titolo']);
        }


        if($request->hasFile('cover_image')) {
            $path= Storage::put('cover', $request->cover_image);
            $form_data['cover_image']=$path;
        }

       $newProject = Project::create($form_data);
       // $newProject->fill($form_data);
        //$newProject->save();

//prende l'id di project e lo unisce con l'id di technologies e fa una verifica
        if ($request->has('technologies')) {
            $newProject->technologies()->attach($request->technologies);
        }

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
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
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
            return back()->withInput()->withErrors(['slug' => 'Impossibile creare lo slug per questo project, cambia il titolo']);
        }

//verifica se nell request c'e l'immagine se si cancella altrimmenti aggungi
        if($request->hasFile('cover_image')) {
               //cancella
            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }
                // aggungi
            $path= Storage::put('cover', $request->cover_image);
            $form_data['cover_image'] = $path;
        }


//prende l'id di project e lo unisce con l'id di technologies
        $project->technologies()->sync($request->technologies);

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
        if ($project->cover_image){
            Storage::delete($project->cover_image);
        }
        
        $project->delete();
        return redirect()->route('admin.projects.index');
    }
}
