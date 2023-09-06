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
use Tobento\Service\Support\Arrayable;
use ArrayIterator;
use Traversable;

/**
 * Addresses
 */
class Addresses implements AddressesInterface, Arrayable
{
    /**
     * @var AddressFactoryInterface
     */
    protected AddressFactoryInterface $addressFactory;
    
    /**
     * @var array<string, AddressInterface>
     */
    protected array $addresses = [];
    
    /**
     * Create a new Addresses collection.
     *
     * @param null|AddressFactoryInterface $addressFactory
     * @param AddressInterface ...$addresses
     */
    public function __construct(
        null|AddressFactoryInterface $addressFactory = null,
        AddressInterface ...$addresses,
    ) {
        $this->addressFactory = $addressFactory ?: new AddressFactory();
        
        $this->add(...$addresses);
    }
    
    /**
     * Returns the address factory.
     * 
     * @return AddressFactoryInterface
     */
    public function addressFactory(): AddressFactoryInterface
    {
        return $this->addressFactory;
    }
        
    /**
     * If the address exist by the specified key.
     *
     * @param string $key The address key such as 'primary', 'shipping' e.g.
     * @param array $with Checks if any parameters such as 'firstname' is set, if one is not set, the address does not exist.
     * @return bool True if address exist, otherwise false.
     */
    public function has(string $key = 'primary', array $with = []): bool
    {
        if (!isset($this->addresses[$key])) {
            return false;
        }
        
        if (empty($with)) {
            return true;
        }
        
        $address = $this->addresses[$key]->toArray();
        
        foreach($with as $param)
        {
            if (!isset($address[$param])) {
                return false;
            }

            if (empty($address[$param])) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Returns the address by key.
     * If must create a new address if it does not exist.
     *
     * @param string The address key such as 'primary', 'shipping' e.g.
     * @return AddressInterface
     */
    public function get(string $key = 'primary'): AddressInterface
    {
        // get the address if is set.
        if (isset($this->addresses[$key])) {
            return $this->addresses[$key];
        }
        
        return $this->addresses[$key] = $this->create(['key' => $key]);
    }

    /**
     * Adds address(es).
     *
     * @param AddressInterface ...$address
     * @return static $this
     */
    public function add(AddressInterface ...$addresses): static
    {
        foreach($addresses as $address) {
            $this->addresses[$address->key()] = $address;
        }
        
        return $this;
    }
    
    /**
     * Create an address based on the parameters.
     *
     * @param array $address
     * @return AddressInterface
     */
    public function create(array $address): AddressInterface
    {
        return $this->addressFactory->createAddressFromArray($address);
    }

    /**
     * Create and add an address based on the parameters.
     *
     * @param array $address
     * @return AddressInterface
     */
    public function address(array $address): AddressInterface
    {
        $address = $this->create($address);
        $this->add($address);
        return $address;
    }

    /**
     * Deletes an address.
     *
     * @param string $key The address key such as 'primary', 'shipping' e.g.
     * @return static $this
     */
    public function delete(string $key): static
    {
        if ($this->has($key)) {
            unset($this->addresses[$key]);
        }
        
        return $this;
    }
    
    /**
     * Returns all addresses.
     *
     * @return array<string, AddressInterface>
     */
    public function all(): array
    {
        return $this->addresses;
    }

    /**
     * Returns a new instance with the filtered addresses.
     *
     * @param callable $callback
     * @return static
     */
    public function filter(callable $callback): static
    {
        $new = clone $this;
        $new->addresses = array_filter($this->addresses, $callback, ARRAY_FILTER_USE_BOTH);
        return $new;
    }

    /**
     * Returns a new instance with the specified address type filtered.
     *
     * @param string $group The group such as user, addressbook e.g.
     * @return static
     */
    public function group(string $group): static
    {
        return $this->filter(fn(AddressInterface $a): bool => $a->group() === $group);
    }
    
    /**
     * Get the iterator. 
     *
     * @return Traversable
     */
    public function getIterator(): Traversable
    {    
        return new ArrayIterator($this->all());
    }
        
    /**
     * Addresses to array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $addresses = [];
        
        foreach($this->all() as $address)
        {
            $addresses[] = $address->toArray();
        }
        
        return $addresses;
    }
}