<?php

use Carbon\Carbon;

/**
 * Write code on Method
 *
 * @return response()
 */
if (!function_exists('parseCurrency')) {
  function parseCurrency($nominal)
  {
    $hasil_rupiah = "Rp " . number_format($nominal, 2, ',', '.');
    return $hasil_rupiah;
  }
}

if (!function_exists('formatDate')) {
  function formatDate($date)
  {
    $dateCreated = date_create($date);
    return date_format($dateCreated, "d M Y");
  }
}

if (!function_exists('formatNoPO')) {
  function formatNoPO($id)
  {
    return "GJ-" . str_pad($id, 3, '0', STR_PAD_LEFT);
  }
}

if (!function_exists('removeImage')) {
  function removeImage($fileName)
  {
    if (file_exists(public_path($fileName))) {
      unlink(public_path($fileName));
    } 
  }
}
