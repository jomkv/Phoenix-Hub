<?php

use Cloudinary\Cloudinary;

/**
 * Upload Image to Cloudinary 
 * 
 * Returns stringified JSON of format:
 * {
 *   url: "<image_url>",
 *   public_id: "<public_id>"
 * }
 */
function upload_image($imagePath, $encode)
{
  $cloudinary = new Cloudinary([
    'cloud' => [
      'cloud_name' => getenv('cloudinary.name'),
      'api_key'    => getenv('cloudinary.key'),
      'api_secret' => getenv('cloudinary.secret'),
      'url'        => [
        'secure'   => true
      ]
    ]
  ]);

  $upload = $cloudinary->uploadApi();

  $res = $upload->upload(
    $imagePath,
    [
      'unique_filename' => true,
    ]
  )->getArrayCopy();

  $clean_res = [
    "url" => $res["url"],
    "public_id" => $res["public_id"]
  ];

  return $encode ? json_encode($clean_res) : $clean_res;
}

function delete_image($publicId)
{
  $cloudinary = new Cloudinary([
    'cloud' => [
      'cloud_name' => getenv('cloudinary.name'),
      'api_key'    => getenv('cloudinary.key'),
      'api_secret' => getenv('cloudinary.secret'),
      'url'        => [
        'secure'   => true
      ]
    ]
  ]);

  $upload = $cloudinary->uploadApi();

  $upload->destroy($publicId);
}
