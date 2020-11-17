<div class="card-body d-flex align-items-center justify-content-between">
    <p class="total-price mb-0 mx-auto">
        <span class="price-title">@lang('mainFrontend.FooterNav-cart')</span>
        <span class="text-danger price"
              x-text="cartTotalPrice.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')">
        </span>
        <span class="price">@lang('mainFrontend.Currency')</span>
    </p>
    <h5 class="m-auto">+</h5>
    <p class="total-price mb-0 mx-auto">
        <span class="price-title">@lang('product.shippingPrice')</span>
        <span class="text-danger price"
              x-text="shippingMethods.find(item => item.id == selectedMethod).price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')">
        </span>
        <span class="price">@lang('mainFrontend.Currency')</span>
    </p>
</div>
<hr class="mt-0 mb-2 mx-4">
<div class="card-body d-flex align-items-center justify-content-between">
    <h6 class="mb-0 mx-auto">
        <span
            x-text="(shippingMethods.find(item => item.id == selectedMethod).price + cartTotalPrice).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')">
        </span>
        @lang('mainFrontend.Currency')
    </h6>
    <button class="btn btn-warning mx-auto" form="postCheckout">
        @lang('product.confirmAndNext')
    </button>
</div>
