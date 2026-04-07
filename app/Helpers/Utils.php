<?php

namespace App\Helpers;


use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class Utils
{
  static function guardarImg($file, $route, $nombreImagen)
  {
    $manager = new ImageManager(new Driver());
    $img = $manager->read($file);
    // $img->coverDown(672, 700, 'center');
    if (!file_exists($route)) {
      mkdir($route, 0777, true); // Se crea la ruta con permisos de lectura, escritura y ejecución
    }
    $img->save($route . $nombreImagen);
  }
}
