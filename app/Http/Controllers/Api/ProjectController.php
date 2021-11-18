<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use OpenApi\Annotations\Get;
use OpenApi\Annotations\Post;
use Illuminate\Support\Facades\DB;
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
        return ProjectResource::collection(Project::with(['technologies'])->get());
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
        $newProject = $request->validate($this->creteRules());
        try {
              DB::beginTransaction();;
               return new ProjectResource(Project::create($newProject));
              DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
        }


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
        $model = $request->validate($this->updateRules());
        return new ProjectResource($project->update($model));
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

   public function createRules():array
    {
        return [
            'title'         =>'required',
            'description'   =>'required',
            'image_url'     =>'required',
            'github_link'   =>'required',
            'website_link'  =>'required',
        ];
    }

     public function updateRules():array
    {
        return [
            'title'         =>'min:4',
            'description'   =>'min:10',
            'image_url'     =>'min:5|max:50',
            'github_link'   =>'min:5|max:50',
            'website_link'  =>'min:5|max:50',
        ];
    }

}
