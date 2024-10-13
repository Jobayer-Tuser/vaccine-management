<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Please enter your NID number to check your vaccination status.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="GET" action="{{ route('vaccine.status') }}">
        <div>
            <x-input-label for="nid" :value="__('NID')" />
            <x-text-input id="nid" class="block mt-1 w-full" type="text" name="nid" :value="old('nid')" required autofocus />
            <x-input-error :messages="$errors->get('nid')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Check Status') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
