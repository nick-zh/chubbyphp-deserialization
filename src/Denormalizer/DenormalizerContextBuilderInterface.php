<?php

declare(strict_types=1);

namespace Chubbyphp\Deserialization\Denormalizer;

use Psr\Http\Message\ServerRequestInterface;

interface DenormalizerContextBuilderInterface
{
    /**
     * @return self
     */
    public static function create(): self;

    /**
     * @param array|null $allowedAdditionalFields
     *
     * @return self
     */
    public function setAllowedAdditionalFields(array $allowedAdditionalFields = null): self;

    /**
     * @param string[] $groups
     *
     * @return self
     */
    public function setGroups(array $groups): self;

    /**
     * @param ServerRequestInterface|null $request
     *
     * @return self
     */
    public function setRequest(ServerRequestInterface $request = null): self;

    // /**
    //  * @param bool $resetMissingFields
    //  *
    //  * @return self
    //  */
    // public function setResetMissingFields(bool $resetMissingFields): self;

    /**
     * @return DenormalizerContextInterface
     */
    public function getContext(): DenormalizerContextInterface;
}
