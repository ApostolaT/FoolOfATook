<?php

use Model\Balrog;
use Model\Dwarf;
use Model\Elf;
use Model\Goblin;
use Model\Hobbit;
use Model\Man;
use Model\Orc;
use Model\Trol;
use Model\Wizard;

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
