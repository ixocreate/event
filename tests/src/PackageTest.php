<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Event;

use Ixocreate\Application\ConfiguratorRegistryInterface;
use Ixocreate\Application\ServiceRegistryInterface;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use Ixocreate\Package\Event\BootstrapItem\SubscriberBootstrapItem;
use Ixocreate\Package\Event\Package;
use PHPUnit\Framework\TestCase;

class PackageTest extends TestCase
{
    /**
     * @var Package
     */
    private $package;

    public function setUp()
    {
        $this->package = new Package();
    }

    /**
     * @covers \Ixocreate\Package\Event\Package
     */
    public function testPackage()
    {
        $configuratorRegistry = $this->getMockBuilder(ConfiguratorRegistryInterface::class)->getMock();
        $configuratorRegistry->method('get')->willThrowException(new \InvalidArgumentException('Fail: Package::configure not empty!'));
        $configuratorRegistry->method('add')->willThrowException(new \InvalidArgumentException('Fail: Package::configure not empty!'));

        $serviceRegistry = $this->getMockBuilder(ServiceRegistryInterface::class)->getMock();
        $serviceRegistry->method('get')->willThrowException(new \InvalidArgumentException('Fail: Package::addService not empty!'));
        $serviceRegistry->method('add')->willThrowException(new \InvalidArgumentException('Fail: Package::addService not empty!'));

        $serviceManager = $this->getMockBuilder(ServiceManagerInterface::class)->getMock();
        $serviceManager->method('get')->willThrowException(new \InvalidArgumentException('Fail: Package::boot not empty!'));
        $serviceManager->method('build')->willThrowException(new \InvalidArgumentException('Fail: Package::boot not empty!'));
        $serviceManager->method('getServiceManagerConfig')->willThrowException(new \InvalidArgumentException('Fail: Package::boot not empty!'));
        $serviceManager->method('getServiceManagerSetup')->willThrowException(new \InvalidArgumentException('Fail: Package::boot not empty!'));
        $serviceManager->method('getFactoryResolver')->willThrowException(new \InvalidArgumentException('Fail: Package::boot not empty!'));
        $serviceManager->method('getServices')->willThrowException(new \InvalidArgumentException('Fail: Package::boot not empty!'));

        $test = new Package();

        $test->configure($configuratorRegistry);
        $test->addServices($serviceRegistry);
        $test->boot($serviceManager);

        $this->assertSame([SubscriberBootstrapItem::class], $this->package->getBootstrapItems());
        $this->assertNull($this->package->getConfigProvider());
        $this->assertSame(
            \dirname(\dirname(__DIR__)) . '/src/../bootstrap/',
            $this->package->getBootstrapDirectory()
        );
        $this->assertNull($this->package->getConfigDirectory());
        $this->assertNull($this->package->getDependencies());
    }
}
