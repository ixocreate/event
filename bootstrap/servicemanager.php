<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Event;

use Ixocreate\Application\ServiceManager\ServiceManagerConfigurator;
use Ixocreate\Event\Factory\EventDispatcherFactory;
use Ixocreate\Event\Subscriber\SubscriberSubManager;

/** @var ServiceManagerConfigurator $serviceManager */
$serviceManager->addService(EventDispatcher::class, EventDispatcherFactory::class);
$serviceManager->addSubManager(SubscriberSubManager::class);
