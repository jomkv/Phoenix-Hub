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
        try {
            $posts = $this->model->where("status", "approved")->findAll();

            $payload = [];
            foreach ($posts as $post) {
                $student = $this->getStudentOrError($post->student_id);

                array_push($payload, [
                    "post"      => $post,
                    "student"   => $student
                ]);
            }

            return view('pages/barter/tradingCenter.php', ["payload" => $payload]);
        } catch (\Exception $e) {
            return redirect()->to("/")->with('error', 'Error, please try again later')->with('stack', $e->getMessage());
        } catch (\LogicException $e) {
            return redirect()->to("/")->with('error', 'Error, please try again later')->with('stack', $e->getMessage());
        }
    }

    /**
     * @desc Returns a view to barter post
     * @route GET /barter/:postId
     * @access public
     */
    public function viewBarterPost($postId)
    {
        try {
            $post = $this->getPostOrError($postId);
            $student = $this->getStudentOrError($post->student_id);
            $studentEmail = $student->getEmail();

            if ($post->status !== "approved") {
                return redirect()->back()->with('error', 'Post not found.');
            }

            return view('pages/barter/barter.php', ["post" => $post, "student" => $student, "studentEmail" => $studentEmail]);
        } catch (\LogicException $e) {
            return redirect()->back()->with('error', $e->getMessage())->with('stack', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->to("/")->with('error', 'Error, please try again later')->with('stack', $e->getMessage());
        }
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
     * @desc get barter post details
     * @route POST /admin/barter/:postId
     * @access private
     */
    public function getBarterDetails($postId)
    {
        try {
            $post = $this->getPostOrError($postId);
            $student = $this->getStudentOrError($post->student_id);

            $payload = [
                "post"      => $post,
                "student"   => $student
            ];

            return $this->response->setStatusCode(200)->setJSON($payload);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(['message' => 'Error occurred']);
        } catch (\LogicException $e) {
            return $this->response->setStatusCode(400)->setJSON(['message' => $e->getMessage()]);
        }
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

            if ($data["barter_category"] === "swap") {
                $data["price"] = 1;
            }

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

    /**
     * @desc approve a barter post
     * @route POST /admin/barter/approve/:id
     * @access private
     */
    public function approvePost($postId)
    {
        try {
            $post = $this->getPostOrError($postId);

            $post->status = "approved";
            if ($this->model->save($post)) {
                return redirect()->back()->with('message', 'Post successfuly approved.');
            } else {
                return redirect()->back()->with('error', 'Something went wrong.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error, please try again later')->with('stack', $e->getMessage());
        } catch (\LogicException $e) {
            return redirect()->back()->with('error', 'Error, please try again later')->with('stack', $e->getMessage());
        }
    }

    /**
     * @desc reject a barter post
     * @route POST /admin/barter/reject/:id
     * @access private
     */
    public function rejectPost($postId)
    {
        try {
            $post = $this->getPostOrError($postId);

            $post->status = "rejected";
            if ($this->model->save($post)) {
                return redirect()->back()->with('message', 'Post successfully rejected.');
            } else {
                return redirect()->back()->with('error', 'Something went wrong.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error, please try again later')->with('stack', $e->getMessage());
        } catch (\LogicException $e) {
            return redirect()->back()->with('error', 'Error, please try again later')->with('stack', $e->getMessage());
        }
    }

    public function getPostOrError($postId)
    {
        $post = $this->model->find($postId);

        if ($post === null) {
            throw new \LogicException("Post not found.");
        }

        return $post;
    }

    public function getStudentOrError($studentId)
    {
        $model = auth()->getProvider();

        $student = $model->find($studentId);

        if ($student === null) {
            throw new \LogicException("Student not found.");
        }

        return $student;
    }
}
