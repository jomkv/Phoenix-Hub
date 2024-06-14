<?php

namespace App\Controllers;

use App\Models\OrganizationModel;
use App\Models\ProductModel;

class Home extends BaseController
{
    public function index(): string
    {
        $model = new ProductModel();

        $products = [];
        $orgs = $this->getOrgs();

        foreach ($orgs as $org) {
            $currProducts = $model->where('organization_id', $org->organization_id)->findAll();
            $products = [...$products, ...$currProducts];
        }

        return view('pages/home', ['organizations' => $orgs, 'products' => $products]);
    }

    protected function getOrgs()
    {
        $model = new OrganizationModel();
        $organizations = $model->findAll();

        if (!$organizations) {
            $organizations = []; // ensure organizations array is not null
        }



        return $organizations;
    }

    protected function getProducts()
    {
        $model = new ProductModel();
        $products = $model->findAll();

        if (!$products) {
            $products = []; // ensure organizations array is not null
        }

        return $products;
    }

    private function sendEmail()
    {
        $email = \Config\Services::email();

        $email->setTo("jomkarlov@gmail.com");
        $email->setSubject("Test email");
        $email->setMessage("hello user");

        if ($email->send()) {
            echo "Email sent";
        } else {
            $debugOutput = $email->printDebugger(['headers']);
            echo ($debugOutput);
            log_message('error', 'Email failed to send: ' . $debugOutput);
        }
    }
}
