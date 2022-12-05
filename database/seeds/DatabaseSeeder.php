<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(MaterialsSeeder::class);
        $this->call(ProductTypesSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(ProductSizesSeeder::class);
        $this->call(ProductDetailsSeeder::class);
        $this->call(ProductImagesSeeder::class);
        $this->call(RewardTypesSeeder::class);
        $this->call(LevelsSeeder::class);
        $this->call(RewardsSeeder::class);
        $this->call(PointsSeeder::class);
        $this->call(UserStatusSeeder::class);
        $this->call(QuizSeeder::class);
        $this->call(QuizAnswerSeeder::class);
        $this->call(CombedSablonSeeder::class);
    }
}
