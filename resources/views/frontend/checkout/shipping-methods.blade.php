<template x-for="Method in shippingMethods" :key="Method.id">
    <li>
        <input x-model="selectedMethod" type="radio" name="shippingMethod" :value="Method.id" :id="Method.title">
        <label :for="Method.title" x-html="Method.title +
         '<span class=\'text-danger price\' >' + Method.price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
         + ' @lang('mainFrontend.Currency')</span>' " class="total-price">
        </label>
        <div class="check"></div>
    </li>
</template>
