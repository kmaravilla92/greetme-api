<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Storage::delete(
            Storage::files('images')
        );

        collect()->range(1, 10)->each(function () {
            $image_url = fake()->image();
            Storage::putFile(
                'images',
                new File($image_url)
            );
        });
    }
}
