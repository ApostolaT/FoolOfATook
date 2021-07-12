<?php

use FoolOfATook\Model\Dwarf;
use FoolOfATook\Model\Elf;
use FoolOfATook\Model\Goblin;
use FoolOfATook\Model\Hobbit;
use FoolOfATook\Model\Man;
use FoolOfATook\Model\Orc;
use FoolOfATook\Model\Trol;
use FoolOfATook\Model\Wizard;

$config['GOODARMY'] = [
    Hobbit::class,
    Elf::class,
    Man::class,
    Dwarf::class,
    Wizard::class
];

$config['BADARMY'] = [
    Goblin::class,
    Orc::class,
    Trol::class,
];
