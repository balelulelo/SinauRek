<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;
    public function with(): array
    {
        return [
            'users' => User::where('id', '!=', Auth::id())->paginate(9),
        ];
    }
}; ?>

<x-layouts.app>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold leading-tight text-gray-800">
                        Find a Study Partner
                    </h2>
                    <p class="mt-1 text-gray-500">
                        Browse other students looking to collaborate.
                    </p>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($users as $user)
                    <div class="overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg">
                        <h3 class="text-lg font-bold">{{ $user->name }}</h3>

                        @if ($user->major)
                            <p class="mt-1 text-sm text-gray-600">{{ $user->major }}</p>
                        @endif

                        @if ($user->bio)
                            <p class="mt-4 text-gray-700">{{ $user->bio }}</p>
                        @endif
                        
                        @if ($user->subjects)
                            <div class="mt-4">
                                <h4 class="text-xs font-semibold uppercase text-gray-500">Interested in:</h4>
                                <p class="text-gray-800">{{ $user->subjects }}</p>
                            </div>
                        @endif
                    </div>
                @empty
                     <div class="md:col-span-2 lg:col-span-3">
                        <div class="overflow-hidden bg-white p-6 text-center text-gray-500 shadow-sm sm:rounded-lg">
                            <p>No other users have registered yet. Check back soon!</p>
                        </div>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-8">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-layouts.app>