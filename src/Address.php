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
 * Address
 */
class Address implements AddressInterface, Arrayable
{
    /**
     * @var null|string
     */
    protected null|string $greeting = null;

    /**
     * @var null|string
     */
    protected null|string $greetingSalutation = null;

    /**
     * Create a new Address.
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
    public function __construct(
        protected string $key,
        protected int $id = 0,
        protected int $userId = 0,
        protected string $group = '',
        protected bool $defaultAddress = false,
        protected string $salutation = '',
        protected string $name = '',
        protected string $firstname = '',
        protected string $lastname = '',
        protected string $company = '',
        protected string $address1 = '',
        protected string $address2 = '',
        protected string $address3 = '',
        protected string $postcode = '',
        protected string $city = '',
        protected string $state = '',
        protected string $countryKey = '',
        protected string $country = '',
        protected string $email = '',
        protected string $telephone = '',
        protected string $smartphone = '',
        protected string $fax = '',
        protected string $website = '',
        protected string $locale = '',
        protected string $birthday = '',
        protected string $notice = '',
        protected string $info = '',
        protected bool $selectable = false,
    ) {}
    
    /**
     * Returns the address key.
     *
     * @return string
     */
    public function key(): string
    {
        return $this->key;
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
     * Returns the user id.
     *
     * @return int
     */
    public function userId(): int
    {
        return $this->userId;
    }
    
    /**
     * Returns the address group.
     *
     * @return string
     */
    public function group(): string
    {
        return $this->group;
    }
    
    /**
     * Returns a new instance with the specified group.
     *
     * @param string $group
     * @return static
     */
    public function withGroup(string $group): static
    {
        $new = clone $this;
        $new->group = $group;
        return $new;
    }
        
    /**
     * If it is the default address.
     *
     * @return bool
     */
    public function isDefaultAddress(): bool
    {
        return $this->defaultAddress;
    }

    /**
     * Returns a new instance with the specified value given.
     *
     * @param bool $isDefaultAddress
     * @return static
     */
    public function withDefaultAddress(bool $isDefaultAddress): static
    {
        $new = clone $this;
        $new->defaultAddress = $isDefaultAddress;
        return $new;
    }
    
    /**
     * Returns the salutation.
     * i.e 'ms', 'mr', 'company', 'family'
     *
     * @return string
     */
    public function salutation(): string
    {
        return $this->salutation;
    }

    /**
     * Returns a new instance with the specified salutation.
     * i.e 'ms', 'mr', 'company', 'family'
     *
     * @param string $salutation
     * @return static
     */
    public function withSalutation(string $salutation): static
    {
        $new = clone $this;
        $new->salutation = $salutation;
        return $new;
    }
    
    /**
     * Returns the name.
     *
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * Returns a new instance with the specified name.
     *
     * @param string $name
     * @return static
     */
    public function withName(string $name): static
    {
        $new = clone $this;
        $new->name = $name;
        return $new;
    }
    
    /**
     * Returns the firstname.
     *
     * @return string
     */
    public function firstname(): string
    {
        return $this->firstname;
    }

    /**
     * Returns a new instance with the specified firstname.
     *
     * @param string $firstname
     * @return static
     */
    public function withFirstname(string $firstname): static
    {
        $new = clone $this;
        $new->firstname = $firstname;
        return $new;
    }
        
    /**
     * Returns the lastname.
     *
     * @return string
     */
    public function lastname(): string
    {
        return $this->lastname;
    }

    /**
     * Returns a new instance with the specified lastname.
     *
     * @param string $lastname
     * @return static
     */
    public function withLastname(string $lastname): static
    {
        $new = clone $this;
        $new->lastname = $lastname;
        return $new;
    }
    
    /**
     * If has firstname and lastname.
     *
     * @return bool
     */
    public function hasFullname(): bool
    {
        return !empty($this->firstname()) && !empty($this->lastname());
    }

    /**
     * Returns the fullname. Firstname and lastname or name.
     *
     * @return string
     */
    public function fullname(): string
    {
        if ($this->hasFullname() || empty($this->name()))
        {
            if ($this->salutation() === 'family')
            {
                return trim($this->lastname(), ' ');
            }
            
            return trim($this->firstname().' '.$this->lastname(), ' ');
        }

        return $this->name();
    }

    /**
     * Returns the company.
     *
     * @return string
     */
    public function company(): string
    {
        return $this->company;
    }

    /**
     * Returns a new instance with the specified company.
     *
     * @param string $company
     * @return static
     */
    public function withCompany(string $company): static
    {
        $new = clone $this;
        $new->company = $company;
        return $new;
    }
    
    /**
     * Returns the greeting salutation.
     * i.e 'greet', 'greet_ms', 'greet_mr', 'greet_company', 'greet_family'
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

        if (!empty($this->fullname())) {
            if (empty($this->salutation())) {
                $this->greetingSalutation = 'greet';
            } else {
                $this->greetingSalutation = 'greet_'.$this->salutation();
            }
            
            return $this->greeting = $this->fullname();
        }
        
        $this->greetingSalutation = 'greet';
        return '';
    }

    /**
     * Returns a new instance with the specified greeting.
     *
     * @param string $greeting The greeting such as John.
     * @param string $salutation The salutation such as 'mr'.
     * @return static
     */
    public function withGreeting(string $greeting, string $salutation): static
    {
        $new = clone $this;
        $new->greeting = $greeting;
        $new->greetingSalutation = $salutation;
        return $new;
    }

    /**
     * Returns the address1.
     *
     * @return string
     */
    public function address1(): string
    {
        return $this->address1;
    }

    /**
     * Returns a new instance with the specified address1.
     *
     * @param string $address
     * @return static
     */
    public function withAddress1(string $address): static
    {
        $new = clone $this;
        $new->address1 = $address;
        return $new;
    }
    
    /**
     * Returns the address2.
     *
     * @return string
     */
    public function address2(): string
    {
        return $this->address2;
    }

    /**
     * Returns a new instance with the specified address2.
     *
     * @param string $address
     * @return static
     */
    public function withAddress2(string $address): static
    {
        $new = clone $this;
        $new->address2 = $address;
        return $new;
    }
    
    /**
     * Returns the address3.
     *
     * @return string
     */
    public function address3(): string
    {
        return $this->address3;
    }

    /**
     * Returns a new instance with the specified address3.
     *
     * @param string $address
     * @return static
     */
    public function withAddress3(string $address): static
    {
        $new = clone $this;
        $new->address3 = $address;
        return $new;
    }
    
    /**
     * Returns the postcode.
     *
     * @return string
     */
    public function postcode(): string
    {
        return $this->postcode;
    }

    /**
     * Returns a new instance with the specified postcode.
     *
     * @param string $postcode
     * @return static
     */
    public function withPostcode(string $postcode): static
    {
        $new = clone $this;
        $new->postcode = $postcode;
        return $new;
    }
    
    /**
     * Returns the city.
     *
     * @return string
     */
    public function city(): string
    {
        return $this->city;
    }

    /**
     * Returns a new instance with the specified city.
     *
     * @param string $city
     * @return static
     */
    public function withCity(string $city): static
    {
        $new = clone $this;
        $new->city = $city;
        return $new;
    }
    
    /**
     * If has postcode and/or city.
     *
     * @return bool
     */
    public function hasPostcodeCity(): bool
    {
        return !empty($this->postcode()) || !empty($this->city());
    }

    /**
     * Returns the postcode and/or city.
     *
     * @return string
     */
    public function postcodeCity(): string
    {
        return trim($this->postcode().' '.$this->city(), ' ');
    }
    
    /**
     * Returns the state.
     *
     * @return string
     */
    public function state(): string
    {
        return $this->state;
    }

    /**
     * Returns a new instance with the specified state.
     *
     * @param string $state
     * @return static
     */
    public function withState(string $state): static
    {
        $new = clone $this;
        $new->state = $state;
        return $new;
    }
    
    /**
     * Returns the country such as 'CH'.
     *
     * @return string
     */
    public function countryKey(): string
    {
        return $this->countryKey;
    }

    /**
     * Returns a new instance with the specified country key such as 'CH'.
     *
     * @param string $countryKey
     * @return static
     */
    public function withCountryKey(string $countryKey): static
    {
        $new = clone $this;
        $new->countryKey = $countryKey;
        return $new;
    }
    
    /**
     * Returns the country.
     *
     * @return string
     */
    public function country(): string
    {
        return $this->country ?: $this->countryKey();
    }

    /**
     * Returns a new instance with the specified country.
     *
     * @param string $country
     * @return static
     */
    public function withCountry(string $country): static
    {
        $new = clone $this;
        $new->country = $country;
        return $new;
    }
    
    /**
     * Has any contact information.
     *
     * @return bool
     */
    public function hasContact(): bool
    {
        if ($this->email() || $this->telephone() || $this->smartphone()) {
            return true;
        }
        
        return false;
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
     * Returns a new instance with the specified email.
     *
     * @param string $email
     * @return static
     */
    public function withEmail(string $email): static
    {
        $new = clone $this;
        $new->email = $email;
        return $new;
    }
    
    /**
     * Returns the telephone.
     *
     * @return string
     */
    public function telephone(): string
    {
        return $this->telephone;
    }

    /**
     * Returns a new instance with the specified telephone.
     *
     * @param string $telephone
     * @return static
     */
    public function withTelephone(string $telephone): static
    {
        $new = clone $this;
        $new->telephone = $telephone;
        return $new;
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
     * Returns a new instance with the specified smartphone.
     *
     * @param string $smartphone
     * @return static
     */
    public function withSmartphone(string $smartphone): static
    {
        $new = clone $this;
        $new->smartphone = $smartphone;
        return $new;
    }

    /**
     * Returns the fax.
     *
     * @return string
     */
    public function fax(): string
    {
        return $this->fax;
    }

    /**
     * Returns a new instance with the specified fax.
     *
     * @param string $fax
     * @return static
     */
    public function withFax(string $fax): static
    {
        $new = clone $this;
        $new->fax = $fax;
        return $new;
    }
    
    /**
     * Returns the website.
     *
     * @return string
     */
    public function website(): string
    {
        return $this->website;
    }

    /**
     * Returns a new instance with the specified website.
     *
     * @param string $website
     * @return static
     */
    public function withWebsite(string $website): static
    {
        $new = clone $this;
        $new->website = $website;
        return $new;
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
     * Returns a new instance with the specified locale.
     *
     * @param string $locale
     * @return static
     */
    public function withLocale(string $locale): static
    {
        $new = clone $this;
        $new->locale = $locale;
        return $new;
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
     * Returns a new instance with the specified birthday.
     *
     * @param string $birthday
     * @return static
     */
    public function withBirthday(string $birthday): static
    {
        $new = clone $this;
        $new->birthday = $birthday;
        return $new;
    }
        
    /**
     * Returns the notice.
     *
     * @return string
     */
    public function notice(): string
    {
        return $this->notice;
    }
    
    /**
     * Returns a new instance with the specified notice.
     *
     * @param string $notice
     * @return static
     */
    public function withNotice(string $notice): static
    {
        $new = clone $this;
        $new->notice = $notice;
        return $new;
    }

    /**
     * Returns the info.
     *
     * @return string
     */
    public function info(): string
    {
        return $this->info;
    }
    
    /**
     * Returns a new instance with the specified info.
     *
     * @param string $info
     * @return static
     */
    public function withInfo(string $info): static
    {
        $new = clone $this;
        $new->info = $info;
        return $new;
    }
    
    /**
     * Returns whether the address is selectable.
     *
     * @return bool
     */
    public function selectable(): bool
    {
        return $this->selectable;
    }
    
    /**
     * Returns a new instance with the specified selectable.
     *
     * @param bool $selectable
     * @return static
     */
    public function withSelectable(bool $selectable): static
    {
        $new = clone $this;
        $new->selectable = $selectable;
        return $new;
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
            'key' => $this->key(),
            'group' => $this->group(),
            'user_id' => $this->userId(),
            'default_address' => $this->isDefaultAddress(),
            'salutation' => $this->salutation(),
            'name' => $this->name(),
            'firstname' => $this->firstname(),
            'lastname' => $this->lastname(),
            'company' => $this->company(),
            'address1' => $this->address1(),
            'address2' => $this->address2(),
            'address3' => $this->address3(),
            'postcode' => $this->postcode(),
            'city' => $this->city(),
            'state' => $this->state(),
            'country_key' => $this->countryKey(),
            'country' => $this->country(),
            'email' => $this->email(),
            'telephone' => $this->telephone(),
            'smartphone' => $this->smartphone(),
            'fax' => $this->fax(),
            'website' => $this->website(),
            'locale' => $this->locale(),
            'birthday' => $this->birthday(),
            'notice' => $this->notice(),
            'info' => $this->info(),
            'selectable' => $this->selectable()
        ];
    }
}