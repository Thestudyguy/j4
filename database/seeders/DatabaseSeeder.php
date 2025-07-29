<?php

namespace Database\Seeders;

use App\Models\Services;
use App\Models\SubService;
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
            'FirstName' => 'Angie',
            'LastName' => 'Doe',
            'UserName' => 'angie',
            'Email' => 'angie@gmail.com',  // lowercase 'email'
            'Role' => 'Front Desk',              // lowercase 'role'
            'password' => FacadesHash::make('staff')
        ]);
        // User::factory()->create([
        //     'FirstName' => 'Jane',
        //     'LastName' => 'Doe',
        //     'UserName' => 'jane',
        //     'Email' => 'janetest@email.com',  // lowercase 'email'
        //     'Role' => 'Patient',              // lowercase 'role'
        //     'password' => FacadesHash::make('admin')
        // ]);
        // User::factory()->create([
        //     'FirstName' => 'Edrian',
        //     'LastName' => 'Lagrosa',
        //     'UserName' => 'admin',
        //     'Email' => 'lagrosaedrian06@gmail.com',  // lowercase 'email'
        //     'Role' => 'SuperUser',              // lowercase 'role'
        //     'password' => FacadesHash::make('admin')
        // ]);
        // User::factory()->create([
        //     'FirstName' => 'Derik',
        //     'LastName' => 'Doe',
        //     'UserName' => 'derik',
        //     'Email' => 'deriktestemail.com',  // lowercase 'email'
        //     'Role' => 'Dentist',              // lowercase 'role'
        //     'password' => FacadesHash::make('admin')
        // ]);

        Services::factory()->create([
            'Service' => 'Veeners'
        ]);
        Services::factory()->create([
            'Service' => 'Implant Surgery'
        ]);
        Services::factory()->create([
            'Service' => 'Odontectomy'
        ]);
        Services::factory()->create([
            'Service' => 'Removable Partial Denture'
        ]);
        Services::factory()->create([
            'Service' => 'Full Denture per Arch'
        ]);

        $subServices = [
    [
        'Service' => 'Oral Prophylaxis',
        'Price' => 1000,
        'Description' => 'Thorough teeth cleaning to remove plaque and tartar.',
        'image_path' => 'services/cleaning.jpg',
        'parent_service' => 1,
    ],
    [
        'Service' => 'Bone Grafting',
        'Price' => 4500,
        'Description' => 'Procedure to rebuild bone in preparation for implants.',
        'image_path' => 'services/Bonegrafting.jpg',
        'parent_service' => 2,
    ],
    [
        'Service' => 'Clear Retainer',
        'Price' => 2000,
        'Description' => 'A transparent aligner to maintain teeth position.',
        'image_path' => 'services/Clearretainer.jpg',
        'parent_service' => 3,
    ],
];

foreach ($subServices as $subService) {
    SubService::create($subService);
}
    }
}
