<?php

namespace ChrisKonnertz\StringCalc\Symbols\Concrete\Constants;

use ChrisKonnertz\StringCalc\Symbols\AbstractConstant;

/**
 * PHP M_PI_2 constant
 * Value: 1.57...
 * @see http://php.net/manual/en/math.constants.php
 */
class PiTwoConstant extends AbstractConstant
{

    /**
     * @inheritdoc
     */
    protected $identifiers = ['piTwo'];

    /**
     * @inheritdoc
     */
    protected $value = M_PI_2;

}