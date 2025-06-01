@push('scripts')
<script>
    function registerForm() {
        return {
            currentStep: 1,
            isLoading: false,
            formError: null,
            showPassword: false,
            // Step 1 fields
            name: '{{ old("name") }}',
            email: '{{ old("email") }}',
            nik: '{{ old("nik") }}',
            telp: '{{ old("telp") }}',
            nameValid: false,
            emailValid: false,
            nikValid: false,
            telpValid: false,

            // Step 2 fields
            password: '',
            passwordConfirmation: '',
            showPassword: false,
            passwordStrength: '',
            passwordMatch: false,
            passwordLength: false,
            hasUppercase: false,
            hasLowercase: false,
            hasNumber: false,

            validateName() {
                const namePattern = /^[a-zA-Z\s\u00C0-\u024F]{3,}$/;
                this.name = this.name.replace(/[^a-zA-Z\s\u00C0-\u024F]/g, '');
                this.nameValid = namePattern.test(this.name.trim());
            },

            validateEmail() {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                this.emailValid = emailPattern.test(this.email);
            },

            validateNik() {
                this.nik = this.nik.replace(/[^0-9]/g, '').slice(0, 16);
                this.nikValid = this.nik.length === 16;
            },

            validateTelp() {
                this.telp = this.telp.replace(/[^0-9]/g, '').slice(0, 15);
                this.telpValid = this.telp.length >= 10 && this.telp.length <= 15;
            },

            validatePassword() {
                if (!this.password) {
                    this.resetPasswordValidation();
                    return;
                }

                this.passwordLength = this.password.length >= 8;
                this.hasUppercase = /[A-Z]/.test(this.password);
                this.hasLowercase = /[a-z]/.test(this.password);
                this.hasNumber = /[0-9]/.test(this.password);

                const strength = [this.passwordLength, this.hasUppercase, this.hasLowercase, this.hasNumber].filter(Boolean).length;

                this.passwordStrength =
                    strength <= 2 ? 'weak' :
                    strength === 3 ? 'medium' :
                    'strong';

                this.validatePasswordMatch();
            },

            validatePasswordMatch() {
                this.passwordMatch = this.password && this.password === this.passwordConfirmation;
            },

            resetPasswordValidation() {
                this.passwordStrength = '';
                this.passwordLength = false;
                this.hasUppercase = false;
                this.hasLowercase = false;
                this.hasNumber = false;
                this.passwordMatch = false;
            },

            togglePassword() {
                this.showPassword = !this.showPassword;
            },

            get canProceed() {
                return this.nameValid && this.emailValid && this.nikValid && this.telpValid;
            },

            get canSubmit() {
                return this.canProceed &&
                       this.passwordStrength !== 'weak' &&
                       this.password.length >= 8 &&
                       this.passwordMatch &&
                       !this.isLoading;
            },

            nextStep() {
                if (this.canProceed) {
                    this.currentStep = 2;
                }
            },

            prevStep() {
                this.currentStep = 1;
            },            socialLogin(provider) {
                window.location.href = `/auth/${provider}`;
            },

            async submitForm(event) {
                if (!this.canSubmit) return;

                event.preventDefault();
                this.isLoading = true;
                this.formError = null;

                try {
                    const form = event.target;
                    const formData = new FormData(form);

                    // Add CSRF token
                    formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        credentials: 'same-origin'
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        if (result.errors) {
                            // Handle validation errors
                            let errorMessage = '<ul class="list-disc pl-4">';
                            Object.values(result.errors).forEach(errors => {
                                errors.forEach(error => {
                                    errorMessage += `<li>${error}</li>`;
                                });
                            });
                            errorMessage += '</ul>';
                            throw new Error(errorMessage);
                        } else {
                            throw new Error(result.message || 'Terjadi kesalahan saat mendaftar');
                        }
                    }

                    // Show success message
                    const successMessage = document.createElement('div');
                    successMessage.className = 'fixed top-4 right-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded';
                    successMessage.innerHTML = `
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-green-500 text-xl"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium">Pendaftaran berhasil! Mengalihkan ke halaman login...</p>
                            </div>
                        </div>
                    `;
                    document.body.appendChild(successMessage);

                    // Redirect after showing success message
                    setTimeout(() => {
                        window.location.href = result.redirect || '/login';
                    }, 2000);

                } catch (error) {
                    this.formError = error.message;
                    // Scroll to top to show error
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                } finally {
                    this.isLoading = false;
                }
            },

            prevStep() {
                this.currentStep = 1;
            },

            async submitForm() {
                if (!this.canSubmit) return;

                this.isLoading = true;
                try {
                    this.$el.submit();
                } catch (error) {
                    console.error('Error:', error);
                    this.isLoading = false;
                }
            }
        }
    }
</script>
@endpush
