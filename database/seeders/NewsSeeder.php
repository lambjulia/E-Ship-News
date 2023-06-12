<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\News;
use Faker\Factory as Faker;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $tags = ['futebol', 'música', 'tecnologia', 'política', 'jogos'];

        $userIds = User::where('id', '!=', 1)->pluck('id')->toArray();

        foreach (range(1, 10) as $index) {

            $news = new News();
            $title = $faker->sentence();
            $description = $faker->text(2000);
            $thumbnail = $faker->imageUrl();
            $tags = $faker->randomElements($tags, 2);
            $userId = $faker->randomElement($userIds);

            $news->title = $title;
            $news->description = $description;
            $news->thumbnail = $thumbnail;
            $news->user_id = $userId;
            $news->tags = implode(',', $tags);
            $news->save();

            for ($i = 1; $i <= 3; $i++) {
                $image = $faker->imageUrl();

                $news->images()->create([
                    'image' => $image,
                    'path' => $image
                ]);
            }
        }
    }

}