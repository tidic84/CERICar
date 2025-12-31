function showNotification(message, type = 'info', duration = 4000) {
    const types = {
        success: {
            bg: 'bg-green-400',
            icon: 'check-circle',
            title: 'Succès'
        },
        error: {
            bg: 'bg-red-400',
            icon: 'x-circle',
            title: 'Erreur'
        },
        warning: {
            bg: 'bg-orange-400',
            icon: 'alert-triangle',
            title: 'Attention'
        },
        info: {
            bg: 'bg-blue-400',
            icon: 'info',
            title: 'Information'
        }
    };

    const config = types[type] || types.info;
    const notificationId = 'notif-' + Date.now();

    const notificationHTML = `
        <div id="${notificationId}" class="notification-item transform translate-x-full opacity-0 transition-all duration-300">
            <div class="${config.bg} border-2 border-black rounded-2xl p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] relative overflow-hidden">
                <!-- Barre de progression -->
                ${duration > 0 ? `<div class="notification-progress absolute top-0 left-0 h-1 bg-black"></div>` : ''}

                <div class="flex items-start gap-3">
                    <!-- Icône -->
                    <div class="flex-shrink-0 mt-0.5">
                        <i data-lucide="${config.icon}" class="w-6 h-6 stroke-[3]"></i>
                    </div>

                    <!-- Contenu -->
                    <div class="flex-1 min-w-0">
                        <h4 class="font-black text-lg uppercase mb-1">${config.title}</h4>
                        <p class="font-bold text-sm text-black/80">${message}</p>
                    </div>

                    <!-- Bouton fermer -->
                    <button class="notification-close flex-shrink-0 -mt-1 -mr-1 p-1 hover:scale-110 transition-transform">
                        <i data-lucide="x" class="w-5 h-5 stroke-[3]"></i>
                    </button>
                </div>
            </div>
        </div>
    `;

    $('#notification-container').append(notificationHTML);

    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    const $notification = $(`#${notificationId}`);

    setTimeout(() => {
        $notification.removeClass('translate-x-full opacity-0');
    }, 10);

    $notification.find('.notification-close').on('click', function() {
        closeNotification(notificationId);
    });

    if (duration > 0) {
        $notification.find('.notification-progress').css({
            'width': '100%',
            'transition': `width ${duration}ms linear`
        });

        setTimeout(() => {
            $notification.find('.notification-progress').css('width', '0%');
        }, 10);

        setTimeout(() => {
            closeNotification(notificationId);
        }, duration);
    }

    return notificationId;
}

function closeNotification(notificationId) {
    const $notification = $(`#${notificationId}`);

    $notification.addClass('translate-x-full opacity-0');

    setTimeout(() => {
        $notification.remove();
    }, 300);
}

function showSuccess(message, duration = 4000) {
    return showNotification(message, 'success', duration);
}

function showError(message, duration = 5000) {
    return showNotification(message, 'error', duration);
}

function showWarning(message, duration = 4500) {
    return showNotification(message, 'warning', duration);
}

function showInfo(message, duration = 4000) {
    return showNotification(message, 'info', duration);
}

window.showNotification = showNotification;
window.showSuccess = showSuccess;
window.showError = showError;
window.showWarning = showWarning;
window.showInfo = showInfo;
window.closeNotification = closeNotification;
