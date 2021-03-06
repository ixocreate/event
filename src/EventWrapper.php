<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Event;

final class EventWrapper extends \Symfony\Contracts\EventDispatcher\Event
{
    /**
     * @var EventInterface
     */
    private $event;

    /**
     * EventWrapper constructor.
     *
     * @param EventInterface $event
     */
    public function __construct(EventInterface $event)
    {
        $this->setEvent($event);
    }

    /**
     * @param EventInterface $event
     */
    public function setEvent(EventInterface $event): void
    {
        $this->event = $event;
    }

    /**
     * @return EventInterface
     */
    public function event(): EventInterface
    {
        return $this->event;
    }

    /**
     * @return bool
     */
    public function isPropagationStopped(): bool
    {
        return $this->event->isPropagationStopped();
    }

    /**
     *
     */
    public function stopPropagation(): void
    {
        $this->event->stopPropagation();
    }
}
