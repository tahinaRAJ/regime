<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\CaracteristiqueModel;

class AuthController extends BaseController
{
    public function showLoginForm()
    {
        return view('auth/login');
    }

    public function showRegisterForm()
    {
        return view('auth/SingUp1', ['data' => []]);
    }

    public function register()
    {
        $model = new UserModel();

        $name = trim($this->request->getPost('name'));
        $email = trim($this->request->getPost('email'));
        $genre = $this->request->getPost('genre');
        $age = $this->request->getPost('age');
        $password = $this->request->getPost('password');
        $passwordConfirm = $this->request->getPost('password_confirm');

        $data = [
            'name' => $name,
            'email' => $email,
            'genre' => $genre,
            'age' => $age,
        ];

        if ($name === '' || $email === '' || $genre === '' || $age === '' || $password === '' || $passwordConfirm === '') {
            return view('auth/SingUp1', [
                'erreur' => 'Veuillez remplir tous les champs',
                'data' => $data,
            ]);
        }

        $existingUser = $model->where('email', $email)->first();
        if ($existingUser) {
            return view('auth/SingUp1', [
                'erreur' => 'Cet email est déjà utilisé',
                'data' => $data,
            ]);
        }

        session()->set('register_user', [
            'name' => $name,
            'email' => $email,
            'genre' => $genre,
            'age' => $age,
            'password' => $password,
        ]);

        return redirect()->to('/register/health');
    }

    public function showHealthForm()
    {
        $registerUser = session()->get('register_user');
        if (!$registerUser) {
            return redirect()->to('/register');
        }

        return view('auth/SingUp2', [
            'registerUser' => $registerUser,
            'data' => [],
        ]);
    }

    public function createAccount()
    {
        $registerUser = session()->get('register_user');
        if (!$registerUser) {
            return redirect()->to('/register');
        }

        $height = $this->request->getPost('height');
        $weight = $this->request->getPost('weight');

        $data = [
            'height' => $height,
            'weight' => $weight,
        ];

        if ($height === '' || $weight === '') {
            return view('auth/SingUp2', [
                'registerUser' => $registerUser,
                'erreur' => 'Veuillez remplir tous les champs',
                'data' => $data,
            ]);
        }

        $userModel = new UserModel();
        $userId = $userModel->insert([
            'name' => $registerUser['name'],
            'email' => $registerUser['email'],
            'password' => $registerUser['password'],
            'genre' => $registerUser['genre'],
            'role' => 'client',
        ], true);

        if (!$userId) {
            return view('auth/SingUp2', [
                'registerUser' => $registerUser,
                'erreur' => 'Erreur lors de la création du compte',
                'data' => $data,
            ]);
        }

        $caracteristiqueModel = new CaracteristiqueModel();
        $caracteristiqueModel->insert([
            'idUser' => $userId,
            'age' => $registerUser['age'],
            'height' => $height,
            'weight' => $weight,
        ]);

        session()->remove('register_user');

        return redirect()->to('/login')->with('message', 'Compte créé avec succès');
    }

    public function login()
    {
        $model = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $user = $model->where('email', $email)->first();
        if (!$user || ! (password_verify($password, $user['password']) || $password === $user['password'])) {
            return view('auth/login', [
                'erreur' => 'Email ou mot de passe incorrect'
            ]);
        }
        session()->set('user', [
            'id'    => $user['id'],
            'name'   => $user['name'],
            'email'  => $user['email'],
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
