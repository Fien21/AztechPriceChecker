<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-red-800">
            {{ __('Critical: Delete Admin Account') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once this account is deleted, all resources will be permanently removed. Proceed with caution.') }}
        </p>
    </header>

    <x-danger-button
        class="bg-red-800 hover:bg-red-900"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('admin.profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Confirm Permanent Deletion') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Please enter your administrator password to confirm account deletion.') }}
            </p>

            <div class="mt-6">
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 border-gray-300 focus:border-red-500 focus:ring-red-500"
                    placeholder="{{ __('Admin Password') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3 bg-red-800">
                    {{ __('Permanently Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>