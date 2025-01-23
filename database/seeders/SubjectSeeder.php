<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            // Science Stream
            "Mathematics",
            "Physics",
            "Chemistry",
            "Biology",
            "Computer Science",
            "Environmental Science",
            "Statistics",
            "Zoology",
            "Botany",
            "Microbiology",
            "Biotechnology",
            "Geology",
            "Astronomy",
            "Forensic Science",
            "Food Technology",

            // Commerce Stream
            "Accountancy",
            "Business Studies",
            "Economics",
            "Cost Accounting",
            "Management",
            "Marketing",
            "Taxation",
            "Auditing",
            "Finance",
            "Entrepreneurship",
            "Banking and Insurance",

            // Arts Stream
            "History",
            "Geography",
            "Political Science",
            "Psychology",
            "Sociology",
            "Philosophy",
            "Anthropology",
            "Public Administration",
            "Education",
            "English",
            "Hindi",
            "Sanskrit",
            "Regional Languages (e.g., Tamil, Telugu, Bengali)",
            "Mass Communication",
            "Journalism",
            "Fine Arts",
            "Music",
            "Dance",

            // Interdisciplinary
            "Law",
            "International Relations",
            "Social Work",
            "Linguistics",
            "Cultural Studies",
            "Performing Arts",
            "Human Resource Management",
            "Sports Science",
            "Tourism and Hospitality",
            "Data Science",
            "Artificial Intelligence",
            "Cyber Security",
            "Health Sciences",
            "Nutrition and Dietetics",
            "Event Management"
        ];
        foreach($subjects as $subject){
            Subject::create([
                'title'=>$subject,
            ]);
        }
    }
}
