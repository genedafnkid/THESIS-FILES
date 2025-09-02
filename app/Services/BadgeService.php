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

        // perfect quiz
        if ($quizScore == 5) {
            $this->giveBadge($user, $this->quizBadge($moduleId));
        }

        // perfect meter
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
        $scores = $user->scores()->pluck('module_id')->unique();

        // Faithful Disciple
        if ($scores->contains(1) && $scores->contains(2) && $scores->contains(3)) {
            $this->giveBadge($user, Badge::where('icon', 'grand_achievement.png')->first());
        }

        // Quiz Champion
        $perfectQuiz = $user->scores()->where('quiz_score', 100)->pluck('module_id')->unique();
        if ($perfectQuiz->contains(1) && $perfectQuiz->contains(2) && $perfectQuiz->contains(3)) {
            $this->giveBadge($user, Badge::where('icon', 'quiz_all.png')->first());
        }

        // Meter Champion
        $perfectMeter = $user->scores()->where('meter_score', 100)->pluck('module_id')->unique();
        if ($perfectMeter->contains(1) && $perfectMeter->contains(2) && $perfectMeter->contains(3)) {
            $this->giveBadge($user, Badge::where('icon', 'meter_all.png')->first());
        }

        // Complete Mastery
        $perfectBoth = $user->scores()
            ->where('quiz_score', 100)
            ->where('meter_score', 100)
            ->pluck('module_id')->unique();
        if ($perfectBoth->contains(1) && $perfectBoth->contains(2) && $perfectBoth->contains(3)) {
            $this->giveBadge($user, Badge::where('icon', 'perfect_all.png')->first());
        }
    }
}
