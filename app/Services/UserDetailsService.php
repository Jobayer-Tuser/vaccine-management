<?php

namespace App\Services;

use App\Enums\VaccineStatus;
use App\Http\Controllers\Controller;
use App\Models\UserProfile;

class UserDetailsService extends Controller
{
    public function storeUserInfo(array $data)
    {
        return UserProfile::query()->create($this->mergeArray($data));
    }

    private function mergeArray(array $array): array
    {
        return array_merge($array, [
            'status'        => VaccineStatus::SCHEDULED,
            'schedule_date' => now()->format('Y-m-d'),
        ]);
    }
}
