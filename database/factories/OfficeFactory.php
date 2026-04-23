<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Office>
 */
class OfficeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $upazilas = [
            ['bn' => 'হালুয়াঘাট', 'en' => 'Haluaghat'],
            ['bn' => 'ধোবউড়া', 'en' => 'Dhobaura'],
            ['bn' => 'ফুলপুর', 'en' => 'Phulpur'],
            ['bn' => 'মুক্তাগাছা', 'en' => 'Muktagacha'],
            ['bn' => 'গৌরিপুর', 'en' => 'Gauripur'],
            ['bn' => 'ত্রিশাল', 'en' => 'Trishal'],
            ['bn' => 'ফুলবাড়িয়া', 'en' => 'Fulbaria'],
            ['bn' => 'ময়মনসিংহ সদর', 'en' => 'Mymensingh Sadar'],
        ];
        return [
            'office_name' => json_encode([
                'bn' => "উপজেলা উপানুষ্ঠানিক শিক্ষা ব্যুরো",
                'en' => "Upazila Non-Formal Education Bureau",
            ]),
            'upazila' => json_encode([
                'bn' => $upazilas[array_rand($upazilas)]['bn'],
                'en' => $upazilas[array_rand($upazilas)]['en'],
            ]),
            'district' => json_encode([
                'bn' => 'ময়মনসিংহ',
                'en' => 'Mymensingh',
            ]),
            'geo_code' => $this->faker->numberBetween(6100, 6199),
            'office_code' => $this->faker->numberBetween(1240303142000, 1240303142999),
        ];
    }
}
