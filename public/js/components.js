// assets/js/components.js

document.addEventListener('DOMContentLoaded', () => {
    // Inject global toast container if it doesn't exist
    if (!document.getElementById('toast-container')) {
        const toastWrapper = document.createElement('div');
        toastWrapper.id = 'toast-container';
        document.body.appendChild(toastWrapper);
    }
});

const UI = {
    /**
     * TOAST NOTIFICATION
     * Usage: UI.toast('Profile updated!', 'success');
     */
    toast: function (message, type = 'success', duration = 3000) {
        const container = document.getElementById('toast-container');
        const toast = document.createElement('div');

        // Define colors and icons based on type
        let bg, icon, textColor;
        if (type === 'success') {
            bg = 'bg-green-50 border-green-200';
            textColor = 'text-green-800';
            icon = '<span class="material-symbols-outlined text-green-500">check_circle</span>';
        } else if (type === 'error') {
            bg = 'bg-red-50 border-red-200';
            textColor = 'text-red-800';
            icon = '<span class="material-symbols-outlined text-red-500">error</span>';
        } else if (type === 'warning') {
            bg = 'bg-yellow-50 border-yellow-200';
            textColor = 'text-yellow-800';
            icon = '<span class="material-symbols-outlined text-yellow-500">warning</span>';
        } else {
            bg = 'bg-gray-800 border-gray-700';
            textColor = 'text-gray-100';
            icon = '<span class="material-symbols-outlined text-gray-300">info</span>';
        }

        toast.className = `flex items-center w-full max-w-sm p-4 rounded-xl border shadow-lg anim-slide-in ${bg} ${textColor}`;
        toast.innerHTML = `
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg">
                ${icon}
            </div>
            <div class="ml-3 text-sm font-medium">${message}</div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 p-1.5 inline-flex items-center justify-center h-8 w-8 hover:bg-black/5 transition-colors" aria-label="Close" onclick="this.parentElement.remove()">
                <span class="material-symbols-outlined text-lg">close</span>
            </button>
        `;

        container.appendChild(toast);

        // Auto remove
        setTimeout(() => {
            toast.classList.replace('anim-slide-in', 'anim-slide-out');
            setTimeout(() => toast.remove(), 300); // Wait for animation to finish
        }, duration);
    },

    /**
     * ALERT BOX
     * Injects an alert into a specific target div
     * Usage: UI.alert('alert-box', 'Invalid credentials', 'error');
     */
    alert: function (targetId, message, type = 'error') {
        const target = document.getElementById(targetId);
        if (!target) return;

        let bg, textColor, icon;
        if (type === 'error') {
            bg = 'bg-red-50 border-red-500';
            textColor = 'text-red-700';
            icon = 'error';
        } else if (type === 'success') {
            bg = 'bg-green-50 border-green-500';
            textColor = 'text-green-700';
            icon = 'check_circle';
        } else {
            bg = 'bg-blue-50 border-blue-500';
            textColor = 'text-blue-700';
            icon = 'info';
        }

        target.innerHTML = `
            <div class="flex p-4 mb-4 border-l-4 rounded-r-md anim-fade-in ${bg} ${textColor}" role="alert">
                <span class="material-symbols-outlined mr-3">${icon}</span>
                <div class="text-sm font-medium">${message}</div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 rounded-lg p-1.5 hover:bg-black/5 inline-flex items-center justify-center h-8 w-8" onclick="this.parentElement.remove()">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>
        `;
    },

    /**
     * MODAL
     * Usage: UI.modal.open('myModalId'); UI.modal.close('myModalId');
     */
    modal: {
        open: function (id) {
            const modal = document.getElementById(id);
            if (!modal) return;
            modal.classList.remove('hidden');
            modal.querySelector('.modal-overlay').classList.add('anim-fade-in');
            modal.querySelector('.modal-content').classList.add('anim-scale-in');
            document.body.classList.add('modal-open');
        },
        close: function (id) {
            const modal = document.getElementById(id);
            if (!modal) return;
            const overlay = modal.querySelector('.modal-overlay');
            const content = modal.querySelector('.modal-content');

            overlay.classList.replace('anim-fade-in', 'anim-fade-out');
            content.classList.replace('anim-scale-in', 'anim-fade-out');

            setTimeout(() => {
                modal.classList.add('hidden');
                overlay.classList.remove('anim-fade-out');
                content.classList.remove('anim-fade-out');
                document.body.classList.remove('modal-open');
            }, 200);
        }
    },

    /**
     * CONFIRMATION DIALOG (Returns a Promise)
     * Usage: 
     * if (await UI.confirm('Delete Ticket?', 'This action cannot be undone.')) {
     * // User clicked Yes
     * }
     */
    confirm: function (title, message, confirmText = 'Confirm', cancelText = 'Cancel', type = 'danger') {
        return new Promise((resolve) => {
            const overlay = document.createElement('div');
            overlay.className = 'fixed inset-0 z-[100] flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm anim-fade-in';

            const btnColor = type === 'danger' ? 'bg-red-600 hover:bg-red-700' : 'bg-gray-900 hover:bg-gray-800';
            const iconColor = type === 'danger' ? 'text-red-600 bg-red-100' : 'text-blue-600 bg-blue-100';
            const iconName = type === 'danger' ? 'warning' : 'help';

            const dialog = document.createElement('div');
            dialog.className = 'bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 text-center anim-scale-in';
            dialog.innerHTML = `
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full mb-5 ${iconColor}">
                    <span class="material-symbols-outlined text-3xl">${iconName}</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">${title}</h3>
                <p class="text-gray-500 mb-8">${message}</p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <button id="confirm-cancel-btn" class="px-6 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition-colors w-full sm:w-auto">
                        ${cancelText}
                    </button>
                    <button id="confirm-ok-btn" class="px-6 py-2.5 rounded-xl text-white font-semibold transition-colors w-full sm:w-auto ${btnColor}">
                        ${confirmText}
                    </button>
                </div>
            `;

            overlay.appendChild(dialog);
            document.body.appendChild(overlay);

            const cleanup = (result) => {
                overlay.classList.replace('anim-fade-in', 'anim-fade-out');
                dialog.classList.replace('anim-scale-in', 'anim-fade-out');
                setTimeout(() => overlay.remove(), 200);
                resolve(result);
            };

            document.getElementById('confirm-ok-btn').addEventListener('click', () => cleanup(true));
            document.getElementById('confirm-cancel-btn').addEventListener('click', () => cleanup(false));
        });
    }
};