@extends('base.base')

@section('content')
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication-->
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
            style="background-image: url({{ asset(theme()->getIllustrationUrl('14-dark.png')) }})">

            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">

                <!--begin::Wrapper-->
                <div class="{{ $wrapperClass ?? '' }} bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">

                    {{-- $errors->first('type') ??  --}}
                    {{-- {{ dd(Session::get('type').' '.Session::get('message')) }} --}}

                    <!--begin::alert-->
                    <x-alert type="{{ $errors->first('type') }}" />
                    
                        
                    
                    {{ $slot }}
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->

        </div>
        <!--end::Authentication-->
    </div>
@endsection
