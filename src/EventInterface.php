<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Event\Package;

interface EventInterface
{
    /**
     * @return bool
     */
    public function isPropagationStopped(): bool;

    /**
     *
     */
    public function stopPropagation(): void;
}