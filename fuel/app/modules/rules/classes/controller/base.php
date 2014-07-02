<?php

namespace Rules;

class Controller_Base extends \Controller
{
    public function _init()
    {
        // load your config here
        \Config::load('config');

        parent::_init();
    }
}