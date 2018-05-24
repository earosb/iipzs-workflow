<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Issue;
use App\Status;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $myIssues = Issue::whereAssignedTo(Auth::user()->id)->take(10)->get();

        $lastComments = Comment::orderBy('created_at', 'desc')->take(10)->get();

        $issues = Issue::where('update_at', '>=', now()->startOfWeek())
            ->orderBy('status_id')
            ->get(['id', 'status_id', 'update_at'])
            ->groupBy('status.name')
            ->mapWithKeys(function ($item, $key) {
                return [__("status.{$key}") => $item->count()];
            });

        $states = Status::withCount('issues')
            ->get(['name']);

        $chartData = [
            'data'    => [
                'labels'   => $issues->keys(),//$states->pluck('name'),
                'datasets' => [
                    [
                        'label'           => '# de observaciones',
                        'data'            => $issues->values(),//$states->pluck('issues_count'),
                        'fill'            => true,
                        'backgroundColor' => [
                            'rgba(48, 151, 209, 1)',
                            'rgba(142, 180, 203, 1)',
                            'rgba(42, 178, 123, 1)',
                            'rgba(203, 185, 86, 1)',
                        ],
                        'borderColor'     => 'rgba(245, 248, 250, 0.5)',
                    ]
                ],
            ],
            'options' => [
                'responsive' => true,
                'legend'     => [
                    'position' => 'right',
                ],
//                'title'      => [
//                    'display' => false,
//                    'text'    => 'Legend Position: ',
//                ]
            ]
        ];

        return view('home', compact('myIssues', 'lastComments', 'states', 'chartData'));
    }
}
