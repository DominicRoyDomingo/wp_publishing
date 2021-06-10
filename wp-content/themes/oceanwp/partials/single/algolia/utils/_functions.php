<?php

function c_echo($data)
{
    echo trim(preg_replace('/\n/', '', strval($data)));
}
