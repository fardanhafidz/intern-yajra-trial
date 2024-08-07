<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jobs = ['pns', 'swasta', 'wirausaha', 'pengangguran'];

        $startTimestamp = Carbon::create(1945, 1, 1)->timestamp;
        $endTimestamp = Carbon::create(2024, 12, 31)->timestamp;
        $randomTimestamp = rand($startTimestamp, $endTimestamp);
        $randomDate = Carbon::createFromTimestamp($randomTimestamp);
        $thisAge = Carbon::parse($randomDate)->age;
        $classification = function () use ($thisAge) {
            switch (true) {
                case ($thisAge >= 0 && $thisAge <= 1):
                    return 'Bayi';
                case ($thisAge > 1 && $thisAge <= 3):
                    return 'Balita';
                case ($thisAge > 3 && $thisAge <= 12):
                    return 'Anak-anak';
                case ($thisAge > 12 && $thisAge <= 18):
                    return 'Remaja';
                case ($thisAge > 18 && $thisAge <= 60):
                    return 'Dewasa';
                case ($thisAge > 60):
                    return 'Lansia';
                default:
                    return 'Umur tidak valid';
            }
        };

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'birth' => $randomDate,
            'classification' => $classification,
            'image' => 'img-dummy.jpg',
            'job' => $jobs[array_rand($jobs)],
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
