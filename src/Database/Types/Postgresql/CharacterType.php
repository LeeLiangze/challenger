<?php

namespace CHG\Voyager\Database\Types\Postgresql;

use CHG\Voyager\Database\Types\Common\CharType;

class CharacterType extends CharType
{
    const NAME = 'character';
    const DBTYPE = 'bpchar';
}
