<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'phone' => '01859285784',
            'usertype' => 'client',
            'otp' => '1234',
            'verified' => '1',
            'password' => Hash::make('00000000'),
        ]);

        DB::table('clients')->insert([
            'phone' => '01859285784',
            'name' => 'Md. Asif Hossain',
            'image' => '/public/app/images/profile/default.png',
            'service_area' => '1',
        ]);

        DB::table('users')->insert([
            'phone' => '01303362460',
            'usertype' => 'nurse',
            'otp' => '1234',
            'verified' => '1',
            'password' => Hash::make('00000000'),
        ]);

        DB::table('nurses')->insert([
            'phone' => '01303362460',
            'name' => 'MAH Joy',
            'image' => '/public/app/images/profile/default.png',
            'service_area' => '1',
        ]);

        DB::table('users')->insert([
            'phone' => '01718087357',
            'usertype' => 'superadmin',
            'otp' => '1234',
            'verified' => '1',
            'password' => Hash::make('00000000'),
        ]);


        DB::table('servicecategories')->insert([
            'category' => 'Injection Home Service',
            'icon' => '/storage/app/public/services/injectionhomeservice.png',
            'pricing_scheme' => 'Dose',
            'active' => 1,
        ]);
        
        DB::table('servicecategories')->insert([
            'category' => 'Dressing Home Service',
            'icon' => '/storage/app/public/services/dressinghomeservice.png',
            'pricing_scheme' => 'Dressing',
            'active' => 1,
        ]);

        DB::table('servicecategories')->insert([
            'category' => 'Therapy Home Service',
            'icon' => '/storage/app/public/services/therapyhomeservice.png',
            'pricing_scheme' => 'Hour',
            'active' => 1,
        ]);

        DB::table('servicecategories')->insert([
            'category' => 'Day Care Service',
            'icon' => '/storage/app/public/services/daycareservice.png',
            'pricing_scheme' => 'Hour',
            'active' => 1,
        ]);

        DB::table('servicecategories')->insert([
            'category' => 'Blood Donation Service',
            'icon' => '/storage/app/public/services/blooddonationservice.png',
            
        ]);

        DB::table('servicecategories')->insert([
            'category' => 'Medicine Delivery Service',
            'icon' => '/storage/app/public/services/blooddonationservice.png',
            
        ]);        

        DB::table('services')->insert([
            'category_id' => '1',
            'service_name' => 'Injection Service (IM)',
            'minimum_unit' => '1',
            'unit_price' => '500',
        ]);

        DB::table('services')->insert([
            'category_id' => '1',
            'service_name' => 'Injection Service (S/C)',
            'minimum_unit' => '1',
            'unit_price' => '500',
        ]);
        
        DB::table('services')->insert([
            'category_id' => '1',
            'service_name' => 'Injection Service (IV)',
            'minimum_unit' => '1',
            'unit_price' => '1000',
        ]); 
        
        DB::table('services')->insert([
            'category_id' => '2',
            'service_name' => 'Standard Dressing',
            'minimum_unit' => '1',
            'unit_price' => '300',
        ]);

        DB::table('services')->insert([
            'category_id' => '2',
            'service_name' => 'Medium Dressing',
            'minimum_unit' => '1',
            'unit_price' => '500',
        ]);

        DB::table('services')->insert([
            'category_id' => '2',
            'service_name' => 'Serious Dressing',
            'minimum_unit' => '1',
            'unit_price' => '700',
        ]);

        DB::table('services')->insert([
            'category_id' => '3',
            'service_name' => 'Therapy Service',
            'minimum_unit' => '1',
            'unit_price' => '500',
        ]);
        
        DB::table('services')->insert([
            'category_id' => '4',
            'service_name' => 'Day Care Service - 01 (3 Hour)',
            'minimum_unit' => '3',
            'unit_price' => '600',
        ]); 

        DB::table('services')->insert([
            'category_id' => '4',
            'service_name' => 'Day Care Service - 02 (6 Hour)',
            'minimum_unit' => '6',
            'unit_price' => '1200',
        ]); 

        DB::table('services')->insert([
            'category_id' => '4',
            'service_name' => 'Day Care Service - 03 (9 Hour)',
            'minimum_unit' => '9',
            'unit_price' => '1600',
        ]); 

        DB::table('services')->insert([
            'category_id' => '4',
            'service_name' => 'Day Care Service - 04 (12 Hour)',
            'minimum_unit' => '12',
            'unit_price' => '2000',
        ]); 

        DB::table('serviceareas')->insert([
            'area' => 'Uttara Zone',
            'active' => '1',
        ]);

        $bloodarray = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];

        foreach($bloodarray as $group){
            DB::table('bloodgroups')->insert(['group'=>$group]);
        }

        
    }
}
