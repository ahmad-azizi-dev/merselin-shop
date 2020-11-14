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

    <x-profile :user=$user>

        <!-- User Meta Data-->
        <div class="card user-data-card">
            <div class="card-body">
                <div class="single-profile-data d-flex align-items-center justify-content-between">
                    <div class="title d-flex align-items-center">
                        <i class="lni lni-user"></i><span>@lang('mainFrontend.FullName')</span>
                    </div>
                    <div class="data-content text-blue">
                        {{$user->name=='not_set' ? trans('mainFrontend.NotSet') : $user->name}}
                    </div>
                </div>
                <div class="single-profile-data d-flex align-items-center justify-content-between">
                    <div class="title d-flex align-items-center">
                        <i class="lni lni-phone"></i>
                        <span>@lang('mainFrontend.PhoneNumber')</span>
                    </div>
                    <div class="data-content text-blue">0{{$user->phone_number}}</div>
                </div>
                <div class="single-profile-data d-flex align-items-center justify-content-between">
                    <div class="title d-flex align-items-center">
                        <i class="lni lni-envelope"></i><span>@lang('mainFrontend.Email')</span>
                    </div>
                    <div class="data-content text-blue">
                        {{Str::startsWith($user->email,'not_set-')?'---':$user->email}}
                    </div>
                </div>
                <div class="single-profile-data d-flex justify-content-between">
                    <div class="title">
                        <i class="lni lni-map-marker"></i>
                        <span>@lang('mainFrontend.ShippingAddress')</span>
                    </div>
                    <div class="data-content text-blue">{{($x=$user->shippingAddress)?$x->shipping_address:'---'}}</div>
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
            <a class="btn btn-info w-50 mx-5" href="{{route('editProfile')}}">
                <i class="lni lni-pencil mr-2"></i>
                @lang('mainFrontend.Edit')
            </a>
        </div>
    </x-profile>

    <!-- Footer Nav-->
    @include('frontend.partials.footerNav')

    @push('script')
        @livewireScripts
        @include('frontend.profile.upload-photo-script')
    @endpush

</x-frontend-layout>

