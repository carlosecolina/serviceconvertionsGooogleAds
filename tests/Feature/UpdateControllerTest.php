<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Products;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Support\Facades\Hash;

class UpdateControllerTest extends TestCase
{
  use RefreshDatabase;

  public function test_update_controller()
  {
    //ejecuta el seeder de roles RoleSeeder::class
    $this->seed(RoleSeeder::class);

    // Crear un usuario y autenticarlo
    $user = User::create([
      'name' => 'Admin Mundo Web',
      'email' => 'hola@mundoweb.pe',
      'password' => Hash::make('12345678'),
    ])->assignRole('Admin');
    $this->actingAs($user);

    // Crear una categoria
    $category = Category::factory()->create();

    // Crear un modelo para actualizar
    $product = Products::factory()->create();

    // Datos para actualizar el modelo
    $data = [
      'producto' => 'Ramo De Flores',
      'extract' => 'extracto ramo de flores',
      'description' => 'Esta es la descripcion del producto',
      'precio' => '560',
      'descuento' => '500',
      'preciofiltro' => '500',
      'sku' => 'sku',

      'imagen' => "images/img/noimagen.jpg",
      'categoria_id' => $category->id,
      'tipo_prodct' => null,
      'parent_id' => null,
      'tipo_servicio' => 'producto',
      'tags_id' => []
    ];
    
    // Hacer una solicitud PUT al controlador update
    $response = $this->put(route('products.update', $product->id), $data);

    // Verificar que la respuesta sea exitosa
    $response->assertStatus(200);

    // Verificar que los datos en la base de datos se hayan actualizado
    $this->assertDatabaseHas('products', [
      'producto' => 'Ramo De Flores',
      'extract' => 'extracto ramo de flores',
      'description' => 'Esta es la descripcion del producto',
      'precio' => '560',
      'descuento' => '500',
      'preciofiltro' => '500',
      'sku' => 'sku',

      'imagen' => "images/img/noimagen.jpg",
      'categoria_id' => $category->id,
      'tipo_prodct' => null,
      'parent_id' => null,
      'tipo_servicio' => 'producto',

    ]);
  }
}
