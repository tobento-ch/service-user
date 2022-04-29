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
 * AddressesFactory
 */
class AddressesFactory implements AddressesFactoryInterface
{
    /**
     * Create a new AddressesFactory
     *
     * @param null|AddressFactoryInterface $addressFactory
     */
    public function __construct(
        protected null|AddressFactoryInterface $addressFactory = null,
    ) {}
    
    /**
     * Create a new Addresses collection
     *
     * @param AddressInterface ...$addresses
     * @return AddressesInterface
     */
    public function createAddresses(AddressInterface ...$addresses): AddressesInterface
    {
        return new Addresses($this->addressFactory, ...$addresses);
    }
    
    /**
     * Create a new Addresses collection from an array.
     *
     * @param array $addresses
     * @return AddressesInterface
     */
    public function createAddressesFromArray(array $addresses): AddressesInterface
    {
        $a = new Addresses($this->addressFactory);
        
        foreach($addresses as $address) {
            if (is_array($address)) {
                $a->address($address);
            } elseif ($address instanceof AddressInterface) {
                $a->add($address);
            }
        }
        
        return $a;
    }
}