<div>
    <div class="mb-10 text-center sm:text-left">
        <h2 class="text-2xl font-semibold text-gray-900">Create an account</h2>
        <p class="text-gray-600 mt-2">Enter your details below to register.</p>
    </div>

    <form wire:submit="register" class="space-y-6">

        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 sm:col-span-6 relative">
                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                <input type="text" id="first_name" wire:model="first_name" required
                    class="w-full bg-gray-100 border border-gray-300 text-gray-900 rounded-md px-4 py-3 outline-none focus:outline-none focus:ring-0 focus:border-gray-800 transition-colors">
                @error('first_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="col-span-12 sm:col-span-6 relative">
                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                <input type="text" id="last_name" wire:model="last_name" required
                    class="w-full bg-gray-100 border border-gray-300 text-gray-900 rounded-md px-4 py-3 outline-none focus:outline-none focus:ring-0 focus:border-gray-800 transition-colors">
                @error('last_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="relative">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2 mt-4">Email Address</label>
            <input type="email" id="email" wire:model="email" required
                class="w-full bg-gray-100 border border-gray-300 text-gray-900 rounded-md px-4 py-3 outline-none focus:outline-none focus:ring-0 focus:border-gray-800 transition-colors">
            @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4" x-data="{ show: false, pwd: '' }">
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            </div>

            <div class="relative">
                <input :type="show ? 'text' : 'password'" id="password" name="password" autocomplete="new-password"
                    wire:model="password" @input="pwd = $event.target.value" required
                    class="w-full bg-gray-100 border border-gray-300 text-gray-900 rounded-md px-4 py-3 pr-12 outline-none focus:outline-none focus:ring-0 focus:border-gray-800 transition-colors">

                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 flex items-center px-4 bg-transparent border-0 outline-none focus:outline-none focus:ring-0 text-gray-500 hover:text-gray-700 cursor-pointer">
                    <span class="material-symbols-outlined select-none" x-text="show ? 'visibility' : 'visibility_off'">
                        visibility_off
                    </span>
                </button>
            </div>
            @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror

            <div class="mt-4 text-sm text-gray-500"
                x-cloak
                x-show="pwd.length > 0"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
                style="display: none;">
                <p class="mb-2 font-medium">Password requirements:</p>
                <ul class="space-y-1.5">
                    <li class="flex items-center gap-2 transition-colors duration-300" :class="pwd.length >= 8 ? 'text-green-600' : 'text-gray-500'">
                        <span class="material-symbols-outlined text-[18px] select-none" x-text="pwd.length >= 8 ? 'check_circle' : 'radio_button_unchecked'">
                            radio_button_unchecked
                        </span>
                        At least 8 characters
                    </li>

                    <li class="flex items-center gap-2 transition-colors duration-300" :class="(/[A-Z]/.test(pwd) && /[a-z]/.test(pwd)) ? 'text-green-600' : 'text-gray-500'">
                        <span class="material-symbols-outlined text-[18px] select-none" x-text="(/[A-Z]/.test(pwd) && /[a-z]/.test(pwd)) ? 'check_circle' : 'radio_button_unchecked'">
                            radio_button_unchecked
                        </span>
                        Upper and lowercase letters
                    </li>

                    <li class="flex items-center gap-2 transition-colors duration-300" :class="/[0-9]/.test(pwd) ? 'text-green-600' : 'text-gray-500'">
                        <span class="material-symbols-outlined text-[18px] select-none" x-text="/[0-9]/.test(pwd) ? 'check_circle' : 'radio_button_unchecked'">
                            radio_button_unchecked
                        </span>
                        At least one number
                    </li>

                    <li class="flex items-center gap-2 transition-colors duration-300" :class="/[\W_]/.test(pwd) ? 'text-green-600' : 'text-gray-500'">
                        <span class="material-symbols-outlined text-[18px] select-none" x-text="/[\W_]/.test(pwd) ? 'check_circle' : 'radio_button_unchecked'">
                            radio_button_unchecked
                        </span>
                        At least one symbol (e.g., !@#$%)
                    </li>
                </ul>
            </div>
        </div>

        <div class="pt-6">
            <button type="submit" class="w-full bg-gray-900 text-gray-100 hover:bg-gray-800 font-medium rounded-md px-4 py-3 transition-colors shadow-sm relative flex justify-center items-center disabled:opacity-50" wire:loading.attr="disabled">
                <span wire:loading.remove>Register Account</span>
                <span wire:loading>Creating Account...</span>
            </button>
        </div>
    </form>

    <div class="mt-8 text-center text-sm text-gray-600">
        Already have an account?
        <a href="/login" wire:navigate class="font-semibold text-gray-900 hover:text-gray-700 underline underline-offset-4 transition-colors">
            Log in here
        </a>
    </div>
</div>