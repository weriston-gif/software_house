<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = $this->getTypes();

        foreach ($types as $typeData) {
            Type::create($typeData);
        }
    }

    private function getTypes()
    {
        return [
            [
                'id' => 1,
                'description' => 'Elaboração de sistema Web.',
                'value_page_login' => '19.5',
                'value_per_page' => '10.3'
            ],
            [
                'id' => 2,
                'description' => 'Elaboração de sistema Mobile.',
                'value_page_login' => '29.5',
                'value_per_page' => '12'
            ],
            [
                'id' => 3,
                'description' => 'Elaboração de sistema Desktop.',
                'value_page_login' => '49.5',
                'value_per_page' => '15'
            ],
        ];
    }
}
