<?php

namespace App\Http\Controllers;

use OpenApi\Annotations\Info;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * @OA\Info(title="My Portofolio API", version="0.1")
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function jsonResponse($action, string $message,string $method):JsonResponse{
        if ($action){
            return response()->json([
                'success' => $message." a été ".$method."avec succès!"
            ],200);
        }
            return response()->json([
                'success' => "Echec de la creation ".$message,
            ]);
    }
}
