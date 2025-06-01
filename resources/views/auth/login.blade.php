@extends('layouts.app')

@section('title', 'Login')

@include('auth.login-script')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-indigo-50 via-white to-blue-50">
    <div class="max-w-md w-full" x-data="{ isLoading: false }">
        <div class="bg-white rounded-2xl shadow-xl p-8 space-y-8">
            <!-- Animated Header -->
            <div class="text-center" data-aos="fade-down">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 mb-4 animate-bounce-slow">
                    <i class="fas fa-user-circle text-3xl text-indigo-600"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2 bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                    Selamat Datang Kembali
                </h2>
                <p class="text-sm text-gray-600">
                    Atau
                    <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors hover:underline">
                        daftar akun baru
                    </a>
                </p>
            </div>

            <!-- Alert Messages -->
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg animate__animated animate__shakeX" role="alert">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <form x-data="loginForm()"
                  @submit.prevent="submitForm"
                  class="mt-8 space-y-6"
                  action="{{ route('login') }}"
                  method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope" :class="emailValid ? 'text-green-500' : 'text-gray-400'"></i>
                            </div>
                            <input id="email"
                                   name="email"
                                   type="email"
                                   required
                                   x-model="email"
                                   @input.debounce.300ms="validateEmail"
                                   :class="{'border-green-500 focus:border-green-500 focus:ring-green-500': emailValid && email,
                                           'border-red-500 focus:border-red-500 focus:ring-red-500': !emailValid && email}"
                                   class="pl-10 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 transition-all duration-200"
                                   placeholder="nama@email.com"
                                   value="{{ old('email') }}">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i x-show="emailValid && email" class="fas fa-check text-green-500 animate__animated animate__fadeIn"></i>
                                <i x-show="!emailValid && email" class="fas fa-times text-red-500 animate__animated animate__fadeIn"></i>
                            </div>
                        </div>
                        <p x-show="!emailValid && email"
                           x-transition
                           class="mt-1 text-sm text-red-600 animate__animated animate__fadeIn">
                            Email tidak valid
                        </p>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock" :class="{'text-gray-400': !password, 'text-green-500': passwordStrength === 'strong', 'text-yellow-500': passwordStrength === 'medium', 'text-red-500': passwordStrength === 'weak'}"></i>
                            </div>
                            <input id="password"
                                   name="password"
                                   :type="showPassword ? 'text' : 'password'"
                                   required
                                   x-model="password"
                                   @input="validatePassword"
                                   :class="{'border-red-500 focus:border-red-500 focus:ring-red-500': passwordError}"
                                   class="pl-10 pr-10 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200"
                                   placeholder="••••••••">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button"
                                        @click="togglePassword"
                                        class="text-gray-400 hover:text-gray-500 focus:outline-none">
                                    <i class="fas" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                                </button>
                            </div>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me"
                               name="remember"
                               type="checkbox"
                               x-model="remember"
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded transition-colors">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                            Ingat saya
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors hover:underline">
                            Lupa password?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit"
                            :disabled="isLoading || !emailValid || !password"
                            class="group relative w-full flex justify-center py-2.5 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 transform hover:scale-[1.02] disabled:opacity-50 disabled:cursor-not-allowed">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas" :class="isLoading ? 'fa-circle-notch fa-spin' : 'fa-sign-in-alt'"
                               :class="{'text-indigo-500 group-hover:text-indigo-400': !isLoading}">
                            </i>
                        </span>
                        <span x-text="isLoading ? 'Memproses...' : 'Masuk'"></span>
                    </button>
                </div>
            </form>

            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">
                            Atau lanjutkan dengan
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 mt-6">
                    <button type="button"
                        class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-all duration-200">
                        <i class="fab fa-google text-red-500 text-lg"></i>
                        <span class="ml-2">Google</span>
                    </button>
                    <button type="button"
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
