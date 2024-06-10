<?php

// Use the Configuration class 
use Cloudinary\Configuration\Configuration;

// Upload API
use Cloudinary\Api\Upload\UploadApi;

// Use the Resize transformation group and the ImageTag class
use Cloudinary\Transformation\Resize;
use Cloudinary\Transformation\Background;
use Cloudinary\Tag\ImageTag;

// Configure an instance of your Cloudinary cloud
Configuration::instance(getenv('cloudinary.env'));

/**
 * Upload Image to Cloudinary 
 * 
 * Returns stringified JSON of format:
 * {
 *   url: "<image_url>",
 *   public_id: "<public_id>"
 * }
 */
function upload_image($imagePath)
{
  $upload = new UploadApi();

  $res = $upload->upload(
    $imagePath,
    [
      'unique_filename' => true,
    ]
  )->getArrayCopy();

  $clean_res = json_encode([
    "url" => $res["url"],
    "public_id" => $res["public_id"]
  ]);

  return $clean_res;
}

function delete_image($publicId)
{
  $upload = new UploadApi();

  $upload->destroy($publicId);
}
