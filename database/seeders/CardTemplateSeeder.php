<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\CardSign;
use App\Models\CardTemplateCategory;
use App\Models\CardTemplate;
use App\Models\CardTemplatePart;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CardTemplateSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $signs = CardSign::factory()->hasImage(1)->count(2);
        $cards = Card::factory()
            ->has($signs, 'signs')
            ->count(2);
        $template_parts = CardTemplatePart::factory()
            ->hasImage(1)
            ->count(6)
            ->sequence(
                ['name' => 'cover_image'],
                ['name' => 'cover_back_image'],
                ['name' => 'inside_image'],
                ['name' => 'inside_note'],
                ['name' => 'back_image'],
                ['name' => 'back_note']
            );
        $templates = CardTemplate::factory()
            ->count(10)
            ->has($cards)
            ->has($template_parts, 'parts')
            ->create();
        CardTemplateCategory::factory()
            ->count(10)
            ->hasAttached($templates, [], 'templates')
            ->create();
    }
}