<?php

namespace App\Controllers;

use App\Models\OrganizationModel;
use App\Models\ProductModel;

class Home extends BaseController
{
    public function index(): string
    {
        // $this->sendEmail();
        $products = $this->getProducts();
        $orgs = $this->getOrgs();

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

        // $config = array();
        // $config['protocol'] = 'smtp';
        // $config['smtp_host'] = 'mail.phoenixhub.linkpc.net';
        // $config['smtp_user'] = 'phoenixh@phoenixhub.linkpc.net';
        // $config['smtp_pass'] = '"6*rE56z9a9^';
        // $config['smtp_port'] = 587;
        // $config["smtp_crypto"] = "tsl";

        // $email->initialize($config);

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
