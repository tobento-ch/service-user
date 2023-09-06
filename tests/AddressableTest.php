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
use Tobento\Service\User\User;
use Tobento\Service\User\Addressable;
use Tobento\Service\User\Addresses;
use Tobento\Service\User\AddressesInterface;
use Tobento\Service\User\AddressInterface;

/**
 * AddressableTest
 */
class AddressableTest extends TestCase
{
    public function testThatImplementsAddressable()
    {
        $this->assertInstanceof(
            Addressable::class,
            new User(username: 'username')
        );
    }
    
    public function testAddressesMethod()
    {
        $this->assertInstanceof(
            AddressesInterface::class,
            (new User())->addresses()
        );        
    }
    
    public function testAddressesMethodUsesPassedAddresses()
    {
        $addresses = new Addresses();
        
        $user = new User(addresses: $addresses);
        
        $this->assertSame(
            $addresses,
            $user->addresses()
        );
    }
    
    public function testHasAddressMethod()
    {
        $user = new User();
        
        $addresses = $user->addresses();
        
        $addresses->address([
            'key' => 'payment',
            'firstname' => 'John',
            'address1' => 'Address1',
            'address2' => '',
        ]);
        
        $this->assertFalse($addresses->has(key: 'shipping'));
        
        $this->assertTrue($addresses->has(key: 'payment'));
        
        $this->assertTrue($addresses->has(key: 'payment', with: ['firstname']));
        
        $this->assertFalse($addresses->has(key: 'payment', with: ['lastname']));
        
        $this->assertFalse($addresses->has(key: 'payment', with: ['firstname', 'lastname']));
        
        $this->assertTrue($addresses->has(key: 'payment', with: ['firstname', 'address1']));
        
        $this->assertFalse($addresses->has(key: 'payment', with: ['address2']));     
    }
    
    public function testAddressMethod()
    {
        $user = new User();
                
        $user->addresses()->address([
            'key' => 'payment',
            'firstname' => 'John',
            'address1' => 'Address1',
            'address2' => '',
        ]);
        
        $address = $user->address();
        
        $this->assertInstanceof(
            AddressInterface::class,
            $address
        );
        
        $this->assertSame('primary', $address->key());
        
        $this->assertSame('John', $user->address('payment')->firstname());  
    }    
}