<?php
// app/Http/Controllers/AdminController.php
namespace App\Http\Controllers;


use App\Models\Badge;

class AchievementsController extends Controller
{
    // Pending tab
public function index() {
    $badges = auth()->user()
        ->badges() // relationship: belongsToMany or hasMany
        ->latest('earned_at')
        ->paginate(12);

    // optional: total and available for progress + locked list
    $totalAvailable = Badge::count();
    $availableBadges = Badge::select('id','name','icon_url','hint')->get();

    return view('achievements', compact('badges','totalAvailable','availableBadges'));
}
}
