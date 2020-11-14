<x-frontend-layout>

    @push('head')
        <meta name="description" content="---">
        <!-- Title-->
        <title>{{__('mainFrontend.Edit').' '. __('mainFrontend.Profile')}}</title>
        @livewireStyles
    @endpush

<!-- Header Area-->
    @include('frontend.profile.edit-header')

    @include('frontend.partials.SidebarWrapper')

    <x-profile :user=$user>

        <!-- User Meta Data-->
        <div class="card user-data-card">
            <div class="card-body">
                <div class="single-profile-data d-flex align-items-center justify-content-between">
                    <div class="title d-flex align-items-center">
                        <i class="lni lni-phone bg-warning"></i>
                        <span>@lang('mainFrontend.PhoneNumber')</span>
                    </div>
                    <div class="data-content text-primary">0{{$user->phone_number}}</div>
                </div>
                {!! Form::model($user, ['method' => 'post','route' => 'updateProfile']) !!}
                <div class="mb-3">
                    <div class="title mb-2">
                        <i class="lni lni-user"></i><span>@lang('mainFrontend.FullName')</span>
                    </div>
                    {!! Form::text('name',$user->name=='not_set' ? '' : $user->name, ['class' => 'form-control'.
                        ($errors->has('name') ? ' is-invalid' : null),'placeholder'=>trans('mainFrontend.EnterProfileName')]) !!}
                    @error('name')<p class="invalid-feedback">{{ $message }}</p>@enderror
                </div>

                <div class="mb-3">
                    <div class="title mb-2">
                        <i class="lni lni-envelope"></i>{{__('mainFrontend.Email')}}
                        <span class="text-danger">{{__('mainFrontend.Optional')}}</span>
                    </div>
                    {!! Form::text('email',Str::startsWith($user->email,'not_set-') ? '' : $user->email, ['class' => 'form-control'.
                       ($errors->has('email')?' is-invalid':null),'placeholder'=>trans('mainFrontend.EnterProfileEmail')]) !!}
                    @error('email')<p class="invalid-feedback">{{ $message }}</p>@enderror
                </div>
                <div class="mb-3">
                    <div class="title mb-2">
                        <i class="lni lni-map-marker"></i><span>@lang('mainFrontend.ShippingAddress')</span>
                    </div>
                    {!! Form::textarea('shipping_address',($x=$user->shippingAddress)?$x->shipping_address:null,['rows'=>'3','class'=>'form-control'.
                     ($errors->has('shipping_address')?' is-invalid':null),'placeholder'=>trans('mainFrontend.EnterProfileShippingAddress')]) !!}
                    @error('shipping_address')<p class="invalid-feedback">{{ $message }}</p>@enderror
                </div>

                {!! Form::submit(trans('mainFrontend.Save'),['class' => 'btn btn-success w-50']); !!}
                {!! Form::close() !!}
            </div>
        </div>
    </x-profile>

    <!-- Footer Nav-->
    @include('frontend.partials.footerNav')

    @push('script')
        @livewireScripts
        @include('frontend.profile.upload-photo-script')
    @endpush

</x-frontend-layout>

