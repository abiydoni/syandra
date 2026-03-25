<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('admin');
        }
        return view('auth/login');
    }

    public function auth()
    {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        
        $user = $model->where('username', $username)->first();

        if ($user) {
            $pass = $user['password'];
            $authenticatePassword = password_verify($password, $pass);
            if ($authenticatePassword) {
                // Fetch Profile Photo
                $profileModel = new \App\Models\ProfileModel();
                $profile = $profileModel->first();
                
                $ses_data = [
                    'id'           => $user['id'],
                    'username'     => $user['username'],
                    'email'        => $user['email'],
                    'userPhoto'    => $profile['photo'] ?? 'https://i.pravatar.cc/150?u=admin',
                    'userFullName' => $profile['full_name'] ?? '',
                    'isLoggedIn'   => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('admin');
            } else {
                $session->setFlashdata('msg', 'Password Salah');
                return redirect()->to('auth/login');
            }
        } else {
            $session->setFlashdata('msg', 'Username tidak ditemukan');
            return redirect()->to('auth/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('auth/login');
    }
}
