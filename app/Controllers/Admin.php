<?php

namespace App\Controllers;

use App\Models\ProfileModel;
use App\Models\NominalModel;
use App\Models\PaymentMethodModel;
use App\Models\TransactionModel;
use App\Models\UserModel;

class Admin extends BaseController
{
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        if (!session()->get('isLoggedIn')) {
            die(header('Location: ' . base_url('auth/login')));
        }
    }

    public function index()
    {
        $transactionModel = new TransactionModel();
        $data = [
            'total_donations' => $transactionModel->where('status', 'success')->selectSum('amount')->first()['amount'] ?? 0,
            'count_donations' => $transactionModel->where('status', 'success')->countAllResults(),
            'recent_transactions' => $transactionModel->orderBy('created_at', 'DESC')->findAll(5),
            'title' => 'Dashboard',
            'active' => 'dashboard'
        ];
        return view('admin/dashboard', $data);
    }

    // Profile Management
    public function profile()
    {
        $model = new ProfileModel();
        $data = [
            'profile' => $model->first() ?: [],
            'title' => 'Edit Profile',
            'active' => 'profile'
        ];
        return view('admin/profile', $data);
    }

    public function profile_save()
    {
        $model = new ProfileModel();
        $data = $this->request->getPost();
        
        $profile = $model->first();
        
        // Handle Photo Upload
        $photo = $this->request->getFile('photo');
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            if ($profile && !empty($profile['photo'])) {
                $this->_deleteFile($profile['photo']);
            }
            $newName = $photo->getRandomName();
            $photo->move(FCPATH . 'uploads', $newName);
            $data['photo'] = base_url('uploads/' . $newName);
        }

        // Handle Header Upload
        $header = $this->request->getFile('header_image');
        if ($header && $header->isValid() && !$header->hasMoved()) {
            if ($profile && !empty($profile['header_image'])) {
                $this->_deleteFile($profile['header_image']);
            }
            $newName = $header->getRandomName();
            $header->move(FCPATH . 'uploads', $newName);
            $data['header_image'] = base_url('uploads/' . $newName);
        }
        
        if ($profile) {
            $model->update($profile['id'], $data);
        } else {
            $model->insert($data);
        }

        // Update Session if photo or full_name changed
        if (isset($data['photo']))     session()->set('userPhoto', $data['photo']);
        if (isset($data['full_name'])) session()->set('userFullName', $data['full_name']);

        return redirect()->to('admin/profile')->with('msg', 'Profil berhasil diperbarui');
    }

    // Nominal Management
    public function nominals()
    {
        $model = new NominalModel();
        $data = [
            'nominals' => $model->orderBy('amount', 'ASC')->findAll(),
            'title' => 'Kelola Nominal',
            'active' => 'nominals'
        ];
        return view('admin/nominals', $data);
    }

    public function nominal_save()
    {
        $model = new NominalModel();
        $data = $this->request->getPost();
        
        if (isset($data['id']) && $data['id']) {
            $id = $data['id'];
            unset($data['id']);
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to('admin/nominals');
    }

    public function nominal_delete($id)
    {
        $model = new NominalModel();
        $model->delete($id);
        return redirect()->to('admin/nominals');
    }

    // Payment Method Management
    public function payment_methods()
    {
        $model = new PaymentMethodModel();
        $data = [
            'methods' => $model->findAll(),
            'title' => 'Metode Pembayaran',
            'active' => 'payment_methods'
        ];
        return view('admin/payment_methods', $data);
    }

    public function pm_save()
    {
        $model = new PaymentMethodModel();
        $data = $this->request->getPost();
        
        $existing = null;
        if (isset($data['id']) && $data['id']) {
            $existing = $model->find($data['id']);
        }

        // Handle Logo Upload
        $logo = $this->request->getFile('logo');
        if ($logo && $logo->isValid() && !$logo->hasMoved()) {
            if ($existing && !empty($existing['logo'])) {
                $this->_deleteFile($existing['logo']);
            }
            $newName = $logo->getRandomName();
            $logo->move(FCPATH . 'uploads', $newName);
            $data['logo'] = base_url('uploads/' . $newName);
        }
        
        if ($existing) {
            $id = $data['id'];
            unset($data['id']);
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to('admin/payment_methods');
    }

    public function pm_delete($id)
    {
        $model = new PaymentMethodModel();
        $pm = $model->find($id);
        if ($pm && !empty($pm['logo'])) {
            $this->_deleteFile($pm['logo']);
        }
        $model->delete($id);
        return redirect()->to('admin/payment_methods')->with('msg', 'Metode berhasil dihapus');
    }

    // User Management
    public function users()
    {
        $model = new UserModel();
        $data = [
            'users' => $model->findAll(),
            'title' => 'Kelola Pengguna',
            'active' => 'users'
        ];
        return view('admin/users', $data);
    }

    public function user_save()
    {
        $model = new UserModel();
        $data = $this->request->getPost();
        
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']);
        }

        if (isset($data['id']) && $data['id']) {
            $id = $data['id'];
            unset($data['id']);
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to('admin/users')->with('msg', 'User berhasil disimpan');
    }

    public function user_delete($id)
    {
        $model = new UserModel();
        $model->delete($id);
        return redirect()->to('admin/users')->with('msg', 'User berhasil dihapus');
    }

    // Transaction Management
    public function transactions()
    {
        $model = new TransactionModel();
        $data = [
            'transactions' => $model->orderBy('created_at', 'DESC')->findAll(),
            'title' => 'Daftar Transaksi',
            'active' => 'transactions'
        ];
        return view('admin/transactions', $data);
    }

    public function transaction_delete($id)
    {
        $model = new TransactionModel();
        $model->delete($id);
        return redirect()->to('admin/transactions')->with('msg', 'Transaksi berhasil dihapus');
    }

    public function transaction_status($id, $status)
    {
        $model = new TransactionModel();
        $model->update($id, ['status' => $status]);
        return redirect()->to('admin/transactions')->with('msg', 'Status transaksi diperbarui');
    }

    /**
     * Helper to delete file from uploads directory based on its URL
     */
    private function _deleteFile($url)
    {
        if (empty($url)) return;
        
        // Extract filename from URL
        $parts = explode('/', $url);
        $filename = end($parts);
        
        $filePath = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . $filename;
        
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}
