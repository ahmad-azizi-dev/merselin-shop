<div>
    @include('frontend.partials.SidebarWrapper')
    <x-loading></x-loading>

    <div class="top-products-area clearfix py-3">
        <div class="container">
            <div class="section-heading d-flex align-items-center justify-content-between">
                <h6 class="ml-1">@lang('mainFrontend.CategoriesTitle')
                    <b class="text-danger">{{$thisCategory->name}}</b>
                </h6>
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
                @foreach($categoryProducts as $product)
                    <x-product :product=$product :cartProducts=$cartProducts></x-product>
                @endforeach
                <div id="paginate-loading" class="mx-1 mt-4">
                    {{ $categoryProducts->links() }}
                </div>
            </div>
        </div>
    </div>

</div>
