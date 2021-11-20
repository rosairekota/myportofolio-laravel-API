<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Technology;
use Illuminate\Http\Request;
use OpenApi\Annotations\Get;
use App\Http\Controllers\Controller;
use App\Http\Resources\TechnologyResource;

class TechnologyController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/technologies",
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
            return TechnologyResource::collection(Technology::with(['projects'])->get());

        }
        catch (\Throwable $th)
        {
            throw new Exception("Échec de la consommations des technologies:".$th->getMessage(), 1);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newTechnology = $request->validate($this->updateRules());

        try {
            return new TechnologyResource(Technology::create($newTechnology));
        } catch (\Throwable $th) {
            throw new Exception("Échec d'enregistrement de la technologie:".$th->getMessage(), 1);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        try {
            return new TechnologyResource($technology->load('projects'));
        } catch (\Throwable $th) {
            throw new Exception("Échec! Technologie introuvable:".$th->getMessage(), 1);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Technology $technology)
    {
        $model = $request->validate($this->updateRules());

        try {

            return new TechnologyResource($technology->update($model));
        } catch (\Throwable $th) {
            throw new Exception("Échec de modification de la technologie:".$th->getMessage(), 1);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {

        try {

            return $technology->delete($technology);
        } catch (\Throwable $th) {
            throw new Exception("Échec de suppression de la technologie:".$th->getMessage(), 1);
        }
    }

    public function createRules():array
    {
        return [
            'name'  =>'required|min:3|max:20',
            'icon'  =>'required|min:3|max:4',
        ];
    }
    public function updateRules():array
    {
        return [
            'name'  =>'|min:3|max:20',
            'icon'  =>'min:3|max:4',
        ];
    }
}
