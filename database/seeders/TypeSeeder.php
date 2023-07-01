<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = collect((new Type())->getTypes());

        $types->each(function ($type) {
            Type::query()
                ->updateOrCreate(
                    ['id' => $type['id']],
                    [
                        'description' => $type['description'],
                        'value_page_login' => $type['value_page_login'],
                        'value_per_page' => $type['value_per_page'],
                    ]
                );
        });
    }
}
