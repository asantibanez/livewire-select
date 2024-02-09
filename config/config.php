<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'styles' => [
        'default' => 'p-2 rounded border w-full appearance-none',

        'searchSelectedOption' => 'p-2 rounded border w-full bg-white flex items-center',
        'searchSelectedOptionTitle' => 'w-full text-gray-900 text-left',
        'searchSelectedOptionReset' => 'h-4 w-4 text-gray-500',

        'search' => 'relative',
        'searchInput' => 'p-2 rounded border w-full rounded',
        'searchOptionsContainer' => 'absolute top-0 left-0 mt-12 w-full z-10',

        'searchOptionItem' => 'p-3 hover:bg-gray-100 cursor-pointer text-sm',
        'searchOptionItemActive' => 'bg-indigo-600 text-white font-medium',
        'searchOptionItemInactive' => 'bg-white text-gray-600',

        'searchNoResults' => 'p-8 w-full bg-white border text-center text-xs text-gray-600',
    ]
];
