<?php

namespace App\Http\Controllers\Api;

use Exception;
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

        try {
            return ProjectResource::collection(Project::with(['technologies','categories'])->get());

        } catch (\Throwable $th) {
            throw new Exception("erreur lors de la consommation des projets", 1);
        }
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
        try
        {
            return new ProjectResource($project->load(['technologies','categories']));

        } catch (\Throwable $th) {
            throw new Exception("Projet introuvable", 1);
        }

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

        try
        {
            return new ProjectResource($project->update($model));

        } catch (\Throwable $th) {
            throw new Exception("Projet introuvable", 1);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {

        try {
            return $project->delete($project);
        } catch (\Throwable $th) {
            throw new Exception("Projet introuvable".$th->getMessage(), 1);
        }
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
