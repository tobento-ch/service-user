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
use Tobento\Service\User\AddressFactory;
use Tobento\Service\User\AddressFactoryInterface;
use Tobento\Service\User\AddressInterface;

/**
 * AddressFactoryTest
 */
class AddressFactoryTest extends TestCase
{
    public function testThatImplementsAddressFactoryInterface()
    {
        $this->assertInstanceof(
            AddressFactoryInterface::class,
            new AddressFactory()
        );
    }
    
    public function testCreateAddressMethod()
    {
        $addressFactory = new AddressFactory();
        
        $data = [
            'key' => 'payment',
            'id' => 1,
            'userId' => 20,
            'group' => 'shop',
            'salutation' => 'mr',
            'name' => 'Adam Smith',
            'firstname' => 'Adam',
            'lastname' => 'Smith',
            'company' => 'Company Name',
            'address1' => 'Musterstrasse',
            'address2' => 'Address Line 2',
            'address3' => 'Address Line 3',
            'postcode' => '34',
            'city' => 'Bern',
            'state' => 'BE',
            'countryKey' => 'CH',
            'country' => 'Schweiz',
            'email' => 'user@example.com',
            'telephone' => '111111111',
            'smartphone' => '22222222',
            'fax' => '3333333',
            'website' => 'example.com',
            'locale' => 'de',
            'birthday' => '2002-05-23',
            'notice' => 'Notice message',
            'info' => 'Info message',
            'selectable' => true,
        ];
        
        $address = $addressFactory->createAddress(...$data);
        
        $this->assertInstanceof(
            AddressInterface::class,
            $address
        ); 
    }
    
    public function testCreateUserFromArrayMethod()
    {
        $addressFactory = new AddressFactory();
        
        $data = [
            'key' => 'payment',
            'id' => 1,
            'userId' => 20,
            'group' => 'shop',
            'salutation' => 'mr',
            'name' => 'Adam Smith',
            'firstname' => 'Adam',
            'lastname' => 'Smith',
            'company' => 'Company Name',
            'address1' => 'Musterstrasse',
            'address2' => 'Address Line 2',
            'address3' => 'Address Line 3',
            'postcode' => '34',
            'city' => 'Bern',
            'state' => 'BE',
            'countryKey' => 'CH',
            'country' => 'Schweiz',
            'email' => 'user@example.com',
            'telephone' => '111111111',
            'smartphone' => '22222222',
            'fax' => '3333333',
            'website' => 'example.com',
            'locale' => 'de',
            'birthday' => '2002-05-23',
            'notice' => 'Notice message',
            'info' => 'Info message',
            'selectable' => true,
        ];
        
        $address = $addressFactory->createAddressFromArray($data);
        
        $this->assertInstanceof(
            AddressInterface::class,
            $address
        );
    }
}