<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'active_users' => User::where('status', 1)->count(),
            'posts' => Post::count(),
            'published' => Post::where('status', 1)->count(),
            'drafts' => Post::where('status', 0)->count(),
            'categories' => Category::count(),
            'tags' => Tag::count(),
            'total_views' => Post::sum('views'),
        ];

        $recentPosts = Post::with(['author', 'category'])
            ->latest()
            ->limit(6)
            ->get();

        // Monthly post counts for the last 12 months (published vs draft)
        $monthlyStats = Post::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as published'),
            DB::raw('SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) as drafts')
        )
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Build a full 12-month array (fill gaps with 0)
        $chartLabels = [];
        $chartPublished = [];
        $chartDrafts = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $year = (int) $date->format('Y');
            $month = (int) $date->format('n');

            $chartLabels[] = $date->format('M Y');

            $row = $monthlyStats->first(
                fn ($r) => (int) $r->year === $year && (int) $r->month === $month
            );

            $chartPublished[] = $row ? (int) $row->published : 0;
            $chartDrafts[] = $row ? (int) $row->drafts : 0;
        }

        return view('admin.dashboard', compact(
            'stats',
            'recentPosts',
            'chartLabels',
            'chartPublished',
            'chartDrafts'
        ));
    }

    public function create() {}

    public function store(Request $request) {}

    public function show(string $id) {}

    public function edit(string $id) {}

    public function update(Request $request, string $id) {}

    public function destroy(string $id) {}
}
