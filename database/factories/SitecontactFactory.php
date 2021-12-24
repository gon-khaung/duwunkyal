<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\SiteContact;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiteContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sitecontact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "phone" => "770867342",
            "address" => "No-252, Yadanar Thiri St, Dawbon, Yangon",
            "open_time" => "Always!",
            "email" => "duwunkyal@gmail.com",
        ];
    }
}
