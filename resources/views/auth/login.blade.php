<div>
    <div class="mb-10 text-center sm:text-left">
        <h2 class="text-2xl font-semibold text-gray-900">Log in to your account</h2>
        <p class="text-gray-600 mt-2">Welcome back! Please enter your details.</p>
    </div>

    <form wire:submit="login" class="space-y-6">

        @if (session()->has('error'))
        <x-ui.alert type="error">{{ session('error') }}</x-ui.alert>
        @endif

        <div class="relative">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
            <input type="email" id="email" wire:model="email" required
                class="w-full bg-gray-100 border border-gray-300 text-gray-900 rounded-md px-4 py-3 focus:outline-none focus:border-gray-800 focus:ring-1 focus:ring-gray-800 transition-colors">
            @error('email') <span class="text-red-500 text-xs absolute -bottom-5 left-0">{{ $message }}</span> @enderror
        </div>

        <div class="relative mt-6" x-data="{ show: false }">
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <a href="/forgot-password" class="text-sm font-medium text-gray-900 hover:text-gray-700 underline underline-offset-4 transition-colors">Forgot password?</a>
            </div>

            <div class="relative">
                <input :type="show ? 'text' : 'password'" id="password" wire:model="password" required
                    class="w-full bg-gray-100 border border-gray-300 text-gray-900 rounded-md px-4 py-3 pr-12 focus:outline-none focus:border-gray-800 focus:ring-1 focus:ring-gray-800 transition-colors">

                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 px-3 py-0 flex items-center bg-transparent border-none shadow-none focus:ring-0 outline-none hover:bg-transparent hover:shadow-none hover:translate-y-0 text-gray-400 hover:text-gray-600 cursor-pointer">

                    <span class="material-symbols-outlined select-none text-2xl" x-text="show ? 'visibility' : 'visibility_off'">
                        visibility_off
                    </span>
                </button>
            </div>
            @error('password') <span class="text-red-500 text-xs absolute -bottom-5 left-0">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center pt-2">
            <input type="checkbox" id="remember" wire:model="remember"
                class="h-4 w-4 rounded border-gray-300 text-gray-900 focus:ring-gray-900">
            <label for="remember" class="ml-2 block text-sm text-gray-700">
                Remember me for 30 days
            </label>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-gray-900 text-white hover:bg-gray-800 font-medium rounded-md px-4 py-3 transition-colors shadow-sm relative flex justify-center items-center">
                <span wire:loading.remove>Sign In</span>
                <span wire:loading>Signing in...</span>
            </button>
        </div>
    </form>

    <div class="mt-8 text-center text-sm text-gray-600">
        Don't have an account?
        <a href="{{ route('register') }}" wire:navigate class="font-semibold text-gray-900 hover:text-gray-700 underline underline-offset-4 transition-colors">
            Register here
        </a>
    </div>

</div>