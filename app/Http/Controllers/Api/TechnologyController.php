<?php

namespace App\Http\Controllers\Api;

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
        return TechnologyResource::collection(Technology::all());
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
        return new TechnologyResource(Technology::create($newTechnology));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {

        return new TechnologyResource($technology);
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
        return new TechnologyResource($technology->update($model));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        return $technology->delete($technology);
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
