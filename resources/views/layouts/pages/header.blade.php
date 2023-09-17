<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Smarthr - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <title>Login - {{env('APP_NAME')}}</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <link rel="stylesheet" href="{{asset('assets')}}/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{asset('assets')}}/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="{{asset('assets')}}/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/material.css">

    <link rel="stylesheet" href="{{asset('assets')}}/css/line-awesome.min.css">

    <link rel="stylesheet" href="{{asset('assets')}}/css/style.css">
</head>
    <body class="account-page">

            @yield('content');

        <script>
            function validatePassword() {
                const passwordInput = document.getElementById('password');
                const confirmPasswordInput = document.getElementById('confirm-password');
                const passwordMessage = document.getElementById('password-message');
                const confirmpasswordMessage = document.getElementById('confirm-password-message');
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;
    
                const hasUppercase = /[A-Z]/.test(password);
                const hasSpecialCharacter = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(password);
                const hasNumber = /[0-9]/.test(password)
    
                if (hasUppercase && hasSpecialCharacter && hasNumber) {
                    if (password === confirmPassword) {
                        confirmpasswordMessage.textContent = 'Passwords match and are valid';
                        confirmpasswordMessage.style.color = 'green';
                    } else {
                        passwordMessage.textContent = '';
                        confirmpasswordMessage.textContent = 'Passwords do not match';
                        confirmpasswordMessage.style.color = 'red';
                    }
                } else {
                    passwordMessage.textContent = 'Password must have at least one uppercase letter, one number and one special character';
                    passwordMessage.style.color = 'red';
                }
            }
        </script>
        <script src="{{asset('assets')}}/js/jquery-3.7.0.min.js"></script>
        <script src="{{asset('assets')}}/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('assets')}}/js/app.js"></script>
    </body>
</html>