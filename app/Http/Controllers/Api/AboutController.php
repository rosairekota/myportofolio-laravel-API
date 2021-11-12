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
        $request->validate($this->rules());
        return new AboutResource(About::create($request->all()));
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
    public function update(Request $request, About $about)
    {
        $request->validate($this->rules());
        return new AboutResource($about->update($request->all()));
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
    public function rules():array
    {
        return [
            'firstname'=>'required',
            'lastname'=>'required',
            'middlename'=>'required',
            'description'=>'required',
            'github_link'=>'required',
            'linkedin_link'=>'required',
            'twitter_link'=>'required',
            'email'=>'required',
            'phone'=>'required|max:13',
            'address'=>'required',
        ];
    }
}
