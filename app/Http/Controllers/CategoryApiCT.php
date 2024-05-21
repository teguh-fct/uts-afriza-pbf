<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CategoryCreateRequest;
use App\Http\Requests\Api\CategoryUpdateRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryApiCT extends Controller
{
    public function tambah(CategoryCreateRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $newCategory = Category::create($validatedData);

        return response()->json([
            'data' => $newCategory->toArray()
        ]);
    }

    public function ubah(CategoryUpdateRequest $request, int $id): JsonResponse
    {
        $validatedData = $request->validated();

        try {
            $existingCategory = Category::findOrFail($id);
            $existingCategory->name = $validatedData['name'] ?? $existingCategory->name;
            $existingCategory->update();

            return response()->json([
                'data' => $existingCategory->toArray()
            ]);
        } catch (Exception $e) {
            return response()->json([
                'validation_error' => [
                    'message' => 'Category not found'
                ]
            ], 400);
        }
    }

    public function hapus(int $id): JsonResponse
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return response()->json([
                'message' => 'Successfully deleted'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'validation_error' => [
                    'message' => 'Category not found'
                ]
            ], 400);
        }
    }

    public function ambil(int $id): JsonResponse
    {
        $category = Category::find($id);
        return response()->json([
            'data' => $category ? $category->toArray() : null
        ]);
    }

    public function ambil_semua()
    {
        $allCategories = Category::all();

        return response()->json([
            'data' => $allCategories->toArray()
        ]);
    }
}
