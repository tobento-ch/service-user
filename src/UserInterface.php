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
 * UserInterface
 */
interface UserInterface extends Arrayable
{
    /**
     * Returns the id.
     *
     * @return int
     */
    public function id(): int;

    /**
     * Returns the number.
     *
     * @return string
     */
    public function number(): string;

    /**
     * If the user is active.
     *
     * @return bool
     */
    public function active(): bool;

    /**
     * Returns the type i.e private, business or whatever usage.
     *
     * @return string
     */
    public function type(): string;
    
    /**
     * Returns the password.
     *
     * @return string
     */
    public function password(): string;
    
    /**
     * Returns the username.
     *
     * @return string
     */
    public function username(): string;

    /**
     * Returns the email.
     *
     * @return string
     */
    public function email(): string;

    /**
     * Returns the smartphone.
     *
     * @return string
     */
    public function smartphone(): string;
    
    /**
     * Returns the locale.
     *
     * @return string
     */
    public function locale(): string;

    /**
     * Returns the birthday.
     *
     * @return string
     */
    public function birthday(): string;

    /**
     * Returns the date created.
     *
     * @return string
     */
    public function dateCreated(): string;

    /**
     * Returns the date updated.
     *
     * @return string
     */
    public function dateUpdated(): string;
    
    /**
     * Returns the date last visited.
     *
     * @return string
     */
    public function dateLastVisited(): string;

    /**
     * Returns the image.
     *
     * @return array
     */
    public function image(): array;
    
    /**
     * Returns whether the user wants a newsletter.
     *
     * @return bool
     */
    public function newsletter(): bool;

    /**
     * Returns the greeting salutation.
     * i.e 'greet', 'greet_ms', 'greet_mr', 'greet_firm', 'greet_family'
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
     * Sync user data.
     *
     * @param UserInterface $user
     * @return static $this
     */
    public function sync(UserInterface $user): static;
}