<?php

namespace App\Controllers;

use App\Models\BarterModel;

class BarterController extends BaseController
{
    public function submit_barter()
    {
        $model = new BarterModel();

        $data = $this->request->getPost();
        $data["student_id"] = auth()->id(); // Assuming `auth()->id()` provides student ID

        if (!$model->insert($data)) {
            return redirect()->back()->with('errors', $model->errors());
        }

        // Process successful insertion (optional)
        // dd($data); // For debugging (remove in production)

        return redirect()->to('/success-page'); // Or appropriate redirect path
    }
}
