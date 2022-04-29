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
use Tobento\Service\User\Addresses;
use Tobento\Service\User\AddressesInterface;
use Tobento\Service\User\AddressFactoryInterface;
use Tobento\Service\User\AddressFactory;
use Tobento\Service\User\AddressInterface;
use Tobento\Service\User\Address;

/**
 * AddressesTest
 */
class AddressesTest extends TestCase
{
    public function testThatImplementsAddressesInterface()
    {
        $this->assertInstanceof(
            AddressesInterface::class,
            new Addresses()
        );
    }
    
    public function testConstructor()
    {
        $shipping = new Address(key: 'shipping');
        $payment = new Address(key: 'payment');
        
        $addresses = new Addresses(
            null, // addressFactory: null|AddressFactoryInterface
            // addresses: ...AddressInterface
            $shipping,
            $payment,
        );
        
        $this->assertSame($shipping, $addresses->get('shipping'));
        $this->assertSame($payment, $addresses->get('payment'));
    }
    
    public function testAddressFactoryMethod()
    {
        $this->assertInstanceof(
            AddressFactoryInterface::class,
            (new Addresses())->addressFactory()
        );
        
        $addressFactory = new AddressFactory();
        
        $addresses = new Addresses($addressFactory);
        
        $this->assertSame($addressFactory, $addresses->addressFactory());
    }
    
    public function testGetMethod()
    {
        $payment = new Address(key: 'payment');
        
        $addresses = new Addresses(null, $payment);
        
        $address = $addresses->get(key: 'payment');
        
        $this->assertInstanceof(
            AddressInterface::class,
            $address
        );
        
        $this->assertSame($payment, $address);
    }
    
    public function testGetMethodCreateNewAddressIfNotExist()
    {
        $addresses = new Addresses();
        
        $this->assertInstanceof(
            AddressInterface::class,
            $addresses->get(key: 'payment')
        );
    }    
    
    public function testAddMethod()
    {
        $payment = new Address(key: 'payment');
        
        $addresses = new Addresses();
        
        $addresses->add($payment);
        
        $this->assertSame($payment, $addresses->get(key: 'payment'));
    }
    
    public function testCreateMethod()
    {
        $addresses = new Addresses();
        
        $this->assertInstanceof(
            AddressInterface::class,
            $addresses->create(['key' => 'payment'])
        );
        
        $this->assertFalse($addresses->has(key: 'payment'));
    }
    
    public function testAddressMethod()
    {
        $addresses = new Addresses();
        
        $this->assertInstanceof(
            AddressInterface::class,
            $addresses->address(['key' => 'payment'])
        );
        
        $this->assertTrue($addresses->has(key: 'payment'));
    }
    
    public function testHasMethod()
    {
        $addresses = new Addresses();
        
        $addresses->address(['key' => 'payment']);
        
        $this->assertFalse($addresses->has(key: 'shipping'));
        $this->assertTrue($addresses->has(key: 'payment'));
    }
    
    public function testHasMethodWithParameters()
    {
        $addresses = new Addresses();
        
        $addresses->address([
            'key' => 'payment',
            'firstname' => 'John',
            'address1' => 'Address1',
            'address2' => '',
        ]);
        
        $this->assertTrue($addresses->has(key: 'payment'));
        
        $this->assertTrue($addresses->has(key: 'payment', with: ['firstname']));
        
        $this->assertFalse($addresses->has(key: 'payment', with: ['lastname']));
        
        $this->assertFalse($addresses->has(key: 'payment', with: ['firstname', 'lastname']));
        
        $this->assertTrue($addresses->has(key: 'payment', with: ['firstname', 'address1']));
        
        $this->assertFalse($addresses->has(key: 'payment', with: ['address2']));
    }
    
    public function testDeleteMethod()
    {
        $addresses = new Addresses();
        
        $addresses->address(['key' => 'payment']);
        
        $this->assertTrue($addresses->has(key: 'payment'));
        
        $addresses->delete(key: 'payment');
        
        $this->assertFalse($addresses->has(key: 'payment'));
    }
    
    public function testAllMethod()
    {
        $addresses = new Addresses();
        
        $addresses->address(['key' => 'payment']);
        
        $this->assertSame(
            ['payment'],
            array_keys($addresses->all())
        );
    }
    
    public function testFilterMethod()
    {
        $addresses = new Addresses();
        
        $addresses->address(['key' => 'payment', 'country_key' => 'CH']);
        $addresses->address(['key' => 'shipment', 'country_key' => 'CH']);
        $addresses->address(['key' => 'book', 'country_key' => 'GB']);

        $newAddresses = $addresses->filter(
            fn(AddressInterface $a): bool => $a->countryKey() === 'CH'
        );
        
        $this->assertFalse($addresses === $newAddresses);
        
        $this->assertSame(
            2,
            count($newAddresses->all())
        );  
    }
    
    public function testGroupMethod()
    {
        $addresses = new Addresses();
        
        $addresses->address(['key' => 'payment', 'group' => 'shop']);
        $addresses->address(['key' => 'shipment', 'group' => 'shop']);
        $addresses->address(['key' => 'book', 'group' => 'book']);

        $newAddresses = $addresses->group('shop');
        
        $this->assertFalse($addresses === $newAddresses);
        
        $this->assertSame(
            2,
            count($newAddresses->all())
        );  
    }    
}