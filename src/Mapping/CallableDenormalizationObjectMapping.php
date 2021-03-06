<?php

declare(strict_types=1);

namespace Chubbyphp\Deserialization\Mapping;

final class CallableDenormalizationObjectMapping implements DenormalizationObjectMappingInterface
{
    /**
     * @var string
     */
    private $class;

    /**
     * @var callable
     */
    private $callable;

    /**
     * @var DenormalizationObjectMappingInterface|null
     */
    private $mapping;

    /**
     * @param string   $class
     * @param callable $callable
     */
    public function __construct(string $class, callable $callable)
    {
        $this->class = $class;
        $this->callable = $callable;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @param string      $path
     * @param string|null $type
     *
     * @return callable
     */
    public function getDenormalizationFactory(string $path, string $type = null): callable
    {
        return $this->getMapping()->getDenormalizationFactory($path, $type);
    }

    /**
     * @param string      $path
     * @param string|null $type
     *
     * @return DenormalizationFieldMappingInterface[]
     */
    public function getDenormalizationFieldMappings(string $path, string $type = null): array
    {
        return $this->getMapping()->getDenormalizationFieldMappings($path, $type);
    }

    /**
     * @return DenormalizationObjectMappingInterface
     */
    private function getMapping(): DenormalizationObjectMappingInterface
    {
        if (null === $this->mapping) {
            $callable = $this->callable;
            $this->mapping = $callable();
        }

        return $this->mapping;
    }
}
