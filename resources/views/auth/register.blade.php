@extends('layouts.app')

@section('title', 'Register')

@include('auth.register-script')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-indigo-50 via-white to-blue-50">
    <div class="max-w-md w-full">
        <div class="bg-white rounded-2xl shadow-xl p-8 space-y-8">
            <!-- Animated Header -->
            <div class="text-center" data-aos="fade-down">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 mb-4 animate-bounce-slow">
                    <i class="fas fa-user-plus text-3xl text-indigo-600"></i>
                </div>
                <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 mb-2">
                    Daftar Akun Baru
                </h2>
                <p class="text-sm text-gray-600">
                    Atau
                    <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors hover:underline">
                        masuk ke akun yang sudah ada
                    </a>
                </p>
            </div>

            <!-- Steps Indicator -->
            <div class="relative" x-data="{ currentStep: 1 }">
                <div class="flex justify-between items-center w-full mb-4">
                    <div class="w-full flex items-center">
                        <div class="relative flex items-center text-indigo-600">
                            <div class="rounded-full transition duration-500 ease-in-out h-12 w-12 py-3 border-2 border-indigo-600 text-center font-bold"
                                :class="{'bg-indigo-600 text-white': currentStep >= 1}">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="absolute top-0 -ml-10 text-center mt-16 w-32 text-xs font-medium uppercase text-indigo-600">Data Diri</div>
                        </div>
                        <div class="flex-auto border-t-2 transition duration-500 ease-in-out"
                            :class="{'border-indigo-600': currentStep > 1, 'border-gray-300': currentStep <= 1}"></div>
                        <div class="relative flex items-center text-gray-500">
                            <div class="rounded-full transition duration-500 ease-in-out h-12 w-12 py-3 border-2 text-center font-bold"
                                :class="{'border-indigo-600 text-indigo-600': currentStep >= 2, 'border-gray-300': currentStep < 2, 'bg-indigo-600 text-white': currentStep > 2}">
                                <i class="fas fa-lock"></i>
                            </div>
                            <div class="absolute top-0 -ml-10 text-center mt-16 w-32 text-xs font-medium uppercase"
                                :class="{'text-indigo-600': currentStep >= 2, 'text-gray-500': currentStep < 2}">Keamanan</div>
                        </div>
                    </div>
                </div>
            </div>

                        <!-- Error Messages -->
            <template x-if="formError || '{{ session('error') }}'">
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg animate__animated animate__shakeX" role="alert">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <p x-text="formError" class="text-sm font-medium" x-show="formError"></p>
                            @if(session('error'))
                                <p class="text-sm font-medium">{{ session('error') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </template>

            <!-- Loading Overlay -->
            <div x-show="isLoading"
                 class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center"
                 style="display: none;">
                <div class="bg-white rounded-lg p-6 flex items-center space-x-4 animate__animated animate__fadeIn">
                    <i class="fas fa-circle-notch fa-spin text-indigo-600 text-2xl"></i>
                    <span class="text-gray-700 font-medium">Memproses pendaftaran...</span>
                </div>
            </div>

            <form x-data="registerForm()"
                  @submit.prevent="submitForm"
                  method="POST"
                  action="{{ route('register') }}"
                  class="mt-8 space-y-6">
                @csrf

                <!-- Progress Bar -->
                <div class="relative pt-1 mb-6">
                    <div class="overflow-hidden h-2 text-xs flex rounded bg-indigo-100">
                        <div x-bind:style="'width: ' + (currentStep === 1 ? '50%' : '100%')"
                             class="transition-all duration-500 shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-indigo-600">
                        </div>
                    </div>
                </div>

                <!-- Step 1: Data Diri -->
                <div x-show="currentStep === 1"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-x-6"
                     x-transition:enter-end="opacity-100 transform translate-x-0"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 transform translate-x-0"
                     x-transition:leave-end="opacity-0 transform -translate-x-6">
                    <div class="space-y-4">
                        <!-- Nama Lengkap -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user" :class="{'text-green-500': nameValid, 'text-gray-400': !nameValid}"></i>
                                </div>
                                <input id="name"
                                       type="text"
                                       name="name"
                                       x-model="name"
                                       @input="validateName"
                                       class="pl-10 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 transition-all duration-200"
                                       :class="{'border-green-500 focus:border-green-500 focus:ring-green-500': nameValid && name,
                                               'border-red-500 focus:border-red-500 focus:ring-red-500': !nameValid && name}"
                                       placeholder="Masukkan nama lengkap"
                                       required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i x-show="nameValid && name" class="fas fa-check text-green-500 animate__animated animate__fadeIn"></i>
                                    <i x-show="!nameValid && name" class="fas fa-times text-red-500 animate__animated animate__fadeIn"></i>
                                </div>
                            </div>
                            <p x-show="!nameValid && name" class="mt-1 text-sm text-red-600 animate__animated animate__fadeIn">
                                Nama harus minimal 3 karakter dan hanya berisi huruf
                            </p>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope" :class="{'text-green-500': emailValid, 'text-gray-400': !emailValid}"></i>
                                </div>
                                <input id="email"
                                       type="email"
                                       name="email"
                                       x-model="email"
                                       @input.debounce.300ms="validateEmail"
                                       class="pl-10 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 transition-all duration-200"
                                       :class="{'border-green-500 focus:border-green-500 focus:ring-green-500': emailValid && email,
                                               'border-red-500 focus:border-red-500 focus:ring-red-500': !emailValid && email}"
                                       placeholder="nama@email.com"
                                       required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i x-show="emailValid && email" class="fas fa-check text-green-500 animate__animated animate__fadeIn"></i>
                                    <i x-show="!emailValid && email" class="fas fa-times text-red-500 animate__animated animate__fadeIn"></i>
                                </div>
                            </div>
                            <p x-show="!emailValid && email" class="mt-1 text-sm text-red-600 animate__animated animate__fadeIn">
                                Format email tidak valid
                            </p>
                        </div>

                        <!-- NIK -->
                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-id-card" :class="{'text-green-500': nikValid, 'text-gray-400': !nikValid}"></i>
                                </div>
                                <input id="nik"
                                       type="text"
                                       name="nik"
                                       x-model="nik"
                                       @input="validateNik"
                                       maxlength="16"
                                       class="pl-10 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 transition-all duration-200"
                                       :class="{'border-green-500 focus:border-green-500 focus:ring-green-500': nikValid && nik,
                                               'border-red-500 focus:border-red-500 focus:ring-red-500': !nikValid && nik}"
                                       placeholder="Masukkan 16 digit NIK"
                                       required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <span x-show="nik" class="text-sm text-gray-500" x-text="`${nik.length}/16`"></span>
                                </div>
                            </div>
                            <p x-show="!nikValid && nik" class="mt-1 text-sm text-red-600 animate__animated animate__fadeIn">
                                NIK harus 16 digit angka
                            </p>
                        </div>

                        <!-- Nomor Telepon -->
                        <div>
                            <label for="telp" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-phone" :class="{'text-green-500': telpValid, 'text-gray-400': !telpValid}"></i>
                                </div>
                                <input id="telp"
                                       type="tel"
                                       name="telp"
                                       x-model="telp"
                                       @input="validateTelp"
                                       maxlength="15"
                                       class="pl-10 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 transition-all duration-200"
                                       :class="{'border-green-500 focus:border-green-500 focus:ring-green-500': telpValid && telp,
                                               'border-red-500 focus:border-red-500 focus:ring-red-500': !telpValid && telp}"
                                       placeholder="Contoh: 081234567890"
                                       required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i x-show="telpValid && telp" class="fas fa-check text-green-500 animate__animated animate__fadeIn"></i>
                                    <i x-show="!telpValid && telp" class="fas fa-times text-red-500 animate__animated animate__fadeIn"></i>
                                </div>
                            </div>
                            <p x-show="!telpValid && telp" class="mt-1 text-sm text-red-600 animate__animated animate__fadeIn">
                                Nomor telepon harus 10-15 digit angka
                            </p>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between mt-6">
                        <div class="text-sm text-gray-600">
                            <i class="fas fa-info-circle mr-1"></i>
                            Langkah 1 dari 2
                        </div>
                        <button type="button"
                                @click="nextStep"
                                :disabled="!canProceed"
                                class="group inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span>Selanjutnya</span>
                            <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Password -->
                <div x-show="currentStep === 2"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform -translate-x-6"
                     x-transition:enter-end="opacity-100 transform translate-x-0"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 transform translate-x-0"
                     x-transition:leave-end="opacity-0 transform translate-x-6">
                    <div class="space-y-4">
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock" :class="{
                                        'text-gray-400': !password,
                                        'text-red-500': passwordStrength === 'weak',
                                        'text-yellow-500': passwordStrength === 'medium',
                                        'text-green-500': passwordStrength === 'strong'
                                    }"></i>
                                </div>
                                <input id="password"
                                       :type="showPassword ? 'text' : 'password'"
                                       name="password"
                                       x-model="password"
                                       @input="validatePassword"
                                       class="pl-10 pr-10 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 transition-all duration-200"
                                       :class="{
                                           'border-red-500 focus:border-red-500 focus:ring-red-500': passwordStrength === 'weak',
                                           'border-yellow-500 focus:border-yellow-500 focus:ring-yellow-500': passwordStrength === 'medium',
                                           'border-green-500 focus:border-green-500 focus:ring-green-500': passwordStrength === 'strong'
                                       }"
                                       placeholder="Minimal 8 karakter"
                                       required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button"
                                            @click="togglePassword"
                                            class="text-gray-400 hover:text-gray-500 focus:outline-none">
                                        <i class="fas" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Password Strength Indicator -->
                            <div class="mt-2" x-show="password">
                                <div class="flex space-x-1">
                                    <div class="flex-1 h-2 rounded-full transition-all duration-300"
                                         :class="{
                                             'bg-red-500': passwordStrength === 'weak',
                                             'bg-yellow-500': passwordStrength === 'medium',
                                             'bg-green-500': passwordStrength === 'strong',
                                             'bg-gray-200': !password
                                         }">
                                    </div>
                                </div>
                                <p class="mt-1 text-sm"
                                   :class="{
                                       'text-red-600': passwordStrength === 'weak',
                                       'text-yellow-600': passwordStrength === 'medium',
                                       'text-green-600': passwordStrength === 'strong'
                                   }">
                                    Password <span x-text="passwordStrength === 'weak' ? 'lemah' : passwordStrength === 'medium' ? 'sedang' : 'kuat'"></span>
                                </p>
                            </div>

                            <!-- Password Requirements -->
                            <div class="mt-2 space-y-2 text-sm" x-show="password">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-check text-xs" :class="passwordLength ? 'text-green-500' : 'text-gray-300'"></i>
                                    <span :class="passwordLength ? 'text-green-600' : 'text-gray-500'">Minimal 8 karakter</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-check text-xs" :class="hasUppercase ? 'text-green-500' : 'text-gray-300'"></i>
                                    <span :class="hasUppercase ? 'text-green-600' : 'text-gray-500'">Minimal 1 huruf besar</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-check text-xs" :class="hasLowercase ? 'text-green-500' : 'text-gray-300'"></i>
                                    <span :class="hasLowercase ? 'text-green-600' : 'text-gray-500'">Minimal 1 huruf kecil</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-check text-xs" :class="hasNumber ? 'text-green-500' : 'text-gray-300'"></i>
                                    <span :class="hasNumber ? 'text-green-600' : 'text-gray-500'">Minimal 1 angka</span>
                                </div>
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock" :class="{'text-green-500': passwordMatch, 'text-gray-400': !passwordMatch}"></i>
                                </div>
                                <input id="password_confirmation"
                                       :type="showPassword ? 'text' : 'password'"
                                       name="password_confirmation"
                                       x-model="passwordConfirmation"
                                       @input="validatePasswordMatch"
                                       class="pl-10 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 transition-all duration-200"
                                       :class="{'border-green-500 focus:border-green-500 focus:ring-green-500': passwordMatch && passwordConfirmation,
                                               'border-red-500 focus:border-red-500 focus:ring-red-500': !passwordMatch && passwordConfirmation}"
                                       placeholder="Ulangi password"
                                       required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i x-show="passwordMatch && passwordConfirmation" class="fas fa-check text-green-500 animate__animated animate__fadeIn"></i>
                                    <i x-show="!passwordMatch && passwordConfirmation" class="fas fa-times text-red-500 animate__animated animate__fadeIn"></i>
                                </div>
                            </div>
                            <p x-show="!passwordMatch && passwordConfirmation" class="mt-1 text-sm text-red-600 animate__animated animate__fadeIn">
                                Password tidak cocok
                            </p>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between mt-6">
                        <button type="button"
                                @click="prevStep"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </button>

                        <button type="submit"
                                :disabled="!canSubmit || isLoading"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span x-text="isLoading ? 'Mendaftar...' : 'Daftar Sekarang'"></span>
                            <i class="fas" :class="isLoading ? 'fa-circle-notch fa-spin ml-2' : 'fa-check ml-2'"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Social Login Divider -->
            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">
                            Atau daftar dengan
                        </span>
                    </div>
                </div>

                <!-- Social Login Buttons -->
                <div class="grid grid-cols-2 gap-3 mt-6">
                    <button type="button"
                        @click="socialLogin('google')"
                        class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-all duration-200">
                        <i class="fab fa-google text-red-500 text-lg"></i>
                        <span class="ml-2">Google</span>
                    </button>
                    <button type="button"
                        @click="socialLogin('facebook')"
                        class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-all duration-200">
                        <i class="fab fa-facebook text-blue-600 text-lg"></i>
                        <span class="ml-2">Facebook</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
