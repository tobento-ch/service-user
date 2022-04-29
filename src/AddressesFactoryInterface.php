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
 * AddressesFactoryInterface
 */
interface AddressesFactoryInterface
{
    /**
     * Create a new Addresses collection
     *
     * @param AddressInterface ...$addresses
     * @return AddressesInterface
     */
    public function createAddresses(AddressInterface ...$addresses): AddressesInterface;
    
    /**
     * Create a new Addresses collection from an array.
     *
     * @param array $addresses
     * @return AddressesInterface
     */
    public function createAddressesFromArray(array $addresses): AddressesInterface;    
}