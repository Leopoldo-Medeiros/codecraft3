<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest; // Importa o UserRequest para validação
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Exibe todos os usuários com perfil e permissões associados
    public function index()
    {
        // Inclui perfil e permissões na resposta
        return User::with('profile', 'permissions')->get();
    }

    // Cria um novo usuário
    public function store(UserRequest $request)
    {
        // Obtém os dados validados do UserRequest
        $validated = $request->validated();

        // Cria o usuário com os dados validados
        $user = User::create([
            'name' => $validated['fullname'],  // Mapeia 'fullname' para o atributo 'name' do usuário
            'email' => $validated['email'],
            'password' => $validated['password'],  // A senha já está criptografada no UserRequest
        ]);

        // Se o 'profile_id' for fornecido, associa o perfil ao usuário
        if (isset($validated['profile_id'])) {
            $user->profile()->associate($validated['profile_id']);
        }

        // Se as permissões forem fornecidas, as associa ao usuário
        if (!empty($validated['permissions'])) {
            $user->permissions()->sync($validated['permissions']);
        }

        // Retorna a resposta com o usuário criado
        return response()->json($user, 201);
    }

    // Exibe os detalhes de um usuário específico, incluindo perfil e permissões
    public function show(User $user)
    {
        // Retorna o usuário com seu perfil e permissões
        return response()->json([
            'user' => $user,
            'profile' => $user->profile,
            'permissions' => $user->permissions,
        ]);
    }

    // Atualiza os dados de um usuário
    public function update(UserRequest $request, User $user)
    {
        // Obtém os dados validados do UserRequest
        $validated = $request->validated();

        // Atualiza o usuário com os dados validados
        $user->update([
            'name' => $validated['fullname'],  // Mapeia 'fullname' para o atributo 'name' do usuário
            'email' => $validated['email'],
            'password' => $validated['password'] ?? $user->password,  // Se não fornecer a senha, mantém a atual
        ]);

        // Se o 'profile_id' for fornecido, associa o novo perfil ao usuário
        if (isset($validated['profile_id'])) {
            $user->profile()->associate($validated['profile_id']);
        }

        // Sincroniza as permissões associadas ao usuário
        if (!empty($validated['permissions'])) {
            $user->permissions()->sync($validated['permissions']);
        }

        // Retorna a resposta com o usuário atualizado
        return response()->json($user);
    }

    // Exclui um usuário
    public function destroy(User $user)
    {
        // Opcional: Detach as permissões antes de excluir o usuário
        $user->permissions()->detach();

        // Exclui o usuário
        $user->delete();

        // Retorna uma mensagem de confirmação de exclusão
        return response()->json(['message' => 'User deleted']);
    }
}
