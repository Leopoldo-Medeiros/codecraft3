<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $query = Permission::query();

        if ($request->has('status')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $permissions = $query->paginate(10);

        return response()->json($permissions);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        $permission = Permission::create($validated);

        return response()->json($permission, 201);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $permission = Permission::findOrFail($id);
        return response()->json($permission);
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        $permission = Permission::findOrFail($id);
        $permission->update($validated);

        return response()->json($permission);
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return response()->json(null, 204);
    }
}