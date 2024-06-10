<?php

namespace App\Rules;

class CvsuEmail
{
  public function cvsu_email($value, ?string &$error = null): bool
  {
    try {
      list($user, $domain) = explode('@', $value);

      if ($domain === 'cvsu.edu.ph') {
        return true;
      } else {
        return false;
      }
    } catch (\Exception $e) {
      return false;
    }
  }
}
