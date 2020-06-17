<?php

namespace FondOfSpryker\Service\Newsletter\Model\Validator;

use ArrayIterator;
use Countable;
use Exception;
use FondOfSpryker\Service\Newsletter\Exception\FormValidatorNotFoundException;
use IteratorAggregate;
use Symfony\Component\Form\FormInterface;

class FormValidatorCollection implements Countable, IteratorAggregate, FormValidatorCollectionInterface
{
    /**
     * @var \FondOfSpryker\Service\Newsletter\Model\Validator\FormValidatorInterface[]
     */
    protected $validatorCollection;

    /**
     * @param \FondOfSpryker\Service\Newsletter\Model\Validator\FormValidatorInterface[] $formValidator
     */
    public function __construct(array $formValidator)
    {
        $this->init($formValidator);
    }

    /**
     * @param \FondOfSpryker\Service\Newsletter\Model\Validator\FormValidatorInterface $formValidator
     *
     * @return $this|\FondOfSpryker\Service\Newsletter\Model\Validator\FormValidatorCollectionInterface
     */
    public function addValidator(FormValidatorInterface $formValidator): FormValidatorCollectionInterface
    {
        $this->validatorCollection[$formValidator->getName()] = $formValidator;

        return $this;
    }

    /**
     * @param string $validatorName
     *
     * @throws \FondOfSpryker\Service\Newsletter\Exception\FormValidatorNotFoundException
     *
     * @return \FondOfSpryker\Service\Newsletter\Model\Validator\FormValidatorInterface
     */
    public function getValidator(string $validatorName): FormValidatorInterface
    {
        if (array_key_exists($validatorName, $this->validatorCollection)) {
            return [$this->validatorCollection[$validatorName]];
        }

        throw new FormValidatorNotFoundException(sprintf('Form validator with name %s not found!', $validatorName));
    }

    /**
     * @param \Symfony\Component\Form\FormInterface $form
     *
     * @return bool
     */
    public function execValidation(FormInterface $form): bool
    {
        foreach ($this->getValidators() as $validator) {
            try {
                if ($validator->validate($form) === false) {
                    return false;
                }
            } catch (Exception $exception) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return \FondOfSpryker\Service\Newsletter\Model\Validator\FormValidatorInterface[]
     */
    public function getValidators(): array
    {
        return $this->validatorCollection;
    }

    /**
     * @return \ArrayIterator|\Traversable
     */
    public function getIterator()
    {
        return new ArrayIterator($this->validatorCollection);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->validatorCollection);
    }

    /**
     * @param array $formValidator
     *
     * @return void
     */
    protected function init(array $formValidator): void
    {
        foreach ($formValidator as $validator) {
            $this->addValidator($validator);
        }
    }
}
