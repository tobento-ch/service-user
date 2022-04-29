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
use Tobento\Service\User\Address;
use Tobento\Service\User\AddressInterface;

/**
 * AddressTest
 */
class AddressTest extends TestCase
{
    public function testThatImplementsAddressInterface()
    {
        $this->assertInstanceof(
            AddressInterface::class,
            new Address(key: 'payment')
        );
    }
    
    public function testConstructorAndGetMethods()
    {
        $address = new Address(
            key: 'payment',
            id: 1,
            userId: 20,
            group: 'shop',
            defaultAddress: false,
            salutation: 'mr',
            name: 'Adam Smith',
            firstname: 'Adam',
            lastname: 'Smith',
            company: 'Company Name',
            address1: 'Musterstrasse',
            address2: 'Address Line 2',
            address3: 'Address Line 3',
            postcode: '34',
            city: 'Bern',
            state: 'BE',
            countryKey: 'CH',
            country: 'Schweiz',
            email: 'user@example.com',
            telephone: '111111111',
            smartphone: '22222222',
            fax: '3333333',
            website: 'example.com',
            locale: 'de',
            birthday: '2002-05-23',
            notice: 'Notice message',
            info: 'Info message',
            selectable: true,
        );
        
        $this->assertSame('payment', $address->key());
        $this->assertSame(1, $address->id());
        $this->assertSame(20, $address->userId());
        $this->assertSame('shop', $address->group());
        $this->assertSame(false, $address->isDefaultAddress());
        $this->assertSame('mr', $address->salutation());
        $this->assertSame('Adam Smith', $address->name());
        $this->assertSame('Adam', $address->firstname());
        $this->assertSame('Smith', $address->lastname());
        $this->assertSame('Company Name', $address->company());
        $this->assertSame('Musterstrasse', $address->address1());
        $this->assertSame('Address Line 2', $address->address2());
        $this->assertSame('Address Line 3', $address->address3());
        $this->assertSame('34', $address->postcode());
        $this->assertSame('Bern', $address->city());
        $this->assertSame('BE', $address->state());
        $this->assertSame('CH', $address->countryKey());
        $this->assertSame('Schweiz', $address->country());
        $this->assertSame('user@example.com', $address->email());
        $this->assertSame('111111111', $address->telephone());
        $this->assertSame('22222222', $address->smartphone());
        $this->assertSame('3333333', $address->fax());
        $this->assertSame('example.com', $address->website());
        $this->assertSame('de', $address->locale());
        $this->assertSame('2002-05-23', $address->birthday());
        $this->assertSame('Notice message', $address->notice());
        $this->assertSame('Info message', $address->info());
        $this->assertSame(true, $address->selectable());
    }
    
    public function testFullnameMethods()
    {
        $address = new Address(
            key: 'payment',
            firstname: 'Adam',
            lastname: 'Smith',
        );
        
        $this->assertSame(true, $address->hasFullname());
        $this->assertSame('Adam Smith', $address->fullname());
        
        $address = new Address(
            key: 'payment',
            firstname: 'Adam',
            lastname: 'Smith',
            salutation: 'family',
        );
        
        $this->assertSame(true, $address->hasFullname());
        $this->assertSame('Smith', $address->fullname());
        
        $address = new Address(
            key: 'payment',
            firstname: 'Adam',
            lastname: 'Smith',
            name: 'A. Smith',
        );
        
        $this->assertSame(true, $address->hasFullname());
        $this->assertSame('Adam Smith', $address->fullname());
        
        $address = new Address(
            key: 'payment',
            firstname: 'Adam',
            name: 'A. Smith',
        );
        
        $this->assertSame(false, $address->hasFullname());
        $this->assertSame('A. Smith', $address->fullname());
    }
    
    public function testGreetingMethods()
    {
        $address = new Address(
            key: 'payment',
            firstname: 'Adam',
            lastname: 'Smith',
            salutation: 'mr',
        );
        
        $this->assertSame('greet_mr', $address->greetingSalutation());
        $this->assertSame('Adam Smith', $address->greeting());
    }
    
