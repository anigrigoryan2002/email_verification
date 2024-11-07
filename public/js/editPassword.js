document.addEventListener("DOMContentLoaded", function() {
    var button = document.getElementById('editPasswordBtn');
    button.addEventListener('click', function() {
        var form = document.getElementById('changePasswordForm');
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
            button.style.display = 'none';
        } else {
            form.style.display = 'none';
            button.style.display = 'block';
        }
    });
});