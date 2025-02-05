<?php

namespace Database\Factories;

use App\Models\TeamType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Workspace>
 */
class WorkspaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'team_type_id' => TeamType::inRandomOrder()->first()->id ?? null, // Hoặc TeamType::factory() nếu muốn tạo mới mỗi lần
            'id_member_creator' => User::inRandomOrder()->first()->id, // Chọn ngẫu nhiên một user làm người tạo
            'desc' => $this->faker->text(200),
            'display_name' => $this->faker->name(), // Tên hiển thị ngẫu nhiên
            'name' => $this->faker->unique()->word(), // Tên duy nhất
            'logo_hash' => $this->faker->md5(),  // Hash ngẫu nhiên
            'logo_url' => $this->faker->imageUrl(), // URL hình ảnh ngẫu nhiên
            'visibility' => $this->faker->randomElement(['private', 'public']),
            'is_archived' => $this->faker->boolean(),
        ];
    }
}
