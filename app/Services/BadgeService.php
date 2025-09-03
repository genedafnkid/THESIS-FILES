<?php

namespace App\Services;

use App\Models\Badge;
use App\Models\User;
use Carbon\Carbon;

class BadgeService
{
    public function awardModuleBadges(User $user, $moduleId, $quizScore, $meterScore)
    {
        // completion
        $this->giveBadge($user, $this->completionBadge($moduleId));

        // perfect quiz (5/5)
        if ($quizScore == 5) {
            $this->giveBadge($user, $this->quizBadge($moduleId));
        }

        // perfect meter (100/100)
        if ($meterScore == 100) {
            $this->giveBadge($user, $this->meterBadge($moduleId));
        }

        // mastery (both)
        if ($quizScore == 5 && $meterScore == 100) {
            $this->giveBadge($user, $this->masteryBadge($moduleId));
        }

        // check for global badges
        $this->checkGlobalBadges($user);
    }

    private function giveBadge(User $user, ?Badge $badge)
    {
        if ($badge && !$user->badges->contains($badge->id)) {
            $user->badges()->attach($badge->id, ['earned_at' => Carbon::now()]);
        }
    }

    private function completionBadge($moduleId)
    {
        return Badge::where('icon', "finish_module{$moduleId}.png")->first();
    }

    private function quizBadge($moduleId)
    {
        return Badge::where('icon', "quiz_module{$moduleId}.png")->first();
    }

    private function meterBadge($moduleId)
    {
        return Badge::where('icon', "meter_module{$moduleId}.png")->first();
    }

    private function masteryBadge($moduleId)
    {
        return Badge::where('icon', "perfect_module{$moduleId}.png")->first();
    }

    private function checkGlobalBadges(User $user)
    {
        // module_id ≡ game_number in your schema
        $modulesCompleted = $user->scores()->pluck('game_number')->unique();

        // Faithful Disciple — completed modules 1,2,3
        if ($modulesCompleted->contains(1) && $modulesCompleted->contains(2) && $modulesCompleted->contains(3)) {
            $this->giveBadge($user, Badge::where('icon', 'grand_achievement.png')->first());
        }

        // Quiz Champion — perfect quiz (score == 5) on modules 1,2,3
        $perfectQuiz = $user->scores()->where('score', 5)->pluck('game_number')->unique();
        if ($perfectQuiz->contains(1) && $perfectQuiz->contains(2) && $perfectQuiz->contains(3)) {
            $this->giveBadge($user, Badge::where('icon', 'quiz_all.png')->first());
        }

        // Meter Champion — perfect meter (100) on modules 1,2,3
        $perfectMeter = $user->scores()->where('meter_score', 100)->pluck('game_number')->unique();
        if ($perfectMeter->contains(1) && $perfectMeter->contains(2) && $perfectMeter->contains(3)) {
            $this->giveBadge($user, Badge::where('icon', 'meter_all.png')->first());
        }

        // Complete Mastery — both perfect quiz & perfect meter on 1,2,3
        $perfectBoth = $user->scores()
            ->where('score', 5)
            ->where('meter_score', 100)
            ->pluck('game_number')->unique();

        if ($perfectBoth->contains(1) && $perfectBoth->contains(2) && $perfectBoth->contains(3)) {
            $this->giveBadge($user, Badge::where('icon', 'perfect_all.png')->first());
        }
    }
}
