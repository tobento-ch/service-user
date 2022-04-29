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

use Tobento\Service\Support\Arrayable;
use IteratorAggregate;

/**
 * AddressesInterface
 */
interface AddressesInterface extends IteratorAggregate, Arrayable
{
    /**
     * Returns the address factory.
     * 
     * @return AddressFactoryInterface
     */
    public function addressFactory(): AddressFactoryInterface;
        
    /**
     * If the address exist by the specified key.
     *
     * @param string $key The address key such as 'default', 'shipping' e.g.
     * @param array $with Checks if any parameters such as 'firstname' is set, if one is not set, the address does not exist.
     * @return bool True if address exist, otherwise false.
     */
    public function has(string $key = 'default', array $with = []): bool;
    
    /**
     * Returns the address by key.
     * If must create a new address if it does not exist.
     *
     * @param string The address key such as 'default', 'shipping' e.g.
     * @return AddressInterface
     */
    public function get(string $key = 'default'): AddressInterface;

    /**
     * Adds address(es).
     *
     * @param AddressInterface ...$address
     * @return static $this
     */
    public function add(AddressInterface ...$addresses): static;
    
    /**
     * Create an address based on the parameters.
     *
     * @param array $address
     * @return AddressInterface
     */
    public function create(array $address): AddressInterface;

    /**
     * Create and add an address based on the parameters.
     *
     * @param array $address
     * @return AddressInterface
     */
    public function address(array $address): AddressInterface;

    /**
     * Deletes an address.
     *
     * @param string $key The address key such as 'default', 'shipping' e.g.
     * @return static $this
     */
    public function delete(string $key): static;
    
    /**
     * Returns all addresses.
     *
     * @return array<string, AddressInterface>
     */
    public function all(): array;

    /**
     * Returns a new instance with the filtered addresses.
     *
     * @param callable $callback
     * @return static
     */
    public function filter(callable $callback): static;

    /**
     * Returns a new instance with the specified address type filtered.
     *
     * @param string $group The group such as user, addressbook e.g.
     * @return static
     */
    public function group(string $group): static;
}