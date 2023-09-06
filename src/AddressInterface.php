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
 * AddressInterface
 */
interface AddressInterface extends Arrayable
{
    /**
     * Returns the address key.
     *
     * @return string
     */
    public function key(): string;
    
    /**
     * If it is the primary address.
     *
     * @return bool
     */
    public function isPrimary(): bool;

    /**
     * Returns the id.
     *
     * @return int
     */
    public function id(): int;
    
    /**
     * Returns the user id.
     *
     * @return int
     */
    public function userId(): int;
    
    /**
     * Returns the address group.
     *
     * @return string
     */
    public function group(): string;
    
    /**
     * Returns a new instance with the specified group.
     *
     * @param string $group
     * @return static
     */
    public function withGroup(string $group): static;
    
    /**
     * Returns the salutation.
     * i.e 'ms', 'mr', 'company', 'family'
     *
     * @return string
     */
    public function salutation(): string;

    /**
     * Returns a new instance with the specified salutation.
     * i.e 'ms', 'mr', 'company', 'family'
     *
     * @param string $salutation
     * @return static
     */
    public function withSalutation(string $salutation): static;
    
    /**
     * Returns the name.
     *
     * @return string
     */
    public function name(): string;

    /**
     * Returns a new instance with the specified name.
     *
     * @param string $name
     * @return static
     */
    public function withName(string $name): static;
    
    /**
     * Returns the firstname.
     *
     * @return string
     */
    public function firstname(): string;

    /**
     * Returns a new instance with the specified firstname.
     *
     * @param string $firstname
     * @return static
     */
    public function withFirstname(string $firstname): static;
        
    /**
     * Returns the lastname.
     *
     * @return string
     */
    public function lastname(): string;

    /**
     * Returns a new instance with the specified lastname.
     *
     * @param string $lastname
     * @return static
     */
    public function withLastname(string $lastname): static;
    
    /**
     * If has firstname and lastname.
     *
     * @return bool
     */
    public function hasFullname(): bool;

    /**
     * Returns the fullname. Firstname and lastname or name.
     *
     * @return string
     */
    public function fullname(): string;

    /**
     * Returns the company.
     *
     * @return string
     */
    public function company(): string;

    /**
     * Returns a new instance with the specified company.
     *
     * @param string $company
     * @return static
     */
    public function withCompany(string $company): static;
    
    /**
     * Returns the greeting salutation.
     * i.e 'greet', 'greet_ms', 'greet_mr', 'greet_company', 'greet_family'
     *
     * @return string
     */
    public function greetingSalutation(): string;
    
    /**
     * Returns the greeting.
     *
     * @return string
     */
    public function greeting(): string;

    /**
     * Returns a new instance with the specified greeting.
     *
     * @param string $greeting The greeting such as John.
     * @param string $salutation The salutation such as 'mr'.
     * @return static
     */
    public function withGreeting(string $greeting, string $salutation): static;

    /**
     * Returns the address1.
     *
     * @return string
     */
    public function address1(): string;

    /**
     * Returns a new instance with the specified address1.
     *
     * @param string $address
     * @return static
     */
    public function withAddress1(string $address): static;
    
    /**
     * Returns the address2.
     *
     * @return string
     */
    public function address2(): string;

    /**
     * Returns a new instance with the specified address2.
     *
     * @param string $address
     * @return static
     */
    public function withAddress2(string $address): static;
    
    /**
     * Returns the address3.
     *
     * @return string
     */
    public function address3(): string;

    /**
     * Returns a new instance with the specified address3.
     *
     * @param string $address
     * @return static
     */
    public function withAddress3(string $address): static;
    
    /**
     * Returns the postcode.
     *
     * @return string
     */
    public function postcode(): string;

    /**
     * Returns a new instance with the specified postcode.
     *
     * @param string $postcode
     * @return static
     */
    public function withPostcode(string $postcode): static;
    
    /**
     * Returns the city.
     *
     * @return string
     */
    public function city(): string;

    /**
     * Returns a new instance with the specified city.
     *
     * @param string $city
     * @return static
     */
    public function withCity(string $city): static;
    
    /**
     * If has postcode and/or city.
     *
     * @return bool
     */
    public function hasPostcodeCity(): bool;

    /**
     * Returns the postcode and/or city.
     *
     * @return string
     */
    public function postcodeCity(): string;
    
    /**
     * Returns the state.
     *
     * @return string
     */
    public function state(): string;

    /**
     * Returns a new instance with the specified state.
     *
     * @param string $state
     * @return static
     */
    public function withState(string $state): static;
    
    /**
     * Returns the country such as 'CH'.
     *
     * @return string
     */
    public function countryKey(): string;

    /**
     * Returns a new instance with the specified country key such as 'CH'.
     *
     * @param string $countryKey
     * @return static
     */
    public function withCountryKey(string $countryKey): static;
    
    /**
     * Returns the country.
     *
     * @return string
     */
    public function country(): string;

    /**
     * Returns a new instance with the specified country.
     *
     * @param string $country
     * @return static
     */
    public function withCountry(string $country): static;
    
    /**
     * Has any contact information.
     *
     * @return bool
     */
    public function hasContact(): bool;
        
    /**
     * Returns the email.
     *
     * @return string
     */
    public function email(): string;

    /**
     * Returns a new instance with the specified email.
     *
     * @param string $email
     * @return static
     */
    public function withEmail(string $email): static;
    
    /**
     * Returns the telephone.
     *
     * @return string
     */
    public function telephone(): string;

    /**
     * Returns a new instance with the specified telephone.
     *
     * @param string $telephone
     * @return static
     */
    public function withTelephone(string $telephone): static;
    
    /**
     * Returns the smartphone.
     *
     * @return string
     */
    public function smartphone(): string;

    /**
     * Returns a new instance with the specified smartphone.
     *
     * @param string $smartphone
     * @return static
     */
    public function withSmartphone(string $smartphone): static;

    /**
     * Returns the fax.
     *
     * @return string
     */
    public function fax(): string;

    /**
     * Returns a new instance with the specified fax.
     *
     * @param string $fax
     * @return static
     */
    public function withFax(string $fax): static;
    
    /**
     * Returns the website.
     *
     * @return string
     */
    public function website(): string;

    /**
     * Returns a new instance with the specified website.
     *
     * @param string $website
     * @return static
     */
    public function withWebsite(string $website): static;
    
    /**
     * Returns the locale.
     *
     * @return string
     */
    public function locale(): string;

    /**
     * Returns a new instance with the specified locale.
     *
     * @param string $locale
     * @return static
     */
    public function withLocale(string $locale): static;

    /**
     * Returns the birthday.
     *
     * @return string
     */
    public function birthday(): string;
 
    /**
     * Returns a new instance with the specified birthday.
     *
     * @param string $birthday
     * @return static
     */
    public function withBirthday(string $birthday): static;
        
    /**
     * Returns the notice.
     *
     * @return string
     */
    public function notice(): string;
    
    /**
     * Returns a new instance with the specified notice.
     *
     * @param string $notice
     * @return static
     */
    public function withNotice(string $notice): static;

    /**
     * Returns the info.
     *
     * @return string
     */
    public function info(): string;
    
    /**
     * Returns a new instance with the specified info.
     *
     * @param string $info
     * @return static
     */
    public function withInfo(string $info): static;
    
    /**
     * Returns whether the address is selectable.
     *
     * @return bool
     */
    public function selectable(): bool;
    
    /**
     * Returns a new instance with the specified selectable.
     *
     * @param bool $selectable
     * @return static
     */
    public function withSelectable(bool $selectable): static;
}