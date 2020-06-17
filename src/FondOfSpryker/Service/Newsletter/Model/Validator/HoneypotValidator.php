<?php

namespace FondOfSpryker\Service\Newsletter\Model\Validator;

use FondOfSpryker\Service\Newsletter\Exception\FormValidatorValidationErrorException;
use Symfony\Component\Form\FormInterface;

class HoneypotValidator implements FormValidatorInterface
{
    public const NAME = 'HoneypotValidator';

    /**
     * @param \Symfony\Component\Form\FormInterface $form
     *
     * @throws \FondOfSpryker\Service\Newsletter\Exception\FormValidatorValidationErrorException
     *
     * @return bool
     */
    public function validate(FormInterface $form): bool
    {
        if ($form->get('name')->getData() !== null) {
            throw new FormValidatorValidationErrorException(sprintf('%s failt to validate!', $this->getName()));
        }

        return true;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::NAME;
    }
}
