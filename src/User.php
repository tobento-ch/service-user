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

/**
 * User
 */
class User implements UserInterface, Addressable, Arrayable
{
    use HasAddresses;

    /**
     * @var null|string
     */
    protected null|string $greeting = null;

    /**
     * @var null|string
     */
    protected null|string $greetingSalutation = null;
        
    /**
     * Create a new User.
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
    public function __construct(
        protected int $id = 0,
        protected string $number = '',
        protected bool $active = true,
        protected string $type = '',
        protected string $password = '',
        protected string $username = '',
        protected string $email = '',
        protected string $smartphone = '',
        protected string $locale = '',
        protected string $birthday = '',
        protected string $dateCreated = '',
        protected string $dateUpdated = '',
        protected string $dateLastVisited = '',
        protected array $image = [],
        protected bool $newsletter = false,
        null|AddressesInterface $addresses = null,
    ) {
        $this->addresses = $addresses;
    }
    
    /**
     * Returns the id.
     *
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * Returns the number.
     *
     * @return string
     */
    public function number(): string
    {
        return $this->number ?: (string)$this->id();
    }

    /**
     * If the user is active.
     *
     * @return bool
     */
    public function active(): bool
    {
        return $this->active;
    }

    /**
     * Returns the type i.e private, business or whatever usage.
     *
     * @return string
     */
    public function type(): string
    {
        return $this->type;
    }
    
    /**
     * Returns the password.
     *
     * @return string
     */
    public function password(): string
    {
        return $this->password;
    }
    
    /**
     * Returns the username.
     *
     * @return string
     */
    public function username(): string
    {
        return $this->username;
    }

    /**
     * Returns the email.
     *
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }

    /**
     * Returns the smartphone.
     *
     * @return string
     */
    public function smartphone(): string
    {
        return $this->smartphone;
    }
    
    /**
     * Returns the locale.
     *
     * @return string
     */
    public function locale(): string
    {
        return $this->locale;
    }

    /**
     * Returns the birthday.
     *
     * @return string
     */
    public function birthday(): string
    {
        return $this->birthday;
    }

    /**
     * Returns the date created.
     *
     * @return string
     */
    public function dateCreated(): string
    {
        return $this->dateCreated;
    }

    /**
     * Returns the date updated.
     *
     * @return string
     */
    public function dateUpdated(): string
    {
        return $this->dateUpdated;
    }
    
    /**
     * Returns the date last visited.
     *
     * @return string
     */
    public function dateLastVisited(): string
    {
        return $this->dateLastVisited;
    }

    /**
     * Returns the image.
     *
     * @return array
     */
    public function image(): array
    {
        return $this->image;
    }
    
    /**
     * Returns whether the user wants a newsletter.
     *
     * @return bool
     */
    public function newsletter(): bool
    {
        return $this->newsletter;
    }

    /**
     * Returns the greeting salutation.
     * i.e 'greet', 'greet_ms', 'greet_mr', 'greet_firm', 'greet_family'
     *
     * @return string
     */
    public function greetingSalutation(): string
    {
        if (!is_null($this->greetingSalutation)) {
            return $this->greetingSalutation;
        }
        
        $this->greeting();
        return (string)$this->greetingSalutation;
    }
    
    /**
     * Returns the greeting.
     *
     * @return string
     */
    public function greeting(): string
    {
        if (!is_null($this->greeting)) {
            return $this->greeting;
        }
        
        $primaryAddress = $this->address();
        
        if (!empty($primaryAddress->greeting())) {
            $this->greetingSalutation = $primaryAddress->greetingSalutation();
            return $this->greeting = $primaryAddress->greeting();
        }
        
        $this->greetingSalutation = 'greet';
        return $this->greeting = $this->username();
    }

    /**
     * Sync user data.
     *
     * @param UserInterface $user
     * @return static $this
     */
    public function sync(UserInterface $user): static
    {
        if (! $user instanceof Addressable) {
            return $this;
        }
        
        foreach($user->addresses() as $key => $address) {
            if (! $this->hasAddress($key)) {
                $this->addresses()->add($address);   
            }
        }
        
        return $this;
    }
    
    /**
     * Object to array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id(),
            'number' => $this->number(),
            'active' => $this->active(),
            'type' => $this->type(),
            'password' => $this->password(),
            'username' => $this->username(),
            'email' => $this->email(),
            'smartphone' => $this->smartphone(),
            'language_key' => $this->locale(),
            'birthday' => $this->birthday(),
            'date_created' => $this->dateCreated(),
            'date_updated' => $this->dateUpdated(),
            'date_last_visited' => $this->dateLastVisited(),
            'image' => $this->image(),
            'newsletter' => $this->newsletter(),
            'addresses' => $this->addresses()->toArray(),
        ];
    }
}