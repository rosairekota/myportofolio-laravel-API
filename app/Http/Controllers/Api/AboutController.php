<?php

namespace App\Http\Controllers\Api;

use App\Models\About;
use Illuminate\Http\Request;
use OpenApi\Annotations\Get;
use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;

class AboutController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/abouts",
     *     @OA\Response(response="200", description="Display a listing of abouts.")
     * )
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AboutResource::collection(About::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newabout=$request->validate($this->createRules());
        return new AboutResource(About::create($newabout));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        return new AboutResource($about);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $model)
    {
        $about=$request->validate($this->updateRules());
        return new AboutResource($model->update($about));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        return $about->delete($about);
    }


    /**
     * @return Array
     */
    public function createRules():array
    {
        return [
            'firstname'=>'required|max:20',
            'lastname'=>'required|max:20',
            'middlename'=>'required|max:20',
            'description'=>'required',
            'github_link'=>'required|max:50',
            'linkedin_link'=>'required|max:50',
            'twitter_link'=>'required|max:50',
            'email'=>'required|max:20',
            'phone'=>'required|max:13',
            'address'=>'required',
        ];
    }
    /**
     * @return Array
     */
    public function updateRules():array
    {
         return [
            'firstname'=>'max:20',
            'lastname'=>'max:20',
            'middlename'=>'max:20',
            'description'=>'required',
            'github_link'=>'max:50',
            'linkedin_link'=>'max:50',
            'twitter_link'=>'max:50',
            'email'=>'max:20',
            'phone'=>'max:13',
            'address'=>'max:200',
        ];
    }
}
