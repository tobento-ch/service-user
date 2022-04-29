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
 * UserFactory
 */
class UserFactory implements UserFactoryInterface
{
    /**
     * Create a new UserFactory
     *
     * @param null|AddressesFactoryInterface $addressesFactory
     */
    public function __construct(
        protected null|AddressesFactoryInterface $addressesFactory = null
    ) {}
    
    /**
     * Create an new user based on the parameters.
     *
     * @param int $id
     * @param string $number
     * @param bool $active
     * @param string $type
     * @param string $password
     * @param string $username
     * @param string $email
     * @param string $smartphone
     * @param string $locale
     * @param string $birthday
     * @param string $dateCreated
     * @param string $dateUpdated
     * @param string $dateLastVisited
     * @param array $image
     * @param bool $newsletter
     * @param null|AddressesInterface $addresses
     */
    public function createUser(
        int $id = 0,
        string $number = '',
        bool $active = true,
        string $type = '',
        string $password = '',
        string $username = '',
        string $email = '',
        string $smartphone = '',
        string $locale = '',
        string $birthday = '',
        string $dateCreated = '',
        string $dateUpdated = '',
        string $dateLastVisited = '',
        array $image = [],
        bool $newsletter = false,
        null|AddressesInterface $addresses = null,    
    ): UserInterface {
        
        if ($this->addressesFactory && is_null($addresses)) {
            $addresses = $this->addressesFactory->createAddresses();
        }
        
        return new User(
            id: $id,
            number: $number,
            active: $active,
            type: $type,
            password: $password,
            username: $username,
            email: $email,
            smartphone: $smartphone,
            locale: $locale,
            birthday: $birthday,
            dateCreated: $dateCreated,
            dateUpdated: $dateUpdated,
            dateLastVisited: $dateLastVisited,
            image: $image,
            newsletter: $newsletter,
            addresses: $addresses,
        );
    }
    
    /**
     * Create an new user based on the parameters.
     *
     * @param array<string, mixed> $user
     * @return UserInterface
     */
    public function createUserFromArray(array $user): UserInterface
    {
        // we will use the collection to ensure data.
        $user = new Collection($user);
        
        $addresses = $user->get('addresses');
        
        if ($this->addressesFactory && is_array($addresses)) {
            $addresses = $this->addressesFactory->createAddressesFromArray($addresses);
        }
    
        if (! $addresses instanceof AddressesInterface) {
            $addresses = null;
        }
        
        return $this->createUser(
            id: $user->get('id', 0),
            number: $user->get('number', ''),
            active: $user->get('active', true),
            type: $user->get('type', ''),
            password: $user->get('password', ''),
            username: $user->get('username', ''),
            email: $user->get('email', ''),
            smartphone: $user->get('smartphone', ''),
            locale: $user->get('locale', ''),
            birthday: $user->get('birthday', ''),
            dateCreated: $user->get('dateCreated', ''),
            dateUpdated: $user->get('dateUpdated', ''),
            dateLastVisited: $user->get('dateLastVisited', ''),
            image: $user->get('image', []),
            newsletter: $user->get('newsletter', false),
            addresses: $addresses,
        );
    }
}