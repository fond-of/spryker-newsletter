<?php

namespace FondOfSpryker\Service\Newsletter\Model\Validator;

use Symfony\Component\Form\FormInterface;

interface FormValidatorCollectionInterface
{
    /**
     * @param \FondOfSpryker\Service\Newsletter\Model\Validator\FormValidatorInterface $formValidator
     *
     * @return $this|\FondOfSpryker\Service\Newsletter\Model\Validator\FormValidatorCollectionInterface
     */
    public function addValidator(FormValidatorInterface $formValidator): self;

    /**
     * @param string $validatorName
     *
     * @return \FondOfSpryker\Service\Newsletter\Model\Validator\FormValidatorInterface
     */
    public function getValidator(string $validatorName): FormValidatorInterface;

    /**
     * @return \FondOfSpryker\Service\Newsletter\Model\Validator\FormValidatorInterface[]
     */
    public function getValidators(): array;

    /**
     * @return \ArrayIterator|\Traversable
     */
    public function getIterator();

    /**
     * @return int
     */
    public function count(): int;

    /**
     * @param \Symfony\Component\Form\FormInterface $form
     *
     * @return bool
     */
    public function execValidation(FormInterface $form): bool;
}
