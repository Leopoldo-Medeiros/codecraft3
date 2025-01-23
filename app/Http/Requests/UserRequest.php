<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Obtem as regras de validação que se aplicam à solicitação.
     */
    public function rules(): array
    {
        $rules = [
            'fullname' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'profile_id' => 'required|exists:profiles,id', // Vinculando à entidade de perfil
            'permissions' => 'nullable|array', // As permissões devem ser um array, se fornecidas
            'permissions.*' => 'exists:permissions,id', // Cada permissão deve existir na tabela de permissões
        ];

        $userId = $this->route('user')?->id ?? 0;

        switch ($this->method()) {
            case 'PATCH':
            case 'PUT':
                // Permitir que o e-mail seja o mesmo do usuário atual
                $rules['email'] = 'required|email|unique:users,email,' . $userId;
                $rules['password'] = 'nullable|min:6|confirmed'; // Senha é opcional
                break;

            case 'POST':
                // Nada adicional para POST
                break;
        }

        return $rules;
    }

    /**
     * Prepara os dados para validação.
     */
    protected function prepareForValidation()
    {
        if (is_null($this->password)) {
            $this->request->remove('password');
        }

        // Certifique-se de que o perfil esteja incluído na solicitação e não seja nulo
        if (!isset($this->profile_id)) {
            $this->merge(['profile_id' => null]);
        }

        // Certifique-se de que as permissões sejam um array
        if (!is_array($this->permissions)) {
            $this->merge(['permissions' => []]);
        }
    }

    /**
     * Após a validação, modifique os dados.
     */
    public function validated($key = null, $default = null)
    {
        $validated = parent::validated();

        // Hash a senha, se fornecida
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        // Certifique-se de que o ID do perfil esteja incluído
        $validated['profile_id'] = $validated['profile_id'] ?? null;

        // Certifique-se de que as permissões sejam uma matriz
        $validated['permissions'] = $validated['permissions'] ?? [];

        return $validated;
    }
}
