<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Customer;
use App\Models\DeliveryIntimation;
use App\Models\Payorder;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        
        $faker = Faker::create();

        Role::select('*')->delete();
        User::select('*')->delete();
    


        Role::create([
            'id' => 1,
            'name' => 'Admin',
        ]);

        Role::create([
            'id' => 2,
            'name' => 'User',
        ]);


        // $permissions = EnumsPermission::DATA;

        // foreach ($permissions as $key => $permission) {

        //     foreach ($permission as $name) {
        //         Permission::create([
        //             'name' => ucfirst(str_replace('-',' ',$name)),
        //             'slug' => $key.'.'.$name,
        //             'grouping' => ucfirst(str_replace('-',' ',$key)),
        //             'status' => 1,
        //         ]);
        //     }
          
        // }

        // $perm = Permission::pluck('slug')->toArray();
        // foreach (Role::all() as $key => $role) {
        //     $role->permissions = implode(',',$perm);
        //     $role->save();
        // }

        
        User::create([
            'name' => 'Admin',
            'company_id' => null,
            'email' => strtolower(str_replace(' ','','admin')).'@gmail.com',
            'password' => Hash::make('admin12345'),
            'role_id' => 1,
            'created_by' => 1,
            'created_at' => Carbon::now(),
        ]);

        foreach(range(1,50) as $key => $data){

            $name = $faker->name;
            $password = strtolower(str_replace(' ', '',$name));
            $user = User::create([
                'name' => $name,
                'company_id' => null,
                'email' => strtolower(str_replace(' ','',$name)).'@gmail.com',
                'password' => Hash::make($password),
                'role_id' => 2,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ]);

               $company = Company::create([
                    'name' => $faker->company,
                    'logo' => $faker->imageUrl(100, 100, 'business', true, 'logo'),
                    'details' => $faker->sentence,
                    'email' => $faker->unique()->companyEmail,
                    'contact' => $faker->phoneNumber,
                    'website' => $faker->url,
                    'country' => $faker->country,
                    'state' => $faker->state,
                    'city' => $faker->city,
                    'postal_code' => $faker->postcode,
                    'street_address' => $faker->address,
                    'status' => $faker->boolean,
                    'created_by' => $user->id,
                    'user_id' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $user->company_id =  $company->id;
                $user->save();

                foreach (range(1, 10) as $customerIndex) {
                    Customer::create([
                        'company_id' => $company->id,
                        'company_name' => $faker->company,
                        'customer_name' => $faker->name,
                        'customer_email' => $faker->unique()->safeEmail,
                        'customer_phone' => $faker->phoneNumber,
                        'country' => $faker->country,
                        'state' => $faker->state,
                        'city' => $faker->city,
                        'postal_code' => $faker->postcode,
                        'street_address' => $faker->address,
                        'status' => $faker->boolean,
                        'created_by' => 1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }


                foreach (range(1, 10) as $customerIndex){

                    $title = $faker->words(3, true);
                    $slug = strtolower($title);
                    $slug = preg_replace('/[\s_]+/', '-', $slug);
                    $slug = preg_replace('/[^a-z0-9\-]/', '', $slug);
                    $slug = trim($slug,'-');

                    Product::create([
                        'title' => $title,
                        'slug' => $slug,
                        'sku' => $faker->unique()->ean8,
                        'unit' => $faker->randomElement(['kg','piece','set','box']),
                        'short_description' => $faker->sentence(10),
                        'long_description' => $faker->paragraph(5),
                        'price' => $faker->randomFloat(2, 10, 500),
                        'category' => $faker->randomElement(['Electronics','Books','Fashion','Toys']),
                        'thumbnail' => $faker->imageUrl(200,200,'products',true,'Thumbnail'),
                        'gallery1' => $faker->imageUrl(300,300,'products',true,'Gallery Image 1'),
                        'gallery2' => $faker->imageUrl(300,300,'products',true,'Gallery Image 2'),
                        'gallery3' => $faker->imageUrl(300,300,'products',true,'Gallery Image 3'),
                        'gallery4' => $faker->imageUrl(300,300,'products',true,'Gallery Image 4'),
                        'gallery5' => $faker->imageUrl(300,300,'products',true,'Gallery Image 5'),
                        'company_id' => $company->id,
                        'status' => 1,
                        'created_by' => 1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]); 

                }

        }

    }

}
