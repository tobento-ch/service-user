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
use Tobento\Service\User\UserFactory;
use Tobento\Service\User\UserFactoryInterface;
use Tobento\Service\User\UserInterface;
use Tobento\Service\User\AddressesFactory;
use Tobento\Service\User\AddressesFactoryInterface;

/**
 * UserFactoryTest
 */
class UserFactoryTest extends TestCase
{
    public function testThatImplementsUserFactoryInterface()
    {
        $this->assertInstanceof(
            UserFactoryInterface::class,
            new UserFactory()
        );
    }
    
    public function testCreateUserMethod()
    {
        $userFactory = new UserFactory();
        
        $data = [
            'id' => 1,
            'number' => 'user1',
            'active' => true,
            'type' => 'private',
            'password' => 'pw123',
            'username' => 'user123',
            'email' => 'user@example.com',
            'smartphone' => '111111111',
            'locale' => 'de-CH',
            'birthday' => '2002-05-23',
            'dateCreated' => '2020-05-23 13:20:34',
            'dateUpdated' => '2021-05-23 13:20:34',
            'dateLastVisited' => '2021-08-23 13:20:34',
            'image' => ['src' => 'image.jpg'],
            'newsletter' => true,
            'addresses' => null,
        ];
        
        $user = $userFactory->createUser(...$data);
        
        $this->assertInstanceof(
            UserInterface::class,
            $user
        ); 
    }
    
    public function testCreateUserFromArrayMethod()
    {
        $userFactory = new UserFactory();
        
        $data = [
            'id' => 1,
            'number' => 'user1',
            'active' => true,
            'type' => 'private',
            'password' => 'pw123',
            'username' => 'user123',
            'email' => 'user@example.com',
            'smartphone' => '111111111',
            'locale' => 'de-CH',
            'birthday' => '2002-05-23',
            'dateCreated' => '2020-05-23 13:20:34',
            'dateUpdated' => '2021-05-23 13:20:34',
            'dateLastVisited' => '2021-08-23 13:20:34',
            'image' => ['src' => 'image.jpg'],
            'newsletter' => true,
            'addresses' => null,
        ];
        
        $user = $userFactory->createUserFromArray($data);
        
        $this->assertInstanceof(
            UserInterface::class,
            $user
        );
    }
    
    public function testCreateUserFromArrayMethodWithAddresses()
    {
        $userFactory = new UserFactory(new AddressesFactory());
        
        $data = [
            'id' => 1,
            'addresses' => [
                ['key' => 'payment'],
                ['key' => 'shipping'],
            ],
        ];
        
        $user = $userFactory->createUserFromArray($data);
        
        $this->assertSame(['payment', 'shipping'], array_keys($user->addresses()->all()));
    }
}