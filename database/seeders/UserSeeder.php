<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $name = $faker->name;
        $email = $faker->unique()->safeEmail;
        $password = 'password'; // Substitua 'password' pela senha desejada

        DB::table('users')->insert([
            'name' => $name,
            'email' => $email,
            'email_verified_at' => now(),
            'role_admin' => true,
            'password' => Hash::make($password),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('Usuário criado:');
        $this->command->info("Nome: $name");
        $this->command->info("E-mail: $email");
        $this->command->info("Senha: $password");
    }
}
