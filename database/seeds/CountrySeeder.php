<?php

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = base_path('vendor/mledoze/countries/dist/countries.json');
        $data = json_decode(file_get_contents($data), true);

        foreach ($data as $country) {
            Country::create([
                'name' => $country['name']['common'],
                'code' => $country['cca2'],
            ]);
        }
    }
}
