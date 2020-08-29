<?php

/**
* @return string
 */
function csrf(): string
{
    return \transactions\Session::csrf();
}

/**
* @return string
 */
function login(): string
{
    return \transactions\Session::login();
}

/**
* @param string $key
 *
 * @return bool
 */
function sessionHas(string $key): bool
{
    return \transactions\Session::has($key);
}

/**
* @param string $key
 *
 * @return string
 */
function flash(string $key): string
{
    return \transactions\Session::flash($key);
}
