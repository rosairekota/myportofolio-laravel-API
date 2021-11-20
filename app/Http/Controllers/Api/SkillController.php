<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Skill;
use App\Models\Technology;
use Illuminate\Http\Request;
use OpenApi\Annotations\Get;
use App\Http\Controllers\Controller;
use App\Http\Resources\SkillResource;
use App\Http\Resources\TechnologyResource;

class SkillController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/skills",
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
            return SkillResource::collection(Skill::all());
        } catch (\Throwable $th) {
            throw new Exception("Échec de la consommations des competences:".$th->getMessage(), 1);
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
        $newSkill = $request->validate($this->createRules());

        try {
            return new SkillResource(Skill::create($newSkill));
        } catch (\Throwable $th) {
            throw new Exception("Échec d'enregistrement de la competence:".$th->getMessage(), 1);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {

        try {
            return new SkillResource($skill);
        } catch (\Throwable $th) {
            throw new Exception("Ce competence est introuvable:".$th->getMessage(), 1);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skill $skill)
    {
        $model = $request->validate($this->updateRules);

        try {
            return new SkillResource($skill->update($model));
        } catch (\Throwable $th) {
            throw new Exception("Échec de mise a jour de la competence:".$th->getMessage(), 1);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {

        try {
            return $skill->delete($skill);
        } catch (\Throwable $th) {
            throw new Exception("Échec de suppression de la competence:".$th->getMessage(), 1);
        }

    }

    public function createRules():array
    {
        return [
            'name'      =>'required|min:3|max:20',
            'progress'  =>'required|max:5',
        ];
    }
    public function updateRules():array
    {
        return [
            'name'      =>'min:3|max:20',
            'progress'  =>'max:5',
        ];
    }

}
