<x-frontend-layout>

    @push('head')
        <meta name="description" content="---">
        <!-- Title-->
        <title>@lang('mainFrontend.Profile')</title>
        @livewireStyles
    @endpush

<!-- Header Area-->
    @include('frontend.partials.HeaderArea')

    @include('frontend.partials.SidebarWrapper')

    <div class="page-content-wrapper mb-3">

        <div class="container">
            <!-- Profile Wrapper-->
            <div class="profile-wrapper-area py-3">
                <!-- User Information-->
                <div class="card user-info-card">
                    <div class="card-body p-4 d-flex align-items-center">
                        <div class="user-profile mr-3">
                            <img src="{{ $user->profile_photo_url }}" alt="profile img">
                        </div>
                        <div class="user-info">
                            <p class="mb-2 text-white">@lang('mainFrontend.Profile')</p>
                            <h5 class="mb-0">
                                {{$user->name=='not_set' ? trans('mainFrontend.NotSet') : $user->name}}
                            </h5>
                        </div>
                    </div>
                </div>
                <!-- User Meta Data-->
                <div class="card user-data-card">
                    <div class="card-body">
                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center">
                                <i class="lni lni-user"></i><span>@lang('mainFrontend.FullName')</span>
                            </div>
                            <div class="data-content">
                                {{$user->name=='not_set' ? trans('mainFrontend.NotSet') : $user->name}}
                            </div>
                        </div>
                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center">
                                <i class="lni lni-phone"></i>
                                <span>@lang('mainFrontend.PhoneNumber')</span>
                            </div>
                            <div class="data-content">0{{$user->phone_number}}</div>
                        </div>
                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center">
                                <i class="lni lni-envelope"></i><span>@lang('mainFrontend.Email')</span>
                            </div>
                            <div class="data-content">
                                {{Str::startsWith($user->email,'not_set-') ? '---' : $user->email}}
                            </div>
                        </div>
                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center">
                                <i class="lni lni-map-marker"></i>
                                <span>@lang('mainFrontend.ShippingAddress')</span>
                            </div>
                            <div class="data-content">---</div>
                        </div>
                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center">
                                <i class="lni lni-star"></i>
                                <span>@lang('mainFrontend.PurchaseHistory')</span>
                            </div>
                            <div class="data-content">
                                <a class="btn btn-danger btn-sm" href="#">@lang('mainFrontend.View')</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Edit Profile-->
                <div class="edit-profile-btn mt-3">
                    <a class="btn btn-info w-50 mx-5" href="#">
                        <i class="lni lni-pencil mr-2"></i>
                        @lang('mainFrontend.Edit')
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Nav-->
    @include('frontend.partials.footerNav')

    @push('script')
        @livewireScripts
        <script>
            @include('frontend.partials.DropdownMenu')
        </script>
    @endpush

</x-frontend-layout>

