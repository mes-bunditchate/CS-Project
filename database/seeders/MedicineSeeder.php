<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $csvFile = base_path('/storage/app/medicines-data.csv');
        
        if (File::exists($csvFile)) {

            $file = fopen($csvFile, 'r');
            
            $firstline = true;
            
            while (($row = fgetcsv($file)) !== false) {
                if (! $firstline) {
                    Medicine::create([
                        'name' => $row[0],
                        'sci_name' => $row[1],
                        'buy_price' => $row[2],
                        'sell_price' => $row[3],
                        'stock' => $row[4],
                    ]);
                }
                $firstline = false;
            }
            
            // ปิดไฟล์
            fclose($file);
        }
    }
}
