@if ($errors->any() || Session::has('message'))
    {{-- <div class="alert alert-custom alert-notice alert-light-danger fade show" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        @if (count($errors->all()) >= 2)
            <ul class="mt-3 mr-6 text-dark">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @else
            <div class="alert-text text-dark"> {{ $errors->first() }} </div>
        @endif

        <div class="alert-close ml-auto">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div> --}}

    <!--begin::Alert-->
    {{-- <div class="alert alert-dismissible bg-{{ $type }} d-flex flex-column flex-sm-row p-5 mb-10 rounded">


        <!--begin::Wrapper-->
        
        <div class="d-flex flex-column text-light pe-0 pe-sm-10">
            <!--begin::Icon-->
            {!! theme()->getSvgIcon('icons/duotune/general/gen050.svg', 'svg-icon svg-icon-2hx svg-icon-{{ $type }} me-4 mb-5 mb-sm-0') !!}
            <!--end::Icon-->

            <!--begin::Content-->
            <span>The alert component can be used to highlight certain parts of your page for higher content
                visibility.</span>
            <!--end::Content-->

            @if (count($errors->all()) >= 2)
                <ul class="mt-3 mr-6 text-dark">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @else
                <span> {{ $errors->first() }} </span>
            @endif

        </div>
        <!--end::Wrapper-->

        <!--begin::Close-->
        <button type="button"
            class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
            data-bs-dismiss="alert">
            {!! theme()->getSvgIcon('icons/duotune/abstract/abs012.svg', 'svg-icon-2x') !!}
        </button>
        <!--end::Close-->
    </div>
    <!--end::Alert--> --}}


    <div class="alert alert-dismissible bg-{{ $type }} d-flex flex-column flex-sm-row w-100 p-5 mb-10">
        <!--begin::Icon-->
        {!! theme()->getSvgIcon($icon, 'svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0') !!}

        <!--begin::Content-->
        <div class="d-flex flex-column text-light pe-0 pe-sm-10">
            <h4 class="mb-2 text-light">{{ $title }}</h4>

            @if (count($errors->all()) >= 2 && !isset($message))
                <ul class="mt-3 mr-6 text-dark">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @else
                <span> {{ $errors->first('message') }}</span>
            @endif

            @if (isset($message))
                <span> {{ $message }} </span>
            @endif

            @if (Session::has('message') != null)
                <span> {{ Session::get('message') }} </span>
            @endif

        </div>
        <!--end::Content-->

        <!--begin::Close-->
        <button type="button"
            class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
            data-bs-dismiss="alert">
            {!! theme()->getSvgIcon('icons/duotune/arrows/arr061.svg', 'svg-icon-2x') !!}
        </button>
        <!--end::Close-->
    </div>
@endif
