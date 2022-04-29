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

namespace Tobento\Service\User;

use Tobento\Service\Collection\Collection;

/**
 * AddressFactory
 */
class AddressFactory implements AddressFactoryInterface
{
    /**
     * Create an new Address based on the parameters.
     *
     * @param string $key
     * @param int $id
     * @param int $userId
     * @param string $group
     * @param bool $defaultAddress
     * @param string $salutation
     * @param string $name
     * @param string $firstname
     * @param string $lastname
     * @param string $company
     * @param string $address1
     * @param string $address2
     * @param string $address3
     * @param string $postcode
     * @param string $city
     * @param string $state
     * @param string $countryKey
     * @param string $country
     * @param string $email
     * @param string $telephone
     * @param string $smartphone
     * @param string $fax
     * @param string $website
     * @param string $locale
     * @param string $birthday
     * @param string $notice
     * @param string $info
     * @param bool $selectable
     */
    public function createAddress(
        string $key,
        int $id = 0,
        int $userId = 0,
        string $group = '',
        bool $defaultAddress = false,
        string $salutation = '',
        string $name = '',
        string $firstname = '',
        string $lastname = '',
        string $company = '',
        string $address1 = '',
        string $address2 = '',
        string $address3 = '',
        string $postcode = '',
        string $city = '',
        string $state = '',
        string $countryKey = '',
        string $country = '',
        string $email = '',
        string $telephone = '',
        string $smartphone = '',
        string $fax = '',
        string $website = '',
        string $locale = '',
        string $birthday = '',
        string $notice = '',
        string $info = '',
        bool $selectable = false,    
    ): AddressInterface {
        
        if ($defaultAddress) {
            $key = 'default';
        } else {
            $key = $key ?: $group.(string)$id;
        }
        
        return new Address(
            key: $key,
            id: $id,
            userId: $userId,
            group: $group,
            defaultAddress: $defaultAddress,
            salutation: $salutation,
            name: $name,
            firstname: $firstname,
            lastname: $lastname,
            company: $company,
            address1: $address1,
            address2: $address2,
            address3: $address3,
            postcode: $postcode,
            city: $city,
            state: $state,
            countryKey: $countryKey,
            country: $country,
            email: $email,
            telephone: $telephone,
            smartphone: $smartphone,
            fax: $fax,
            website: $website,
            locale: $locale,
            birthday: $birthday,
            notice: $notice,
            info: $info,
            selectable: $selectable,
        );
    }
    
    /**
     * Create an new Address based on the parameters.
     *
     * @param array<string, mixed> $address
     * @return AddressInterface
     */
    public function createAddressFromArray(array $address): AddressInterface
    {
        // we will use the collection to ensure data.
        $address = new Collection($address);
                
        return $this->createAddress(
            key: $address->get('key', ''),
            id: $address->get('id', 0),
            userId: $address->get('user_id', 0),
            group: $address->get('group', ''),
            defaultAddress: $address->get('default_address', false),
            salutation: $address->get('salutation', ''),
            name: $address->get('name', ''),
            firstname: $address->get('firstname', ''),
            lastname: $address->get('lastname', ''),
            company: $address->get('company', ''),
            address1: $address->get('address1', ''),
            address2: $address->get('address2', ''),
            address3: $address->get('address3', ''),
            postcode: $address->get('postcode', ''),
            city: $address->get('city', ''),
            state: $address->get('state', ''),
            countryKey: $address->get('country_key', ''),
            country: $address->get('country', ''),
            email: $address->get('email', ''),
            telephone: $address->get('telephone', ''),
            smartphone: $address->get('smartphone', ''),
            fax: $address->get('fax', ''),
            website: $address->get('website', ''),
            locale: $address->get('locale', ''),
            birthday: $address->get('birthday', ''),
            notice: $address->get('notice', ''),
            info: $address->get('info', ''),
            selectable: $address->get('selectable', false),
        );
    }
}