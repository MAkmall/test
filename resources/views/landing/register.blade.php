<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - SPK Beasiswa</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
            padding: 2rem 0;
        }

        /* Animated background shapes */
        .bg-shape {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .bg-shape:nth-child(1) {
            top: 5%;
            left: 10%;
            width: 120px;
            height: 120px;
            background: white;
            border-radius: 50%;
            animation-delay: 0s;
        }

        .bg-shape:nth-child(2) {
            top: 60%;
            right: 5%;
            width: 180px;
            height: 180px;
            background: white;
            border-radius: 30%;
            animation-delay: 2s;
        }

        .bg-shape:nth-child(3) {
            bottom: 10%;
            left: 15%;
            width: 100px;
            height: 100px;
            background: white;
            border-radius: 20%;
            animation-delay: 4s;
        }

        .bg-shape:nth-child(4) {
            top: 30%;
            right: 20%;
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 50%;
            animation-delay: 1s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-25px) rotate(15deg); }
        }

        .register-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            padding: 2.5rem;
            width: 100%;
            max-width: 500px;
            position: relative;
            z-index: 10;
            animation: slideUp 0.8s ease-out;
            margin: 1rem;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .logo i {
            font-size: 2rem;
            color: white;
        }

        .header h1 {
            color: #333;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .header p {
            color: #666;
            font-size: 1rem;
            line-height: 1.5;
        }

        .form-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
            flex: 1;
        }

        .form-group.full-width {
            flex: 1 1 100%;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .input-wrapper {
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .form-control.error {
            border-color: #e74c3c;
            box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1);
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .form-control:focus + .input-icon {
            color: #667eea;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            cursor: pointer;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #667eea;
        }

        .error-text {
            color: #e74c3c;
            font-size: 0.8rem;
            margin-top: 0.5rem;
            display: none;
        }

        .terms-group {
            margin-bottom: 1.5rem;
        }

        .terms-checkbox {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .terms-checkbox input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #667eea;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .terms-checkbox a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .terms-checkbox a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .btn-register {
            width: 100%;
            padding: 1.2rem;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-register::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-register:hover::before {
            left: 100%;
        }

        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        }

        .btn-register:active {
            transform: translateY(-1px);
        }

        .btn-register:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e1e5e9;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #764ba2;
        }

        .success-message, .error-message {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            display: none;
            animation: slideDown 0.3s ease-out;
        }

        .success-message {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border: 1px solid #b8dacc;
            color: #155724;
        }

        .error-message {
            background: linear-gradient(135deg, #f8d7da, #f1b0b7);
            border: 1px solid #f1b0b7;
            color: #721c24;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .progress-indicator {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .progress-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #e1e5e9;
            transition: all 0.3s ease;
        }

        .progress-dot.active {
            background: #667eea;
            transform: scale(1.2);
        }

        /* Loading animation */
        .btn-register.loading {
            pointer-events: none;
        }

        .btn-register.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid transparent;
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
            
            .register-container {
                padding: 2rem;
                margin: 0.5rem;
            }
            
            .header h1 {
                font-size: 1.6rem;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 1rem 0;
            }
            
            .register-container {
                padding: 1.5rem;
            }
            
            .header h1 {
                font-size: 1.4rem;
            }
        }
    </style>
</head>
<body>
    <!-- Background shapes -->
    <div class="bg-shape"></div>
    <div class="bg-shape"></div>
    <div class="bg-shape"></div>
    <div class="bg-shape"></div>

    <div class="register-container">
        <div class="header">
            <div class="logo">
                <i class="fas fa-user-plus"></i>
            </div>
            <h1>Daftar Akun</h1>
            <p>Bergabunglah dengan Sistem Pendukung Keputusan Beasiswa</p>
        </div>

        <div class="progress-indicator">
            <div class="progress-dot active"></div>
            <div class="progress-dot"></div>
            <div class="progress-dot"></div>
        </div>

        <div class="success-message" id="successMessage">
            <i class="fas fa-check-circle"></i>
            Pendaftaran berhasil! Silakan cek email untuk verifikasi.
        </div>

        <div class="error-message" id="errorMessage">
            <i class="fas fa-exclamation-circle"></i>
            <span id="errorText">Terjadi kesalahan, silakan coba lagi.</span>
        </div>

        <form id="registerForm">
            <div class="form-row">
                <div class="form-group">
                    <label for="firstName">Nama Depan</label>
                    <div class="input-wrapper">
                        <input type="text" id="firstName" class="form-control" placeholder="Nama depan" required>
                        <i class="fas fa-user input-icon"></i>
                    </div>
                    <div class="error-text" id="firstNameError"></div>
                </div>

                <div class="form-group">
                    <label for="lastName">Nama Belakang</label>
                    <div class="input-wrapper">
                        <input type="text" id="lastName" class="form-control" placeholder="Nama belakang" required>
                        <i class="fas fa-user input-icon"></i>
                    </div>
                    <div class="error-text" id="lastNameError"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-wrapper">
                    <input type="email" id="email" class="form-control" placeholder="contoh@email.com" required>
                    <i class="fas fa-envelope input-icon"></i>
                </div>
                <div class="error-text" id="emailError"></div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="phone">Nomor Telepon</label>
                    <div class="input-wrapper">
                        <input type="tel" id="phone" class="form-control" placeholder="08xxxxxxxxxx" required>
                        <i class="fas fa-phone input-icon"></i>
                    </div>
                    <div class="error-text" id="phoneError"></div>
                </div>

                <div class="form-group">
                    <label for="nim">NIM/NIS</label>
                    <div class="input-wrapper">
                        <input type="text" id="nim" class="form-control" placeholder="NIM/NIS" required>
                        <i class="fas fa-id-card input-icon"></i>
                    </div>
                    <div class="error-text" id="nimError"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="university">Universitas/Sekolah</label>
                <div class="input-wrapper">
                    <input type="text" id="university" class="form-control" placeholder="Nama universitas/sekolah" required>
                    <i class="fas fa-graduation-cap input-icon"></i>
                </div>
                <div class="error-text" id="universityError"></div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" class="form-control" placeholder="Minimal 8 karakter" required>
                        <i class="fas fa-lock input-icon"></i>
                        <i class="fas fa-eye password-toggle" onclick="togglePassword('password')"></i>
                    </div>
                    <div class="error-text" id="passwordError"></div>
                </div>

                <div class="form-group">
                    <label for="confirmPassword">Konfirmasi Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="confirmPassword" class="form-control" placeholder="Ulangi password" required>
                        <i class="fas fa-lock input-icon"></i>
                        <i class="fas fa-eye password-toggle" onclick="togglePassword('confirmPassword')"></i>
                    </div>
                    <div class="error-text" id="confirmPasswordError"></div>
                </div>
            </div>

            <div class="terms-group">
                <div class="terms-checkbox">
                    <input type="checkbox" id="terms" required>
                    <label for="terms">
                        Saya menyetujui <a href="#" target="_blank">Syarat dan Ketentuan</a> 
                        serta <a href="#" target="_blank">Kebijakan Privasi</a> yang berlaku.
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-register">
                <span class="btn-text">Daftar Sekarang</span>
            </button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="#">Masuk di sini</a>
        </div>
    </div>

    <script>
        let currentStep = 0;
        const progressDots = document.querySelectorAll('.progress-dot');

        function updateProgress() {
            progressDots.forEach((dot, index) => {
                dot.classList.toggle('active', index <= currentStep);
            });
        }

        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.parentElement.querySelector('.password-toggle');
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        function validateField(fieldId, errorId, validator) {
            const field = document.getElementById(fieldId);
            const errorElement = document.getElementById(errorId);
            const isValid = validator(field.value);
            
            field.classList.toggle('error', !isValid.valid);
            errorElement.textContent = isValid.valid ? '' : isValid.message;
            errorElement.style.display = isValid.valid ? 'none' : 'block';
            
            return isValid.valid;
        }

        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email) return { valid: false, message: 'Email wajib diisi' };
            if (!emailRegex.test(email)) return { valid: false, message: 'Format email tidak valid' };
            return { valid: true };
        }

        function validatePhone(phone) {
            const phoneRegex = /^(\+62|62|0)[0-9]{9,13}$/;
            if (!phone) return { valid: false, message: 'Nomor telepon wajib diisi' };
            if (!phoneRegex.test(phone)) return { valid: false, message: 'Format nomor telepon tidak valid' };
            return { valid: true };
        }

        function validatePassword(password) {
            if (!password) return { valid: false, message: 'Password wajib diisi' };
            if (password.length < 8) return { valid: false, message: 'Password minimal 8 karakter' };
            if (!/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/.test(password)) {
                return { valid: false, message: 'Password harus mengandung huruf besar, kecil, dan angka' };
            }
            return { valid: true };
        }

        function validateConfirmPassword(password, confirmPassword) {
            if (!confirmPassword) return { valid: false, message: 'Konfirmasi password wajib diisi' };
            if (password !== confirmPassword) return { valid: false, message: 'Password tidak cocok' };
            return { valid: true };
        }

        function validateRequired(value, fieldName) {
            if (!value.trim()) return { valid: false, message: `${fieldName} wajib diisi` };
            return { valid: true };
        }

        // Real-time validation
        document.getElementById('email').addEventListener('blur', function() {
            validateField('email', 'emailError', validateEmail);
        });

        document.getElementById('phone').addEventListener('blur', function() {
            validateField('phone', 'phoneError', validatePhone);
        });

        document.getElementById('password').addEventListener('input', function() {
            const isValid = validateField('password', 'passwordError', validatePassword);
            if (isValid) currentStep = Math.max(currentStep, 1);
            updateProgress();
        });

        document.getElementById('confirmPassword').addEventListener('blur', function() {
            const password = document.getElementById('password').value;
            validateField('confirmPassword', 'confirmPasswordError', 
                (value) => validateConfirmPassword(password, value));
        });

        // Form submission
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const btn = document.querySelector('.btn-register');
            const btnText = document.querySelector('.btn-text');
            const errorMsg = document.getElementById('errorMessage');
            const successMsg = document.getElementById('successMessage');
            
            // Hide messages
            errorMsg.style.display = 'none';
            successMsg.style.display = 'none';
            
            // Validate all fields
            const validations = [
                validateField('firstName', 'firstNameError', (value) => validateRequired(value, 'Nama depan')),
                validateField('lastName', 'lastNameError', (value) => validateRequired(value, 'Nama belakang')),
                validateField('email', 'emailError', validateEmail),
                validateField('phone', 'phoneError', validatePhone),
                validateField('nim', 'nimError', (value) => validateRequired(value, 'NIM/NIS')),
                validateField('university', 'universityError', (value) => validateRequired(value, 'Universitas/Sekolah')),
                validateField('password', 'passwordError', validatePassword),
                validateField('confirmPassword', 'confirmPasswordError', 
                    (value) => validateConfirmPassword(document.getElementById('password').value, value))
            ];
            
            const termsChecked = document.getElementById('terms').checked;
            if (!termsChecked) {
                document.getElementById('errorText').textContent = 'Anda harus menyetujui syarat dan ketentuan';
                errorMsg.style.display = 'block';
                return;
            }
            
            if (!validations.every(v => v)) {
                document.getElementById('errorText').textContent = 'Mohon periksa kembali data yang Anda masukkan';
                errorMsg.style.display = 'block';
                return;
            }
            
            // Show loading
            btn.classList.add('loading');
            btnText.textContent = 'Mendaftarkan...';
            btn.disabled = true;
            
            // Simulate registration process
            setTimeout(() => {
                currentStep = 2;
                updateProgress();
                successMsg.style.display = 'block';
                btn.classList.remove('loading');
                btnText.textContent = 'Pendaftaran Berhasil!';
                
                setTimeout(() => {
                    alert('Pendaftaran berhasil! Silakan cek email untuk verifikasi akun Anda.');
                }, 1500);
            }, 2000);
        });

        // Add smooth focus animations
        document.querySelectorAll('.form-control').forEach((input, index) => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
                this.parentElement.style.zIndex = '10';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
                this.parentElement.style.zIndex = '1';
            });
        });
    </script>
</body>
</html>