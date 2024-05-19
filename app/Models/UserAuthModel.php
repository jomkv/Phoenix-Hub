<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;

class UserAuthModel extends ShieldUserModel
{
  protected function initialize(): void
  {
    parent::initialize();

    $this->allowedFields = [
      ...$this->allowedFields,
      'ref_user_id', // References to users tbl
    ];
  }
}
