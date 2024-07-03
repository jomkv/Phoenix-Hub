<?php

namespace App\Controllers;

use App\Models\BarterModel;

class BarterController extends BaseController
{
    protected $helpers = ['form', 'upload'];

    private BarterModel $model;

    public function __construct()
    {
        $this->model = new BarterModel();
    }

    /**
     * @desc Returns a view to barter home page
     * @route GET /barter
     * @access public
     */
    public function viewBarterHome()
    {
        return view('pages/barter/tradingCenter.php');
    }

    /**
     * @desc view create barter item form
     * @route GET /barter/new
     * @access private
     */
    public function viewCreateBarter()
    {
        return view('pages/barter/createBarterForm.php');
    }

    /**
     * @desc Creates a new barter post
     * @route POST /barter/new
     * @access private
     */
    public function createPost()
    {
        try {
            $data = $this->request->getPost();
            $data["student_id"] = auth()->id();

            // * Validate form data, excluding image
            if (!$this->model->validate($data)) {
                return redirect()->back()
                    ->with('errors', $this->model->errors())
                    ->withInput();
            }


            $validationRule = [
                'upload' => [
                    'label' => 'Image File',
                    'rules' => [
                        'uploaded[upload]',
                        'is_image[upload]',
                        'mime_in[upload, image/jpg,image/jpeg,image/png,image/webp]',
                        'max_size[upload,10200]', // 10 mb limit, converted to kb
                    ],
                ],
            ];

            // * Validate Image
            if (!$this->validateData([], $validationRule)) {
                return redirect()->back()
                    ->with('errors', $this->validator->getErrors())
                    ->withInput();
            }

            $img = $this->request->getFile('upload');

            // * Check if image has been tampered with
            if ($img->hasMoved()) {
                return redirect()->back()
                    ->with('error', 'Error occurred, unable to process image')
                    ->withInput();
            }

            // * Generate random file name, and upload image to writable/uploads/
            $imgName = $img->getFilename();
            $img->move(ROOTPATH . 'writable\\uploads\\', $imgName);

            $data['images'] = upload_image(ROOTPATH . 'writable\\uploads\\' . $imgName, true);

            // Delete uploaded org image
            unlink(ROOTPATH . 'writable\\uploads\\' . $imgName);

            $isSuccess = $this->model->insert($data);

            if ($isSuccess) {
                return redirect()->to('/barter')->with('message', 'Post successfuly submitted.');
            } else {
                return redirect()->to('/barter')->with('error', 'Error, unable to submit post.')->with('devErr', $this->model->errors());
            }
        } catch (\Exception $e) {
            return redirect()->to('/barter')->with('error', 'Error, please try again later')->with('stack', $e);
        }
    }
}
