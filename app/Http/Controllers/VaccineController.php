<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckIdentityRequest;
use App\Http\Requests\UserDetailsRequest;
use App\Models\UserProfile;
use App\Models\VaccineCenter;
use App\Services\VaccineControlServices;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

readonly class VaccineController
{

    public function __construct(private VaccineControlServices $vaccineControlServices){}

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Factory|Application
    {
        $centers = $this->vaccineControlServices->getVaccineCenters();

        return view("vaccine.register", compact("centers"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserDetailsRequest $request): RedirectResponse
    {
        $this->vaccineControlServices->storeUserForVaccination(data: $request->validated());

        return redirect()->back()->with('status', 'Your are scheduled for vaccination!');
    }

    public function status(CheckIdentityRequest $request): View|Factory|Application
    {
        $details = $this->vaccineControlServices->checkUserExistOrNot($request->validated());

        return view('vaccine.status', compact("details"));
    }
}
