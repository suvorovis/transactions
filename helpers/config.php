<?php

/**
 * @param string $key
 *
 * @return string
 */
function getConfig(string $key): string
{
    return \transactions\Config::get($key);
}