    public function testPostcodeCityMethods()
    {
        $address = new Address(
            key: 'payment',
            postcode: '3000',
            city: 'Bern',
        );
        
        $this->assertSame(true, $address->hasPostcodeCity());
        $this->assertSame('3000 Bern', $address->postcodeCity());
        
        $address = new Address(
            key: 'payment',
            city: 'Bern',
        );
        
        $this->assertSame(true, $address->hasPostcodeCity());
        $this->assertSame('Bern', $address->postcodeCity());
        
        $address = new Address(
            key: 'payment',
            postcode: '3000',
        );
        
        $this->assertSame(true, $address->hasPostcodeCity());
        $this->assertSame('3000', $address->postcodeCity());
        
        $address = new Address(
            key: 'payment',
        );
        
        $this->assertSame(false, $address->hasPostcodeCity());
        $this->assertSame('', $address->postcodeCity());        
    }
    
    public function testHasContactMethod()
    {
        $this->assertSame(
            true,
            (new Address(key: 'pay', email: 'user@example.com'))->hasContact()
        );
        
        $this->assertSame(
            true,
            (new Address(key: 'pay', smartphone: '1111'))->hasContact()
        );
        
        $this->assertSame(
            true,
            (new Address(key: 'pay', telephone: '1111'))->hasContact()
        );
        
        $this->assertSame(
            false,
            (new Address(key: 'pay'))->hasContact()
        );        
    }
    
    public function testWithGroupMethod()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withGroup('name');
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame('name', $addressNew->group());
    }
    
    public function testWithDefaultAddressMethod()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withDefaultAddress(true);
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame(true, $addressNew->isDefaultAddress());
    }
    
    public function testWithSalutationMethod()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withSalutation('mr');
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame('mr', $addressNew->salutation());
    }
    
    public function testWithNameMethod()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withName('name');
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame('name', $addressNew->name());
    }
    
    public function testWithFirstnameMethod()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withFirstname('name');
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame('name', $addressNew->firstname());
    }
    
    public function testWithLastnameMethod()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withLastname('name');
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame('name', $addressNew->lastname());
    }
    
    public function testWithCompanyMethod()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withCompany('name');
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame('name', $addressNew->company());
    }
    
    public function testWithAddress1Method()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withAddress1('address');
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame('address', $addressNew->address1());
    }
    
    public function testWithAddress2Method()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withAddress2('address');
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame('address', $addressNew->address2());
    }
    
    public function testWithAddress3Method()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withAddress3('address');
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame('address', $addressNew->address3());
    }    
    
    public function testWithPostcodeMethod()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withPostcode('3000');
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame('3000', $addressNew->postcode());
    }
    
    public function testWithCityMethod()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withCity('name');
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame('name', $addressNew->city());
    }
    
    public function testWithStateMethod()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withState('name');
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame('name', $addressNew->state());
    }
    
    public function testWithCountryKeyMethod()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withCountryKey('CH');
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame('CH', $addressNew->countryKey());
    }
    
    public function testWithCountryMethod()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withCountry('name');
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame('name', $addressNew->country());
    }
    
    public function testWithEmailMethod()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withEmail('name@example.com');
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame('name@example.com', $addressNew->email());
    }
    
    public function testWithTelephoneMethod()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withTelephone('123456');
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame('123456', $addressNew->telephone());
    }
    
    public function testWithSmartphoneMethod()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withSmartphone('123456');
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame('123456', $addressNew->smartphone());
    }
    
    public function testWithFaxMethod()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withFax('123456');
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame('123456', $addressNew->fax());
    }
    
    public function testWithWebsiteMethod()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withWebsite('example.com');
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame('example.com', $addressNew->website());
    }
    
    public function testWithLocaleMethod()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withLocale('de');
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame('de', $addressNew->locale());
    }
    
    public function testWithBirthdayMethod()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withBirthday('2002-05-23');
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame('2002-05-23', $addressNew->birthday());
    }
    
    public function testWithNoticeMethod()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withNotice('message');
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame('message', $addressNew->notice());
    }
    
    public function testWithInfoMethod()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withInfo('message');
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame('message', $addressNew->info());
    }
    
    public function testWithSelectableMethod()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withSelectable(true);
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame(true, $addressNew->selectable());
    }
    
    public function testWithGreetingMethod()
    {
        $address = new Address(key: 'payment');
        $addressNew = $address->withGreeting('John Smith', 'mr');
        
        $this->assertFalse($address === $addressNew);
        $this->assertSame('mr', $addressNew->greetingSalutation());
        $this->assertSame('John Smith', $addressNew->greeting());
    }    
}