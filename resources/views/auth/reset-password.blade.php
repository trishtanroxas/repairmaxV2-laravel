<x-layouts.auth
    title="Reset Password | Repairmax"
    heading="Secure your account."
    subheading="Choose a strong, unique password to keep your service tickets and device information safe.">

    <div class="mb-10 text-center sm:text-left">
        <h2 class="text-2xl font-semibold text-gray-900">Set new password</h2>
        <p class="text-gray-600 mt-2">Please enter your new password below.</p>
    </div>

    <form action="/reset-password" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="token" value="{{ $token ?? '' }}">

        <div class="relative" x-data="{ show: false }">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
            <div class="relative">
                <input :type="show ? 'text' : 'password'" id="password" name="password" required
                    class="w-full bg-gray-100 border border-gray-300 text-gray-900 rounded-md px-4 py-3 pr-12 focus:outline-none focus:border-gray-800 focus:ring-1 focus:ring-gray-800 transition-colors">

                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center bg-transparent border-none text-gray-400 hover:text-gray-600 focus:outline-none cursor-pointer">
                    <span class="material-symbols-outlined select-none text-2xl" x-text="show ? 'visibility_off' : 'visibility'">
                        visibility
                    </span>
                </button>
            </div>
        </div>

        <div class="relative mt-6" x-data="{ show: false }">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
            <div class="relative">
                <input :type="show ? 'text' : 'password'" id="password_confirmation" name="password_confirmation" required
                    class="w-full bg-gray-100 border border-gray-300 text-gray-900 rounded-md px-4 py-3 pr-12 focus:outline-none focus:border-gray-800 focus:ring-1 focus:ring-gray-800 transition-colors">

                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center bg-transparent border-none text-gray-400 hover:text-gray-600 focus:outline-none cursor-pointer">
                    <span class="material-symbols-outlined select-none text-2xl" x-text="show ? 'visibility_off' : 'visibility'">
                        visibility
                    </span>
                </button>
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-gray-900 text-gray-100 hover:bg-gray-800 font-medium rounded-md px-4 py-3 transition-colors shadow-sm">
                Update Password
            </button>
        </div>
    </form>
</x-layouts.auth>