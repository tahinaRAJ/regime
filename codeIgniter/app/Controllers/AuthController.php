<?php

namespace App\Controllers;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function showLoginForm()
    {
        return view('auth/login');
    }
    public function login()
    {
        $model = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $user = $model->where('email', $email)->first();
        if (!$user || $password !== $user['password']) {
            return view('auth/login', [
                'erreur' => 'Email ou mot de passe incorrect'
            ]);
        }
        session()->set('user', [
            'id'    => $user['id'],
            'name'   => $user['name'],
            'role'  => $user['role']
        ]);

        return redirect()->to('/index')->with('message', 'Connexion réussie');
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
