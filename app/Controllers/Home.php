<?php

namespace App\Controllers;

use App\Models\OrganizationModel;

class Home extends BaseController
{
    public function index(): string
    {
        $orgs = $this->getOrgs();

        return view('pages/home', ['organizations' => $orgs]);
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
}
