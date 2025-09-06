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

interface UserAwareInterface
{
    /**
     * Create an user that represents the object.
     *
     * @return UserInterface
     */
    public function toUser(): UserInterface;
}