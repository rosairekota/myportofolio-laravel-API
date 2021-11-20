<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/categories",
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
            return CategoryResource::collection(Category::with(['projects'])->get());

        } catch (\Throwable $th) {
            throw new Exception("erreur lors de la consommation des categories", 1);
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
        $newCategory=$request->validate($this->createRules());
        try {
            return new CategoryResource(Category::create($newCategory));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

        try {
            return new CategoryResource($category);

        } catch (\Throwable $th) {
            throw new Exception("ressource introuvable !");
        };
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $model=$request->validate($this->createRules());
        try {
            return new CategoryResource($category->update($model));

        } catch (\Throwable $th) {
            throw new Exception("Échec de mise a jour !");
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        try {
            return $category->delete($category);

        } catch (\Throwable $th) {
            throw new Exception("Échec de mise a jour !");
        }

    }
    /**
     * @return Array
     */
    public function createRules():array
    {
        return [
            'title'=>'required|min:5',
        ];
    }
    /**
     * @return Array
     */
    public function updateRules():array
    {
        return [
            'title'=>'min:5',
        ];
    }

}
