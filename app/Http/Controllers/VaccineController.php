<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserDetailsRequest;
use App\Models\UserProfile;
use App\Models\VaccineCenter;
use App\Services\UserDetailsService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

readonly class VaccineController
{

    public function __construct(private UserDetailsService $userDetailsService){}

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Factory|Application
    {
        $centers = VaccineCenter::query()->get(['id', 'name']);

        return view("vaccine.register", compact("centers"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserDetailsRequest $request): RedirectResponse
    {
        $this->userDetailsService->storeUserInfo(data: $request->validated());
        return redirect()->back()->with('status', 'Your are scheduled for vaccination!');
    }

    public function status(Request $request)//: View|Factory|Application
    {
        $validated = $request->validate([
            'nid' => ['required', 'integer', 'digits_between:10,11'],
        ]);

        $details = UserProfile::query()
                    ->with('vaccineCenter')
                    ->where("nid", $validated['nid'])
                    ->first(['id', 'schedule_date', 'status', 'vaccine_center_id']);

        return view('vaccine.status', compact("details"));
    }
}
