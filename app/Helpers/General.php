<?php

use Illuminate\Support\Facades\Config;

function get_languages()
{
    \App\Models\Language::active()->get();
}

function get_default_lang(){
    return Config::get('app.locale');
}

function get_all_get_languages(){
    return Config::get('translatable.locales');
}
