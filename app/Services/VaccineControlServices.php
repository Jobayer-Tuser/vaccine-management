<?php

namespace App\Services;

use App\Enums\VaccineStatus;
use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use App\Models\VaccineCenter;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;

class VaccineControlServices extends Controller
{
    public function getVaccineCenters(): Collection
    {
        return VaccineCenter::query()->get(['id', 'name']);
    }

    public function checkUserExistOrNot(array $validateData): Collection|UserProfile
    {
        return UserProfile::query()
            ->with('vaccineCenter')
            ->where("nid", $validateData['nid'])
            ->first(['id', 'schedule_date', 'status', 'vaccine_center_id']);
    }

    public function storeUserForVaccination(array $data)
    {
        return UserProfile::query()->updateOrCreate($this->prepareDataToSave($data));
    }

    private function prepareDataToSave(array $array): array
    {
        return array_merge($array, [
            'status' => VaccineStatus::NOT_SCHEDULED,
        ]);
    }

    public function distributeAndScheduleUser(): void
    {
        $users = UserProfile::query()
            ->where('status', VaccineStatus::NOT_SCHEDULED)
            ->orderBy('created_at')
            ->get();

        foreach ($users as $user) {
            $this->assignCenterAndDate($user);
        }
    }

    private function assignCenterAndDate($user): void
    {
        $centers = self::getVaccineCenters();

        foreach ($centers as $center) {
            $date = Carbon::today();
            while ($this->isWeekend($date) || self::userCount($center, $date) >= $center->capacity) {
                $date->addDay();
            }
            $user->update(['status' => VaccineStatus::SCHEDULED, 'scheduled_date' => $date]);
            break;
        }
    }

    private function userCount(VaccineCenter $center, Carbon $date): int
    {
        return $center->users()->where('scheduled_date', $date)->count();
    }

    private function isWeekend($date): bool
    {
        return in_array($date->dayOfWeek, [CarbonInterface::FRIDAY, CarbonInterface::SATURDAY]);
    }

    private function sendNotification()
    {

    }
}
