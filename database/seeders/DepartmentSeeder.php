<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            ['name' => 'HR', 'description' => 'Handles employee management and payroll'],
            ['name' => 'Finance', 'description' => 'Manages company finances and budgets'],
            ['name' => 'IT', 'description' => 'Maintains IT infrastructure and support'],
            ['name' => 'Admin', 'description' => 'Manages office resources and logistics'],
            ['name' => 'Sales & Marketing', 'description' => 'Drives sales and promotional campaigns'],
            ['name' => 'Customer Support', 'description' => 'Handles customer inquiries and issues'],
            ['name' => 'Legal', 'description' => 'Ensures legal compliance and contracts'],
        ];

        DB::table('departments')->insert($departments);
    }
}