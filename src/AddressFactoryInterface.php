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

/**
 * AddressFactoryInterface
 */
interface AddressFactoryInterface
{
    /**
     * Create an new Address based on the parameters.
     *
     * @param string $key
     * @param int $id
     * @param int $userId
     * @param string $group
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
    ): AddressInterface;
    
    /**
     * Create an new Address based on the parameters.
     *
     * @param array<string, mixed> $address
     * @return AddressInterface
     */
    public function createAddressFromArray(array $address): AddressInterface;
}