<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
        // Jika sudah login, langsung lempar ke dasbor
        if (session()->get('is_logged_in')) {
            return redirect()->to('/home/dashboard');
        }
        return view('login');
    }

    public function proses()
    {
        $user = $this->request->getPost('username');
        $pass = $this->request->getPost('password');

        // Untuk purwarupa ini, kita hardcode kredensialnya.
        // Nanti bisa dikembangkan dengan mengecek ke tabel 'users' di database
        if ($user === 'admin' && $pass === 'rahasia123') {
            
            // Berikan tiket session
            session()->set([
                'is_logged_in' => true,
                'username'     => $user
            ]);
            return redirect()->to('/home/dashboard');
            
        } else {
            // Tolak dan kembalikan dengan pesan error
            session()->setFlashdata('error', 'Username atau Password salah!');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        // Hancurkan tiket session
        session()->destroy();
        return redirect()->to('/login');
    }
}