<?php

namespace App\Services;

use App\Models\Profile;
use Illuminate\Support\Facades\Hash;

class ProfileService {
    public function createProfile(array $data) {
        return Profile::create([
            'nome_completo' => $data['nome'],
            'nome_usuario' => $data['username'],
            'email' => $data['email'],
            'password_hash' => Hash::make($data['password']),
            'funcao' => $data['role'],
            'saldo_creditos' => 10,
        ]);
    }

    public function updateProfile(Profile $profile, array $data) {
        $profile->update($data);
        return $profile;
    }

    public function syncSkills(Profile $profile, array $skillIds) {
        return $profile->skills()->sync($skillIds);
    }
}