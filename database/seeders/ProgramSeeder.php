<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [
            [
                'program' => 'BSBA-HRM',
                'program_title' => 'Bachelor of Science in Business Administration Major in Human Resource Management'
            ],
            [
                'program' => 'BSBA-MM',
                'program_title' => 'Bachelor of Science in Business Administration Major in Marketing Management'
            ],
            [
                'program' => 'BSOA',
                'program_title' => 'Bachelor of Science in Office Administration'
            ],
            [
                'program' => 'BEED',
                'program_title' => 'Bachelor of Elementary Education'
            ],
            [
                'program' => 'BSED-ENGLISH',
                'program_title' => 'Bachelor of Secondary Education Major in English'
            ],
            [
                'program' => 'BSED-FILIPINO',
                'program_title' => 'Bachelor of Secondary Education Major in Filipino'
            ],
            [
                'program' => 'BSED-MATH',
                'program_title' => 'Bachelor of Secondary Education Major in Math'
            ],
            [
                'program' => 'BSED-SOCSTUD',
                'program_title' => 'Bachelor of Secondary Education Major in Social Studies'
            ],
            [
                'program' => 'BS CRIM',
                'program_title' => 'Bachelor of Science in Criminology'
            ],
            [
                'program' => 'BSISM',
                'program_title' => 'Bachelor of Science in Industrial Security Management'
            ],
            [
                'program' => 'BSCS',
                'program_title' => 'Bachelor of Science in Computer Science'
            ],
            [
                'program' => 'AB COMM',
                'program_title' => 'Bachelor of Arts in Communication'
            ],
            [
                'program' => 'AB English',
                'program_title' => 'Bachelor of Arts in English Language'
            ],
            [
                'program' => 'AB POLSCI',
                'program_title' => 'Bachelor of Arts in Political Science'
            ],
            [
                'program' => 'GEN MID',
                'program_title' => 'Diploma in Midwifery'
            ]
        ];

        Program::insert($values);
    }
}
