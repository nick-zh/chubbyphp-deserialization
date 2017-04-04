<?php

declare(strict_types=1);

namespace Chubbyphp\Tests\Deserialize\Resources\Mapping;

use Chubbyphp\Deserialize\Callback\ReferenceCallback;
use Chubbyphp\Deserialize\Mapping\ObjectMappingInterface;
use Chubbyphp\Deserialize\Mapping\PropertyMapping;
use Chubbyphp\Deserialize\Mapping\PropertyMappingInterface;
use Chubbyphp\Model\ResolverInterface;
use Chubbyphp\Tests\Deserialize\Resources\Model\Many;
use Chubbyphp\Tests\Deserialize\Resources\Model\Reference;

final class ManyMapping implements ObjectMappingInterface
{
    /**
     * @var ResolverInterface
     */
    private $resolver;

    /**
     * @param ResolverInterface $resolver
     */
    public function __construct(ResolverInterface $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return Many::class;
    }

    /**
     * @return string
     */
    public function getConstructMethod(): string
    {
        return 'create';
    }

    /**
     * @return PropertyMappingInterface[]
     */
    public function getPropertyMappings(): array
    {
        return [
            new PropertyMapping('name'),
            new PropertyMapping('reference', new ReferenceCallback($this->resolver, Reference::class))
        ];
    }
}
