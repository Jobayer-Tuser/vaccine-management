<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Status') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if(isset($details))
                        You are <b>{{ $details['status'] }}</b> for vaccine. <br/>
                        Your schedule date is {{ Carbon\Carbon::parse($details['schedule_date'])->format('d-m-Y') }}. <br/>
                        Your center is <b> {{ $details['vaccineCenter']['name'] }}</b>
                    @else
                        You are not registered for vaccine, please register <a class="text-blue-500 visited:text-green-500 active:text-green-500 underline" href="{{ route('vaccine.create') }}">Here</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
