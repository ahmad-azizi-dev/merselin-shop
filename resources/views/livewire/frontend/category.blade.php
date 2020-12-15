<div>
    @include('frontend.partials.SidebarWrapper')
    <x-loading></x-loading>

    <div class="top-products-area clearfix py-3">
        <div class="container">
            <h6 class="ml-2">@lang('mainFrontend.CategoriesTitle')
                <b class="text-danger">{{$thisCategory->name}}</b>
            </h6>
            <div class="section-heading d-flex align-items-center justify-content-between">
                <!-- Layout Options-->
                <div class="layout-options mx-2">
                    <a @if($showType=='grid') class="active" wire:click @else wire:click="showType('grid')" @endif>
                        <i class="lni lni-grid-alt"></i>
                    </a>
                    <a @if($showType=='list') class="active" wire:click @else wire:click="showType('list')" @endif>
                        <i class="lni lni-radio-button"></i>
                    </a>
                    <span wire:target="showType" wire:loading.class="spinner-grow"></span>
                </div>
                <span wire:target="perPage" wire:loading.class="spinner-grow wire-loading"></span>
                <div class="mx-2">
                    <select wire:model="perPage" wire:loading.attr="disabled" class="form-select text-secondary">
                        @for ($i = 2; $i < 20; $i+=2)
                            <option value="{{$i}}">@lang('product.view') {{$i}} </option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="row g-3">
                <!-- Single Top Product Card-->
                    @if($showType=='list')
                        @include('frontend.partials.product-list',['products'=>$categoryProducts])
                    @elseif($showType=='grid')
                        @include('frontend.partials.product-grid',['products'=>$categoryProducts])
                    @endif
                <div id="paginate-loading" class="mx-1 mt-4">
                    {{ $categoryProducts->links() }}
                </div>
            </div>
        </div>
    </div>

</div>
