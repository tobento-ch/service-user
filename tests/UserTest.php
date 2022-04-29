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
use Tobento\Service\User\UserInterface;
use Tobento\Service\User\Addressable;
use Tobento\Service\User\Addresses;
use Tobento\Service\User\AddressesInterface;

/**
 * UserTest
 */
class UserTest extends TestCase
{
    public function testThatImplementsUserInterface()
    {
        $this->assertInstanceof(
            UserInterface::class,
            new User(username: 'username')
        );
    }
    
    public function testThatImplementsAddressable()
    {
        $this->assertInstanceof(
            Addressable::class,
            new User(username: 'username')
        );
    }
    
    public function testConstructorAndGetMethods()
    {
        $addresses = new Addresses();
        
        $user = new User(
            id: 1,
            number: 'user1',
            active: true,
            type: 'private',
            password: 'pw123',
            username: 'user123',
            email: 'user@example.com',
            smartphone: '111111111',
            locale: 'de-CH',
            birthday: '2002-05-23',
            dateCreated: '2020-05-23 13:20:34',
            dateUpdated: '2021-05-23 13:20:34',
            dateLastVisited: '2021-08-23 13:20:34',
            image: ['src' => 'image.jpg'],
            newsletter: true,
            addresses: $addresses, // null|AddressesInterface
        );
        
        $this->assertSame(1, $user->id());
        $this->assertSame('user1', $user->number());
        $this->assertSame(true, $user->active());
        $this->assertSame('private', $user->type());
        $this->assertSame('pw123', $user->password());
        $this->assertSame('user123', $user->username());
        $this->assertSame('user@example.com', $user->email());
        $this->assertSame('111111111', $user->smartphone());
        $this->assertSame('de-CH', $user->locale());
        $this->assertSame('2020-05-23 13:20:34', $user->dateCreated());
        $this->assertSame('2021-05-23 13:20:34', $user->dateUpdated());
        $this->assertSame('2021-08-23 13:20:34', $user->dateLastVisited());
        $this->assertSame(['src' => 'image.jpg'], $user->image());
        $this->assertSame(true, $user->newsletter());
        $this->assertSame('greet', $user->greetingSalutation());
        $this->assertSame('user123', $user->greeting());
        $this->assertSame($addresses, $user->addresses());    
    }
    
    public function testEmptyConstructorReturnsAddresses()
    {
        $this->assertInstanceof(
            AddressesInterface::class,
            (new User())->addresses()
        );
    }
    
    public function testSyncMethod()
    {
        $user = new User();
        $user->addresses()->address(['key' => 'payment']);
        
        $guest = new User();
        $guest->addresses()->address(['key' => 'shipping']);
        
        $this->assertSame(['shipping'], array_keys($guest->addresses()->all()));
        
        $guest->sync($user);
        
        $this->assertSame(['shipping', 'payment'], array_keys($guest->addresses()->all()));
    }
}