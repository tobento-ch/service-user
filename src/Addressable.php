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
 * Addressable
 */
interface Addressable
{
    /**
     * Returns the addresses.
     *
     * @return AddressesInterface
     */
    public function addresses(): AddressesInterface;  
    
    /**
     * If the address exist.
     *
     * @param string $key The address key such as 'default', 'shipping' e.g.
     * @param array $with Checks if any parameters such as 'firstname' is set, if one is not set, the address does not exist.
     * @return bool True if address exist, otherwise false.
     */
    public function hasAddress(string $key = 'default', array $with = []): bool;
    
    /**
     * Returns the address by key.
     *
     * @param string $key The address key such as 'default', 'shipping' e.g.
     * @return AddressInterface
     */
    public function address(string $key = 'default'): AddressInterface;
}