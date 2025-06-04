<?php

namespace Database\Seeders;

use Faker\Factory as FakerFactory;
use App\Models\CustomSession;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\StudentDetail;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    //     $this->call([
    //     CustomSessionSeeder::class,
    // ]);
        // CustomSession::factory(1)->create();
                User::factory()->create([
                    'firstname' => 'Sarim Shahid',
                    'email' => 'admin@example.com',
                    'user_type'=>'admin',
                ]);
        // StudentDetail::create([
        //     'user_id'=>'3',
        //     'teacher_id'=>'3',
        //     'group_id'=>'1',
        //     'course_id'=>'1'
        // ]);



        // $faker = FakerFactory::create();

        // // Create 5 dummy courses, groups, sessions
        // $courses = \App\Models\Course::factory(5)->create();
        // $groups = \App\Models\BatchGroup::factory(5)->create();
        // $teachers = \App\Models\User::factory(3)->create([
        //     'user_type' => 'teacher'
        // ]);
        // $sessions = \App\Models\CustomSession::factory(3)->create();

        // // Create 50 student users and details
        // User::factory(50)->create([
        //     'user_type' => 'student',
        // ])->each(function ($user) use ($courses, $groups, $teachers, $sessions, $faker) {
        //     $user->update([
        //         'session_year_id' => $faker->randomElement($sessions)->id,
        //     ]);

        //     StudentDetail::create([
        //         'user_id' => $user->id,
        //         'teacher_id' => $faker->randomElement($teachers)->id,
        //         'group_id' => $faker->randomElement($groups)->id,
        //         'course_id' => $faker->randomElement($courses)->id,
        //         'entry_test' => $faker->boolean,
        //         'suspend_date' => $faker->optional()->date(),
        //         'reason_suspend' => $faker->optional()->sentence(),
        //         'is_completed' => $faker->randomElement(['0', '1']),
        //         'result' => $faker->randomElement(['In_progress', 'pass', 'fail']),
        //         'test_countdown' => $faker->numberBetween(0, 3600),
        //     ]);
        // });
    }
}
