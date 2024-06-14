<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;
use App\Rules\CvsuEmail;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        CvsuEmail::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------



    //--------------------------------------------------------------------
    // Rules For Registration
    //--------------------------------------------------------------------
    public $registration = [
        'username' => [
            'label' => 'Auth.username',
            'rules' => [
                'required',
                'max_length[30]',
                'min_length[3]',
                'regex_match[/\A[a-zA-Z0-9\.]+\z/]',
                'is_unique[users.username]',
            ],
            'errors' => [
                'required'    => 'Username must be provided',
                'max_length'  => 'Username too long',
                'min_length'  => 'Username must atleast be 3 characters',
                'is_unique'   => 'Username already taken'
            ],
        ],
        'email' => [
            'label' => 'Auth.email',
            'rules' => [
                'required',
                'max_length[254]',
                'valid_email',
                'is_unique[auth_identities.secret]',
                'cvsu_email'
            ],
            'errors' => [
                'required'    => 'Email must be provided',
                'max_length'  => 'Email too long',
                'valid_email' => 'Email format invalid',
                'cvsu_email'  => 'Email must be a CvSU Email',
                'is_unique'   => 'Email already taken'
            ]
        ],
        'password' => [
            'label' => 'Auth.password',
            'rules' => 'required|max_byte[72]|min_length[8]',
            'errors' => [
                'required'   => 'Password required',
                'max_byte'   => 'Password too long',
                'min_length' => 'Password too short'
            ]
        ],
        'password_confirm' => [
            'label' => 'Auth.passwordConfirm',
            'rules' => 'required|matches[password]',
            'errors' => [
                'required'   => 'Confirm Password required',
                'matches'    => 'Passwords do not match',
            ]
        ],
        'student_number' => [
            'label' => 'studentNumber',
            'rules' => 'required|exact_length[9]|is_unique[users.student_number]|numeric',
            'errors' => [
                'required'      => 'Student Number must be provided',
                'exact_length'  => 'Student Number must be 9 digits',
                'is_unique'     => 'Student Number is already in use',
                'numeric'       => 'Student Number invalid'
            ]
        ],
        'full_name' => [
            'label' => 'fullName',
            'rules' => 'required|max_length[100]',
            'errors' => [
                'required'      => 'Full Name must be provided',
                'max_length'    => 'Full Name too long',
            ]
        ],
        'phone_number' => [
            'label' => 'phoneNumber',
            'rules' => 'required|exact_length[11]|numeric',
            'errors' => [
                'required'      => 'Phone Number must be provided',
                'exact_length'  => 'Phone Number must be 11 digits',
            ]
        ],
        'pfp' => [
            'label' => 'pfp',
            'rules' => 'max_length[500]',
            'errors' => [
                'max_length'    => 'Uploaded PFP filename is too long'
            ]
        ],
    ];
}
