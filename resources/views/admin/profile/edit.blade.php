<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Admin Profile Settings') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#0B3D91] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Update Profile Info -->
            <div class="p-4 sm:p-8 bg-white shadow-xl sm:rounded-lg border-t-4 border-red-600">
                <div class="max-w-xl">
                    @include('admin.profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="p-4 sm:p-8 bg-white shadow-xl sm:rounded-lg border-t-4 border-red-600">
                <div class="max-w-xl">
                    @include('admin.profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="p-4 sm:p-8 bg-white shadow-xl sm:rounded-lg border-t-4 border-red-800">
                <div class="max-w-xl">
                    @include('admin.profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>