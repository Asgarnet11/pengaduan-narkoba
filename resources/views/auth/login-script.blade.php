@push('scripts')
<script>
    function loginForm() {
        return {
            email: '{{ old("email") }}',
            password: '',
            remember: false,
            emailValid: false,
            passwordStrength: '',
            passwordError: false,
            showPassword: false,
            isLoading: false,

            validateEmail() {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                this.emailValid = emailPattern.test(this.email);
            },

            validatePassword() {
                if (!this.password) {
                    this.passwordStrength = '';
                    this.passwordError = true;
                    return;
                }

                const hasUppercase = /[A-Z]/.test(this.password);
                const hasLowercase = /[a-z]/.test(this.password);
                const hasNumbers = /\d/.test(this.password);
                const hasLength = this.password.length >= 8;

                let strength = 0;
                if (hasUppercase) strength++;
                if (hasLowercase) strength++;
                if (hasNumbers) strength++;
                if (hasLength) strength++;

                this.passwordStrength =
                    strength <= 2 ? 'weak' :
                    strength === 3 ? 'medium' :
                    'strong';

                this.passwordError = strength < 2;
            },

            togglePassword() {
                this.showPassword = !this.showPassword;
            },

            async submitForm() {
                if (!this.emailValid || !this.password) return;

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
