<?php

use makeup\lib\Module;


class YYYY extends Module
{
    public function __construct()
    {
        parent::__construct();
    }


    protected function build() : string
    {
        $m = [];
        $s = [];

        return $this->getTemplate()->parse($m, $s);
    }

}
