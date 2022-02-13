<?php

function flash($title=null, $message=null)
{
    $flash = app('App\Http\Flash');
    if (func_num_args()==0) {
        return $flash;
    }
    return $flash->info($title, $message);
}

function clean(string $string): array|string|null
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    $string = strtolower($string); // String to lowercase

    return preg_replace('/-+/', '_', $string); // Replaces multiple hyphens with single one.
}
