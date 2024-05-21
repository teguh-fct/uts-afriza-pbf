<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductCreateRequest;
use App\Http\Requests\Api\ProductUpdateRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class ProductApiCT extends Controller
{
    private function simpan(UploadedFile $file): string
    {
        $directory = 'uploads/images/products';
        $fullPath = public_path($directory);
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($fullPath, $fileName);

        return "{$directory}/{$fileName}";
    }

    private function hapus(Product $product): bool
    {
        $imagePath = public_path($product->image);
        if (!file_exists($imagePath)) {
            return false;
        }
        return unlink($imagePath);
    }

    public function tambah(ProductCreateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['modified_by'] = Auth::user()->email;

        $file = $request->file('image');
        $data['image'] = $this->simpan($file);

        $product = Product::create($data);

        return response()->json([
            'status' => true,
            'model' => $product->toArray()
        ], 200);
    }

    public function ubah(ProductUpdateRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();
        $data['modified_by'] = Auth::user()->email;
        $file = $request->file('image');

        try {
            $product = Product::findOrFail($id);

            $this->hapus($product);
            $data['image'] = $this->simpan($file);

            $product->update($data);

            return response()->json([
                'data' => $product->toArray()
            ]);
        } catch (Exception) {
            return response()->json([
                'validation_error' => [
                    'message' => 'Product not found'
                ]
            ], 400);
        }
    }

    public function ambil_semua(): JsonResponse
    {
        $products = Product::all();

        return response()->json([
            'status' => true,
            'model' => $products->toArray()
        ]);
    }

    public function ambil(int $id): JsonResponse
    {
        $product = Product::find($id);

        return response()->json([
            'data' => $product ? $product->toArray() : null
        ]);
    }

    public function hapuss(int $id): JsonResponse
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            return response()->json([
                'status' => true
            ]);
        } catch (Exception) {
            return response()->json([
                'validation_error' => [
                    'message' => 'Product not found'
                ]
            ], 400);
        }
    }
}
