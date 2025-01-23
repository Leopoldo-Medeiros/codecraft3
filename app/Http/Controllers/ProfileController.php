<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 10);
        $profiles = Profile::paginate($perPage);

        return response()->json([
            'data' => $profiles->items(),
            'meta' => [
                'current_page' => $profiles->currentPage(),
                'last_page' => $profiles->lastPage(),
                'per_page' => $profiles->perPage(),
                'total' => $profiles->total(),
            ]
        ], 200);
    }

    public function show($id): JsonResponse
    {
        $profile = Profile::findOrFail($id);
        return response()->json(['data' => $profile], 200);
    }

    public function store(ProfileRequest $request): JsonResponse
    {
        try {
            $profile = Profile::create($request->validated());

            return response()->json([
                'message' => 'Perfil criado com sucesso',
                'data' => $profile
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao criar o perfil.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    // TODO: Fazer testes unitaarios para os metodos update e destroy
    public function update(Request $request, $id): JsonResponse
    {
        $profile = Profile::findOrFail($id);

        $profile->update($request->all());

        return response()->json(['message'=> 'Profile updated successfully', 'data' => $profile], 200);
    }

    public function destroy($id): JsonResponse
    {
        $profile = Profile::findOrFail($id);

        $profile->delete();

        return response()->json(['message'=>'Profile deleted successfully'], 200);
    }
}
