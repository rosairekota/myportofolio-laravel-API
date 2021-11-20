<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Service;
use Illuminate\Http\Request;
use OpenApi\Annotations\Get;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;

class ServiceController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/services",
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
            return ServiceResource::collection(Service::all());
        } catch (\Throwable $th) {
            throw new Exception("Projet introuvable:".$th->getMessage(), 1);
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
        $newService=$request->validate($this->createRules());

        try {
            return new ServiceResource(Service::create($newService));

        } catch (\Throwable $th) {
            throw new Exception("Échec d'enregistrement du projet".$th->getMessage(), 1);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {

        try {
            return new ServiceResource($service);
        } catch (\Throwable $th) {
            throw new Exception("Projet introuvable".$th->getMessage(), 1);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $model=$request->validate($this->updateRules());

        try {
            return new ServiceResource($service->update($model));
        } catch (\Throwable $th) {
            throw new Exception("Échec de mise a jour du projet:".$th->getMessage(), 1);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {

        try {
            return $service->delete($service);
        } catch (\Throwable $th) {
            throw new Exception("Échec de suppression du projet:".$th->getMessage(), 1);
        }
    }
        public function createRules():array
    {
        return [
            'name'           =>'required|min:4|max:20',
            'icon'           =>'required',
            'description'    =>'required|min:10',
        ];
    }
    public function updateRules():array
    {
        return [
            'name'          =>'min:4|max:20',
            'icon'          =>'max:10',
            'description'   =>'min:10',
        ];
    }
}
