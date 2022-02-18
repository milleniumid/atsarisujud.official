<x-auth-layout>

    <!-- Registration page title -->
    <x-slot name="page_title">
        {{ __('Login') }}
    </x-slot>

    <!--begin::Signin Form-->
    <form method="POST" action="{{ theme()->getPageUrl('login') }}" class="form w-100" novalidate="novalidate"
        id="kt_sign_in_form">
        @csrf

        <!--begin::Heading-->
        <div class="text-center mb-10">
            <!--begin::Title-->
            <h1 class="text-dark mb-3">
                {{ __('Masuk') }}
            </h1>
            <!--end::Title-->

            <!--begin::Link-->
            @if (Route::has('register'))

                <div class="text-gray-400 fw-bold fs-4">
                    {{ __('Baru?') }}

                    <a href="{{ theme()->getPageUrl('register') }}" class="link-primary fw-bolder">
                        {{ __('Buat akun') }}
                    </a>
                </div>

            @endif

            <!--end::Link-->
        </div>
        <!--begin::Heading-->

        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!--begin::Label-->
            <label class="form-label fs-6 fw-bolder text-dark">{{ __('Email') }}</label>
            <!--end::Label-->

            <!--begin::Input-->
            <input class="form-control form-control-lg form-control-solid" type="email" name="email" autocomplete="off"
                value="{{ old('email', 'demo@demo.com') }}" required autofocus />
            <!--end::Input-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack mb-2">
                <!--begin::Label-->
                <label class="form-label fw-bolder text-dark fs-6 mb-0">{{ __('Password') }}</label>
                <!--end::Label-->

                <!--begin::Link-->
                @if (Route::has('password.request'))
                    <a href="{{ theme()->getPageUrl('password.request') }}" class="link-primary fs-6 fw-bolder">
                        {{ __('other.forgotPassword') }} ?
                    </a>
                @endif
                <!--end::Link-->
            </div>
            <!--end::Wrapper-->

            <!--begin::Input-->
            <input class="form-control form-control-lg form-control-solid" type="password" name="password"
                autocomplete="off" value="demo" required />
            <!--end::Input-->
        </div>
        <!--end::Input group-->

        <!--begin::Actions-->
        <div class="text-center">
            <!--begin::Submit button-->
            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                @include('partials.general._button-indicator', ['label' => __('Selanjutnya')])
            </button>
            <!--end::Submit button-->

        </div>
        <!--end::Actions-->
    </form>
    <!--end::Signin Form-->

</x-auth-layout>
