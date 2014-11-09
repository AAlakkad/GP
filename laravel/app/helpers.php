<?php

function set_active($path, $active = 'active')
{
    return Request::segment(1) == $path ? 'active' : '';

}