<?php

namespace App\Controllers;

use App\Models\ProfileModel;
use App\Models\NominalModel;
use App\Models\PaymentMethodModel;
use App\Models\SocialLinkModel;
use App\Models\TransactionModel;

class Payment extends BaseController
{
    public function index()
    {
        $profileModel = new ProfileModel();
        $nominalModel = new NominalModel();
        $pmModel      = new PaymentMethodModel();
        $socialModel   = new SocialLinkModel();

        // Get the first profile (default)
        $profile = $profileModel->first();
        
        if (!$profile) {
            // Fallback data if DB is empty
            $profile = [
                'username'  => 'pink_creators',
                'bio'       => 'terimaaciii orang baiksss💗',
                'photo'     => 'https://i.pravatar.cc/150?u=pink',
                'instagram' => 'pink_creators'
            ];
        }

        $data = [
            'profile'         => $profile,
            'nominals'        => $nominalModel->orderBy('amount', 'ASC')->findAll(),
            'payment_methods' => $pmModel->findAll(),
            'social_links'    => $socialModel->where('profile_id', $profile['id'] ?? 0)->findAll(),
        ];

        return view('payment_page', $data);
    }

    public function process()
    {
        $transactionModel = new TransactionModel();
        $pmModel          = new PaymentMethodModel();
        
        $rules = [
            'donor_name'        => 'required|min_length[2]',
            'amount'            => 'required|numeric|greater_than[0]',
            'payment_method_id' => 'required|is_not_unique[payment_methods.id]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => $this->validator->getErrors()
            ]);
        }

        $pm_id = $this->request->getPost('payment_method_id');
        $pm    = $pmModel->find($pm_id);

        $data = [
            'profile_id'        => $this->request->getPost('profile_id'),
            'donor_name'        => $this->request->getPost('donor_name'),
            'amount'            => $this->request->getPost('amount'),
            'admin_fee'         => $pm['fee_fixed'] ?? 0,
            'payment_method_id' => $pm_id,
            'status'            => 'pending'
        ];

        $transactionModel->insert($data);
        $id = $transactionModel->getInsertID();

        return $this->response->setJSON([
            'status'   => 'success',
            'redirect' => base_url('payment/instructions/' . $id)
        ]);
    }

    public function instructions($id)
    {
        $transactionModel = new TransactionModel();
        $pmModel          = new PaymentMethodModel();

        $transaction = $transactionModel->find($id);
        if (!$transaction) {
            return redirect()->to('/');
        }

        $pm = $pmModel->find($transaction['payment_method_id']);

        $data = [
            'transaction' => $transaction,
            'pm'          => $pm,
        ];

        return view('payment_instructions', $data);
    }
}
