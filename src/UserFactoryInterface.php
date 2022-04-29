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
 * UserFactoryInterface
 */
interface UserFactoryInterface
{
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
    ): UserInterface;
    
    /**
     * Create an new user based on the parameters.
     *
     * @param array<string, mixed> $user
     * @return UserInterface
     */
    public function createUserFromArray(array $user): UserInterface;
}