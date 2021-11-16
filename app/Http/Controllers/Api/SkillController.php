<?php

namespace App\Http\Controllers\Api;

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
        return SkillResource::collection(Skill::all());
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
        return new SkillResource(Skill::create($newSkill));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {
        return new SkillResource($skill);
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
        return new SkillResource($skill->update($model));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        return $skill->delete($skill);
    }

    public function createRules():array
    {
        return [
            'name'=>'required|min:3|max:20',
            'progress'=>'required|max:5',
        ];
    }
    public function updateRules():array
    {
        return [
            'name'=>'min:3|max:20',
            'progress'=>'max:5',
        ];
    }

}
