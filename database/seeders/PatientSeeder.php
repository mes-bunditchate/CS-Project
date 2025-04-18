<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $csvFile = base_path('/storage/app/patients-data.csv');
        
        if (File::exists($csvFile)) {

            $file = fopen($csvFile, 'r');
            
            $firstline = true;
            
            while (($row = fgetcsv($file)) !== false) {
                if (! $firstline) {
                    $patient = new Patient();
                    $patient->name = $row[0];
                    $patient->nickname = $row[1];
                    $patient->birthdate = $row[2];
                    $patient->address = $row[3];
                    $patient->occupation = $row[5];
                    $patient->phone = $row[6];
                    $patient->email =  $row[7];
                    $patient->save();
                    $patient->allergies()->create([
                        'allergy_name' => $row[4],
                    ]);
                }
                $firstline = false;
            }
            
            // ปิดไฟล์
            fclose($file);
        }
    }
}
