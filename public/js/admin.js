document.addEventListener('DOMContentLoaded', function () {
    var toggle = document.querySelector('[data-sidebar-toggle]');
    var sidebar = document.querySelector('[data-sidebar]');
    var backdrop = document.querySelector('[data-sidebar-backdrop]');

    if (toggle && sidebar) {
        toggle.addEventListener('click', function () {
            sidebar.classList.toggle('is-open');
            if (backdrop) {
                backdrop.classList.toggle('is-visible');
            }
        });
    }

    if (backdrop) {
        backdrop.addEventListener('click', function () {
            if (sidebar) {
                sidebar.classList.remove('is-open');
            }
            backdrop.classList.remove('is-visible');
        });
    }

    document.querySelectorAll('[data-alert-close]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var alert = btn.closest('.alert');
            if (alert) {
                alert.remove();
            }
        });
    });

    document.querySelectorAll('form[data-confirm]').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            var message = form.getAttribute('data-confirm') || 'Apakah Anda yakin?';
            if (!window.confirm(message)) {
                e.preventDefault();
            }
        });
    });
});