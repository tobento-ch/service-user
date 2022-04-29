<?php

/**
 * TOBENTO
 *
 * @copyright   Tobias Strub, TOBENTO
 * @license     MIT License, see LICENSE file distributed with this source code.
 * @author      Tobias Strub
 * @link        https://www.tobento.ch
 */

declare(strict_types=1);

namespace Tobento\Service\User\Test;

use PHPUnit\Framework\TestCase;
use Tobento\Service\User\AddressesFactory;
use Tobento\Service\User\AddressesFactoryInterface;
use Tobento\Service\User\AddressesInterface;
use Tobento\Service\User\AddressFactoryInterface;
use Tobento\Service\User\AddressFactory;
use Tobento\Service\User\AddressInterface;
use Tobento\Service\User\Address;

/**
 * AddressesFactoryTest
 */
class AddressesFactoryTest extends TestCase
{
    public function testThatImplementsAddressesFactoryInterface()
    {
        $this->assertInstanceof(
            AddressesFactoryInterface::class,
            new AddressesFactory()
        );
    }
    
    public function testCreateAddressesMethod()
    {
        $addressesFactory = new AddressesFactory(new AddressFactory());
        
        $addresses = $addressesFactory->createAddresses();
        
        $this->assertInstanceof(
            AddressesInterface::class,
            $addresses
        ); 
    }
    
    public function testCreateAddressesMethodWithAddresses()
    {
        $addressesFactory = new AddressesFactory();
        
        $addresses = $addressesFactory->createAddresses(
            new Address(key: 'shipping'),
        );
        
        $this->assertSame(
            ['shipping'],
            array_keys($addresses->all())
        ); 
    }
    
    public function testCreateAddressesFromArrayMethod()
    {
        $addressesFactory = new AddressesFactory(new AddressFactory());
        
        $data = [
            [
                'key' => 'payment',
            ],
            new Address(key: 'shipping'),
        ];
        
        $addresses = $addressesFactory->createAddressesFromArray($data);
        
        $this->assertSame(
            ['payment', 'shipping'],
            array_keys($addresses->all())
        );
    }    
}