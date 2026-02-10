<section>
    <header>
        <h2 class="text-lg font-medium text-red-700">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your admin account's identity and username.") }}
        </p>
    </header>

    <form method="post" action="{{ route('admin.profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Name (Required added) -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" class="text-gray-700" />
            <x-text-input 
                id="name" 
                name="name" 
                type="text" 
                class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500" 
                :value="old('name', $user->name)" 
                required 
                autofocus 
                autocomplete="name" 
            />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Username (Formerly Email) (Required added) -->
        <div>
            <x-input-label for="email" :value="__('Username (Email)')" class="text-gray-700" />
            <x-text-input 
                id="email" 
                name="email" 
                type="email" 
                class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500" 
                :value="old('email', $user->email)" 
                required 
                autocomplete="username" 
            />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg transition duration-150 shadow-md">
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 font-semibold">
                    {{ __('Profile Updated Successfully.') }}
                </p>
            @endif
        </div>
    </form>
</section>