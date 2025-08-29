<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Badge;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(): void
    {

        // --------------------
        // Module Completion
        // --------------------
        Badge::create([
            'name' => 'Conflict Resolver',
            'description' => 'Awarded after finishing Module 1: Conflict Resolution',
            'icon' => 'finish_module1.png',
        ]);

        Badge::create([
            'name' => 'Integrity Keeper',
            'description' => 'Awarded after finishing Module 2: Integrity',
            'icon' => 'finish_module2.png',
        ]);

        Badge::create([
            'name' => 'Rising Leader',
            'description' => 'Awarded after finishing Module 3: Leadership',
            'icon' => 'finish_module3.png',
        ]);

        // --------------------
        // Perfecting Meter + Quiz
        // --------------------
        Badge::create([
            'name' => 'Conflict Mastery',
            'description' => 'Perfect score in Module 1: Conflict Resolution (meter & quiz).',
            'icon' => 'perfect_module1.png',
        ]);

        Badge::create([
            'name' => 'Integrity Mastery',
            'description' => 'Perfect score in Module 2: Integrity (meter & quiz).',
            'icon' => 'perfect_module2.png',
        ]);

        Badge::create([
            'name' => 'Leadership Mastery',
            'description' => 'Perfect score in Module 3: Leadership (meter & quiz).',
            'icon' => 'perfect_module3.png',
        ]);

        Badge::create([
            'name' => 'Complete Mastery',
            'description' => 'Achieved perfect scores in all three modules.',
            'icon' => 'perfect_all.png',
        ]);

        // --------------------
        // Perfecting Meter Only
        // --------------------
        Badge::create([
            'name' => 'Conflict Peacemaker',
            'description' => 'Perfected the Spiritual Engagement Meter in Module 1: Conflict Resolution.',
            'icon' => 'meter_module1.png',
        ]);

        Badge::create([
            'name' => 'Integrity Guardian',
            'description' => 'Perfected the Spiritual Engagement Meter in Module 2: Integrity.',
            'icon' => 'meter_module2.png',
        ]);

        Badge::create([
            'name' => 'Leadership Guide',
            'description' => 'Perfected the Spiritual Engagement Meter in Module 3: Leadership.',
            'icon' => 'meter_module3.png',
        ]);

        Badge::create([
            'name' => 'Meter Champion',
            'description' => 'Perfected the Spiritual Engagement Meter in all three modules.',
            'icon' => 'meter_all.png',
        ]);

        // --------------------
        // Perfecting Quiz Only
        // --------------------
        Badge::create([
            'name' => 'Conflict Scholar',
            'description' => 'Perfected the quiz in Module 1: Conflict Resolution.',
            'icon' => 'quiz_module1.png',
        ]);

        Badge::create([
            'name' => 'Integrity Scholar',
            'description' => 'Perfected the quiz in Module 2: Integrity.',
            'icon' => 'quiz_module2.png',
        ]);

        Badge::create([
            'name' => 'Leadership Scholar',
            'description' => 'Perfected the quiz in Module 3: Leadership.',
            'icon' => 'quiz_module3.png',
        ]);

        Badge::create([
            'name' => 'Quiz Champion',
            'description' => 'Perfected the quizzes in all three modules.',
            'icon' => 'quiz_all.png',
        ]);

        // --------------------
        // Grand Achievement
        // --------------------
        Badge::create([
            'name' => 'Faithful Disciple',
            'description' => 'Completed all modules in the Digital Theology Classroom.',
            'icon' => 'grand_achievement.png',
        ]);

    }

}
