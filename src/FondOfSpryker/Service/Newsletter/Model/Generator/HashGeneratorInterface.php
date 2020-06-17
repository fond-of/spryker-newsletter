<?php

namespace FondOfSpryker\Service\Newsletter\Model\Generator;

interface HashGeneratorInterface
{
    /**
     * @param string $string
     *
     * @return string
     */
    public function generate(string $string): string;
}
