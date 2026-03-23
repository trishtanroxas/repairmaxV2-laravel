<x-layouts.auth
    title="Forgot Password | Repairmax"
    heading="Password recovery."
    subheading="Don't worry, it happens. Enter the email address associated with your account, and we'll send you a secure link to reset your password.">

    <div class="mb-10 text-center sm:text-left">
        <h2 class="text-2xl font-semibold text-gray-900">Reset your password</h2>
        <p class="text-gray-600 mt-2">Enter your email to receive a reset link.</p>
    </div>

    <form action="/forgot-password" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
            <input type="email" id="email" name="email" required placeholder="name@example.com"
                class="w-full bg-gray-100 border border-gray-400 text-gray-900 rounded-md px-4 py-3 focus:outline-none focus:border-gray-800 focus:ring-1 focus:ring-gray-800 transition-colors">
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-gray-900 text-gray-100 hover:bg-gray-800 font-medium rounded-md px-4 py-3 transition-colors shadow-sm">
                Send Reset Link
            </button>
        </div>
    </form>

    <div class="mt-8 text-center text-sm text-gray-600">
        <a href="/login" class="inline-flex items-center justify-center gap-1 font-semibold text-gray-900 hover:text-gray-700 transition-colors">
            <span class="underline underline-offset-4">Back to log in</span>
        </a>
    </div>

</x-layouts.auth>