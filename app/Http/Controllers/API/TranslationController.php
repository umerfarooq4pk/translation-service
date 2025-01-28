<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Translation;
/**
 * @OA\Info(
 *     title="Translation Service API",
 *     version="1.0",
 *     description="API documentation for Translation Service API application."
 * )
 */
class TranslationController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/translations/export",
     *     summary="Get all translations",
     *     tags={"get translation"},
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
    public function index(Request $request)
    {
        $query = Translation::query();

        if ($request->has('tags')) {
            $query->whereJsonContains('tags', $request->input('tags'));
        }

        if ($request->has('locale')) {
            $query->where('locale', $request->input('locale'));
        }

        if ($request->has('key')) {
            $query->where('key', 'LIKE', "%{$request->input('key')}%");
        }

        return response()->json($query->paginate(10));
    }

    /**
     * @OA\Store(
     *     path="/api/translations",
     *     summary="create new translation record",
     *     tags={"create translation"},
     *     @OA\Response(
     *         response=201,
     *         description="new translation record created",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="array", @OA\Items(type="object"))
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:255',
            'content' => 'required|string',
            'locale' => 'required|string|max:10',
            'tags' => 'nullable|array',
        ]);

        $translation = Translation::create($validated);

        return response()->json($translation, 201);
    }

    /**
     * @OA\Update(
     *     path="/api/translations/{record}",
     *     summary="update translation record",
     *     tags={"update translation"},
     *      @OA\Parameter(
     *         name="record",
     *         in="path",
     *         description="ID of the translation record to update",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Translation record updated"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Translation record not found"
     *     )
     * )
     */
    public function update(Request $request, Translation $translation)
    {
        $validated = $request->validate([
            'content' => 'sometimes|string',
            'tags' => 'nullable|array',
        ]);

        $translation->update($validated);

        return response()->json($translation);
    }

    /**
     * @OA\Delete(
     *     path="/api/translations/{record}",
     *     summary="Delete translation record",
     *     tags={"delete translation"},
     *     @OA\Parameter(
     *         name="record",
     *         in="path",
     *         description="ID of the translation record to delete",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Translation record deleted"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Translation record not found"
     *     )
     * )
     */
    public function destroy(Translation $translation)
    {
        $translation->delete();

        return response()->noContent();
    }
}
