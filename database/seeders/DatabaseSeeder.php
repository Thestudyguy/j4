<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash as FacadesHash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'FirstName' => 'John',
            'LastName' => 'Doe',
            'UserName' => 'john',
            'Email' => 'johntest@email.com',  // lowercase 'email'
            'Role' => 'Admin',              // lowercase 'role'
            'password' => FacadesHash::make('admin')
        ]);
        User::factory()->create([
            'FirstName' => 'Jane',
            'LastName' => 'Doe',
            'UserName' => 'jane',
            'Email' => 'janetest@email.com',  // lowercase 'email'
            'Role' => 'Patient',              // lowercase 'role'
            'password' => FacadesHash::make('admin')
        ]);
        User::factory()->create([
            'FirstName' => 'Edrian',
            'LastName' => 'Lagrosa',
            'UserName' => 'admin',
            'Email' => 'lagrosaedrian06@gmail.com',  // lowercase 'email'
            'Role' => 'SuperUser',              // lowercase 'role'
            'password' => FacadesHash::make('admin')
        ]);
        User::factory()->create([
            'FirstName' => 'Derik',
            'LastName' => 'Doe',
            'UserName' => 'derik',
            'Email' => 'deriktestemail.com',  // lowercase 'email'
            'Role' => 'Dentist',              // lowercase 'role'
            'password' => FacadesHash::make('admin')
        ]);
    }
}
