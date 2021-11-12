<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use OpenApi\Annotations\Get;
use OpenApi\Annotations\Post;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;


class ProjectController extends Controller
{
      /**
     * @OA\Get(
     *     path="/api/projects",
     *     @OA\Response(response="200", description="Display a listing of projects.")
     * )
     */
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProjectResource::collection(Project::all());
    }

    /**
     * @OA\Post(
     *     path="/api/projects",
     *     requestBody={""},
     *     @OA\Response(response="200", description="Display a listing of projects.")
     * )
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->rules());
        return new ProjectResource(Project::create($request->all()));

    }


   /**
     * @OA\Get(
     *     path="/api/projects/{id}",
     *     parameters="id",
     *     @OA\Response(response="200", description="Display a listing of projects.")
     * )
     */

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
        $request->validate($this->rules());
        return new ProjectResource($project->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
       return new ProjectResource($project->delete($project));
    }

   public function rules():array
    {
        return [
            'title'=>'required',
            'description'=>'required',
            'image_url'=>'required',
            'github_link'=>'required',
            'website_link'=>'required',
        ];
    }

}
