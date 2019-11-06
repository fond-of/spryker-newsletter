<?php

namespace FondOfSpryker\Service\Newsletter\Model\Generator;

use FondOfSpryker\Service\Newsletter\Exception\ModifierNotFoundException;

interface HashGeneratorInterface
{
    /**
     * @param  string  $string
     * @return string
     */
    public function generate(
        string $string
    ): string;
}
