<?php

declare(strict_types=1);

namespace Chubbyphp\Tests\Deserialization\Denormalizer;

use Chubbyphp\Deserialization\Denormalizer\CallbackFieldDenormalizer;
use Chubbyphp\Deserialization\Denormalizer\DenormalizerContextInterface;
use Chubbyphp\Deserialization\Denormalizer\DenormalizerInterface;
use Chubbyphp\Mock\MockByCallsTrait;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Chubbyphp\Deserialization\Denormalizer\CallbackFieldDenormalizer
 */
class CallbackFieldDenormalizerTest extends TestCase
{
    use MockByCallsTrait;

    public function testDenormalizeField()
    {
        $object = new class() {
            /**
             * @var string
             */
            private $name;

            /**
             * @return string
             */
            public function getName(): string
            {
                return $this->name;
            }

            /**
             * @param string $name
             *
             * @return self
             */
            public function setName(string $name): self
            {
                $this->name = $name;

                return $this;
            }
        };

        /** @var DenormalizerContextInterface|MockObject $context */
        $context = $this->getMockByCalls(DenormalizerContextInterface::class);

        $fieldDenormalizer = new CallbackFieldDenormalizer(
            function (
                string $path,
                $object,
                $value,
                DenormalizerContextInterface $context,
                DenormalizerInterface $denormalizer = null
            ) {
                $object->setName($value);
            }
        );

        $fieldDenormalizer->denormalizeField('name', $object, 'name', $context);

        self::assertSame('name', $object->getName());
    }
}
