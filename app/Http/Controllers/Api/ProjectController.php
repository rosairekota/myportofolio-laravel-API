<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use OpenApi\Annotations\Get;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      /**
     * @OA\Get(
     *     path="/projects",
     *     @OA\Response(response="200", description="Display a listing of projects.")
     * )
     */
    public function index()
    {
        return ProjectResource::collection(Project::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       return $this->execute(Project::create($request->all()),"Le project","crée");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return new ProjectResource($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {

        return $this->execute($project->update($request->all()),"Le projet","modifié ");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
       return $this->execute($project->delete($project),"Le projet","supprimé ");
    }



}
