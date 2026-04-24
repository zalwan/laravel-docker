<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Sistem ERP',
                'description' => 'Enterprise Resource Planning platform covering finance, inventory, and procurement workflows.',
                'teknologi' => 'PHP, Laravel, MySQL',
                'image' => 'erp.png',
                'status' => 'selesai',
            ],
            [
                'title' => 'Sistem HRMS',
                'description' => 'Human Resource Management System for employee lifecycle, payroll, and attendance.',
                'teknologi' => 'PHP, Laravel, MySQL',
                'image' => 'hrms.png',
                'status' => 'selesai',
            ],
            [
                'title' => 'Sistem E-Learning',
                'description' => 'Online learning platform with course management, assessments, and AI-assisted tutoring.',
                'teknologi' => 'PHP, Laravel, MySQL',
                'image' => 'elearning.png',
                'status' => 'on progress',
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
