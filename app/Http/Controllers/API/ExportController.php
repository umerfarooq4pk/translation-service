<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/translations/export",
     *     summary="Get all translations to export",
     *     tags={"export translation"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="array", @OA\Items(type="object"))
     *         )
     *     )
     * )
     */
    public function export(Request $request)
    {
        $translations = Cache::remember('translations', now()->addMinutes(5), function () {
            return Translation::all(['key', 'content', 'locale']);
        });

        return response()->json($translations);
    }
}
