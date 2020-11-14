<?php

return [

    /*
   |--------------------------------------------------------------------------
   | Custom Validation Language Lines
   |--------------------------------------------------------------------------
   |
   | Here you may specify custom validation messages for attributes using the
   | convention "attribute.rule" to name the lines. This makes it quick to
   | specify a specific custom language line for a given attribute rule.
   |
   */

    'custom' => [
        'captcha' => [
            'required' => 'لطفا حاصل عبارت را وارد کنید',
            'captcha'  => 'عبارت وارد شده صحیح نیست! لطفا دوباره تلاش کنید',
        ],
        'photo'   => [
            'image' => 'فایل آپلود شده باید عکس باشد.',
            'max'   => 'حجم تصویر باید کمتر از 8MB باشد.',
        ],
        'email'   => [
            'unique' => 'آدرس email وارد شده تکراری است!',
        ],
    ],
];
