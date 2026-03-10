/**
 * Toggles the visibility of password input fields and updates the eye icon.
 */
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (!input || !icon) return;

    if (input.type === 'password') {
        input.type = 'text';
        icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />`;
    } else {
        input.type = 'password';
        icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />`;
    }
}

/**
 * Custom Javascript Toast Notification
 * Creates a floating Tailwind CSS alert on the screen dynamically.
 */
function showLocalToast(message, type = 'success') {
    // Check if container exists, if not create it
    let toastContainer = document.getElementById('local-toast-container');
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.id = 'local-toast-container';
        toastContainer.className = 'fixed top-5 right-5 z-50 flex flex-col gap-3 pointer-events-none';
        document.body.appendChild(toastContainer);
    }

    const toast = document.createElement('div');
    const bgColor = type === 'success' ? 'bg-green-600' : 'bg-red-600';

    // SVG Icons
    const successIcon = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>`;
    const errorIcon = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>`;

    toast.className = `${bgColor} text-white px-6 py-4 rounded-lg shadow-xl flex items-center gap-3 transform transition-all duration-300 translate-y-[-100%] opacity-0`;
    toast.innerHTML = `
        <svg class="w-6 h-6 text-white shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            ${type === 'success' ? successIcon : errorIcon}
        </svg>
        <span class="font-medium">${message}</span>
    `;

    toastContainer.appendChild(toast);

    // Trigger animation slightly after appending to DOM
    requestAnimationFrame(() => {
        toast.classList.remove('translate-y-[-100%]', 'opacity-0');
    });

    // Remove toast after 4 seconds
    setTimeout(() => {
        toast.classList.add('opacity-0', 'translate-y-[-20%]');
        setTimeout(() => toast.remove(), 300); // Wait for transition to finish
    }, 4000);
}

// Ensure the DOM is fully loaded before attaching event listeners
document.addEventListener('DOMContentLoaded', () => {
    const sendOtpBtn = document.getElementById('sendOtpBtn');
    const emailInput = document.getElementById('email');

    if (!sendOtpBtn) return; // Exit if button isn't on this page

    let cooldownTimer = null;

    // Function to handle the button cooldown UI
    function startCooldown(endTime) {
        sendOtpBtn.disabled = true;
        sendOtpBtn.classList.add('opacity-75', 'cursor-not-allowed');

        cooldownTimer = setInterval(() => {
            const now = new Date().getTime();
            const distance = endTime - now;

            if (distance <= 0) {
                // Cooldown finished
                clearInterval(cooldownTimer);
                localStorage.removeItem('otpCooldownEnd');
                sendOtpBtn.disabled = false;
                sendOtpBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                sendOtpBtn.innerHTML = 'Send OTP';
            } else {
                // Calculate minutes and seconds
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Format output (e.g., 1:05)
                const formattedSeconds = seconds < 10 ? '0' + seconds : seconds;
                sendOtpBtn.innerHTML = `Wait ${minutes}:${formattedSeconds}`;
            }
        }, 1000);
    }

    // Check if there's an active cooldown on page load (prevents bypass via refresh)
    const storedCooldown = localStorage.getItem('otpCooldownEnd');
    if (storedCooldown) {
        const now = new Date().getTime();
        if (storedCooldown > now) {
            startCooldown(storedCooldown);
        } else {
            localStorage.removeItem('otpCooldownEnd'); // Clean up expired timer
        }
    }

    sendOtpBtn.addEventListener('click', async function () {
        const email = emailInput ? emailInput.value.trim() : '';

        // Validation
        if (!email) {
            showLocalToast('Please enter an email address first.', 'error');
            return;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showLocalToast('Please enter a valid email address.', 'error');
            return;
        }

        // Show loading state
        const originalBtnText = this.innerHTML;
        this.disabled = true;
        this.innerHTML = `<span class="inline-flex items-center gap-2"><svg class="animate-spin h-4 w-4 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Sending...</span>`;
        this.classList.add('opacity-75', 'cursor-not-allowed');

        try {
            const response = await fetch('/api/auth/send-otp', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email: email })
            });

            const contentType = response.headers.get("content-type");
            if (!contentType || !contentType.includes("application/json")) {
                throw new TypeError("Backend did not return JSON. Check your PHP script.");
            }

            const data = await response.json();

            if (data.status === 'success') {
                showLocalToast(data.message, 'success');

                // Set 2 minute (120,000 milliseconds) cooldown
                const endTime = new Date().getTime() + 120000;
                localStorage.setItem('otpCooldownEnd', endTime);
                startCooldown(endTime);

            } else {
                showLocalToast(data.message || 'An error occurred.', 'error');
                // Reset button on logic failure
                this.disabled = false;
                this.innerHTML = originalBtnText;
                this.classList.remove('opacity-75', 'cursor-not-allowed');
            }

        } catch (error) {
            console.error('Error sending OTP:', error);
            showLocalToast('A network error occurred. Check your console.', 'error');

            // Reset button on network failure
            this.disabled = false;
            this.innerHTML = originalBtnText;
            this.classList.remove('opacity-75', 'cursor-not-allowed');
        }
    });
});