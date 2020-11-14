<div class="page-content-wrapper mb-3">

    <div class="container">
        <!-- Profile Wrapper-->
        <div class="profile-wrapper-area py-3">
            <!-- User Information-->
            <div class="card user-info-card">
                <div class="card-body p-4 d-flex align-items-center">

                    @livewire('frontend.profile-photo')

                    <div class="user-info">
                        <p class="mb-4 text-white">@lang('mainFrontend.Profile')</p>

                    </div>
                </div>
            </div>

            {{$slot}}

        </div>
    </div>
</div>
