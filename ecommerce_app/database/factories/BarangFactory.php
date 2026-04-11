<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BarangFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama_barang'       => $this->faker->words(3, true),           
            'deskripsi'  => $this->faker->paragraph(2),
            'harga'      => $this->faker->numberBetween(50000, 1500000),
            'stok'       => $this->faker->numberBetween(5, 100),
            'gambar'     => 'https://picsum.photos/id/' . $this->faker->numberBetween(1, 100) . '/600/600', 
        ];
    }
}