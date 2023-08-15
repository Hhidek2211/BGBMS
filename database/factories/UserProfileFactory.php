<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfile>
 */
class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        
        $id = User::pluck('id')-> all();
        
        return [
            'name'=> fake()-> name,
            'grade'=> fake()-> numberbetween(1,6),
            'introduction'=> fake()-> realtext(50),
            'user_id'=> fake()-> unique()-> randomElement($id),
        ];
    }
}
