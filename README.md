# User Service

A user and address interface for PHP applications.

## Table of Contents

- [Getting started](#getting-started)
    - [Requirements](#requirements)
    - [Highlights](#highlights)
- [Documentation](#documentation)
    - [User](#user)
        - [Create User](#create-user)
        - [User Factory](#user-factory)
        - [User Interface](#user-interface)
    - [Address](#address)
        - [Create Address](#create-address)
        - [Address Factory](#address-factory)
        - [Address Interface](#address-interface)
    - [Addresses](#addresses)
        - [Create Addresses](#create-addresses)
        - [Addresses Factory](#addresses-factory)
        - [Addresses Interface](#addresses-interface)
    - [Addressable](#addressable)
- [Credits](#credits)
___

# Getting started

Add the latest version of the user service project running this command.

```
composer require tobento/service-user
```

## Requirements

- PHP 8.0 or greater

## Highlights

- Framework-agnostic, will work with any project
- Decoupled design

# Documentation

## User

### Create User

```php
use Tobento\Service\User\User;
use Tobento\Service\User\UserInterface;
use Tobento\Service\User\Addressable;

$user = new User(username: 'username');

var_dump($user instanceof UserInterface);
// bool(true)

var_dump($user instanceof Addressable);
// bool(true)
```

Check out the [User Interface](#user-interface) to learn more about the interface.

Check out [Addressable](#addressable) to learn more about the interface.

### User Factory

Easily create a user with the provided user factory:

**createUser**

```php
use Tobento\Service\User\UserFactory;
use Tobento\Service\User\UserFactoryInterface;
use Tobento\Service\User\UserInterface;
use Tobento\Service\User\AddressesFactoryInterface;

$userFactory = new UserFactory(
    addressesFactory: null, // null|AddressesFactoryInterface
);

var_dump($userFactory instanceof UserFactoryInterface);
// bool(true)

$user = $userFactory->createUser(username: 'username');

var_dump($user instanceof UserInterface);
// bool(true)
```

**Parameters:**

```php
use Tobento\Service\User\UserFactory;
use Tobento\Service\User\AddressesInterface;

$userFactory = new UserFactory();

$user = $userFactory->createUser(
    id: 1,
    number: 'user1',
    active: true,
    type: 'private',
    password: '',
    username: '',
    email: 'user@example.com',
    smartphone: '',
    locale: 'de-CH',
    birthday: '',
    dateCreated: '',
    dateUpdated: '',
    dateLastVisited: '',
    image: [],
    newsletter: false,
    addresses: null, // null|AddressesInterface
);
```

**createUserFromArray**

```php
use Tobento\Service\User\UserFactory;

$userFactory = new UserFactory();

$user = $userFactory->createUserFromArray([
    'username' => 'username',
]);
```

If you want to create a user with addresses, you need to set an AddressesFactory, otherwise addresses gets not created.

```php
use Tobento\Service\User\UserFactory;
use Tobento\Service\User\AddressesFactory;

$userFactory = new UserFactory(new AddressesFactory());

$user = $userFactory->createUserFromArray([
    'username' => 'username',
    'addresses' => [
        ['key' => 'payment'],
        ['key' => 'shipping'],
    ],
]);
```


### User Interface

```php
use Tobento\Service\User\UserFactory;
use Tobento\Service\User\UserInterface;

$userFactory = new UserFactory();

$user = $userFactory->createUser(username: 'username');

var_dump($user instanceof UserInterface);
// bool(true)

var_dump($user->id());
// int(0)

var_dump($user->number());
// string(0) ""

var_dump($user->active());
// bool(true)

var_dump($user->type());
// string(0) ""

var_dump($user->password());
// string(0) ""

var_dump($user->username());
// string(8) "username"

var_dump($user->email());
// string(0) ""

var_dump($user->smartphone());
// string(0) ""

var_dump($user->locale());
// string(0) ""

var_dump($user->birthday());
// string(0) ""

var_dump($user->dateCreated());
// string(0) ""

var_dump($user->dateUpdated());
// string(0) ""

var_dump($user->dateLastVisited());
// string(0) ""

var_dump($user->image());
// array(0) { }

var_dump($user->newsletter());
// bool(false)

var_dump($user->greetingSalutation());
// string(5) "greet"

var_dump($user->greeting());
// string(8) "username"
```

## Address

### Create Address

```php
use Tobento\Service\User\Address;
use Tobento\Service\User\AddressInterface;

$address = new Address(key: 'shipping');

var_dump($address instanceof AddressInterface);
// bool(true)
```

### Address Factory

Easily create an address with the provided address factory:

**createAddress**

```php
use Tobento\Service\User\AddressFactory;
use Tobento\Service\User\AddressFactoryInterface;
use Tobento\Service\User\AddressInterface;

$addressFactory = new AddressFactory();

var_dump($addressFactory instanceof AddressFactoryInterface);
// bool(true)

$address = $addressFactory->createAddress(key: 'shipping');

var_dump($address instanceof AddressInterface);
// bool(true)
```

**Parameters:**

```php
use Tobento\Service\User\AddressFactory;

$addressFactory = new AddressFactory();

$address = $addressFactory->createAddress(
    key: 'payment',
    id: 0,
    userId: 0,
    group: '',
    salutation: 'mr',
    name: '',
    firstname: 'Adam',
    lastname: 'Smith',
    company: '',
    address1: 'Musterstrasse',
    address2: '',
    address3: '',
    postcode: '34',
    city: 'Bern',
    state: '',
    countryKey: 'CH',
    country: 'Schweiz',
    email: '',
    telephone: '',
    smartphone: '',
    fax: '',
    website: '',
    locale: 'de',
    birthday: '',
    notice: '',
    info: '',
    selectable: false,
);
```

**createAddressFromArray**

```php
use Tobento\Service\User\AddressFactory;

$addressFactory = new AddressFactory();

$address = $addressFactory->createAddressFromArray([
    'key' => 'payment',
]);
```

### Address Interface

**getters**

```php
use Tobento\Service\User\AddressFactory;
use Tobento\Service\User\AddressInterface;

$addressFactory = new AddressFactory();

$address = $addressFactory->createAddress(key: 'shipping');

var_dump($address instanceof AddressInterface);
// bool(true)

var_dump($address->key());
// string(8) "shipping"

var_dump($address->isPrimary());
// bool(false)

var_dump($address->id());
// int(0)

var_dump($address->userId());
// int(0)

var_dump($address->group());
// string(0) ""

var_dump($address->salutation());
// string(0) ""

var_dump($address->name());
// string(0) ""

var_dump($address->firstname());
// string(0) ""

var_dump($address->lastname());
// string(0) ""

var_dump($address->hasFullname());
// bool(false)

var_dump($address->fullname());
// string(0) ""

var_dump($address->company());
// string(0) ""

var_dump($address->address1());
// string(0) ""

var_dump($address->address2());
// string(0) ""

var_dump($address->address3());
// string(0) ""

var_dump($address->postcode());
// string(0) ""

var_dump($address->city());
// string(0) ""

var_dump($address->state());
// string(0) ""

var_dump($address->hasPostcodeCity());
// bool(false)

var_dump($address->postcodeCity());
// string(0) ""

var_dump($address->countryKey());
// string(0) ""

var_dump($address->country());
// string(0) ""

var_dump($address->hasContact());
// bool(false)

var_dump($address->email());
// string(0) ""

var_dump($address->telephone());
// string(0) ""

var_dump($address->smartphone());
// string(0) ""

var_dump($address->fax());
// string(0) ""

var_dump($address->website());
// string(0) ""

var_dump($address->locale());
// string(0) ""

var_dump($address->birthday());
// string(0) ""

var_dump($address->notice());
// string(0) ""

var_dump($address->info());
// string(0) ""

var_dump($address->selectable());
// bool(false)

var_dump($address->greetingSalutation());
// string(5) "greet"

var_dump($address->greeting());
// string(0) ""
```

**with methods**

The with methods will return a new instance.

```php
use Tobento\Service\User\AddressFactory;

$addressFactory = new AddressFactory();

$address = $addressFactory->createAddress(key: 'shipping');

$address = $address->withGroup('addressbook');

$address = $address->withSalutation('mr');

$address = $address->withName('Name');

$address = $address->withFirstname('John');

$address = $address->withLastname('Smith');

$address = $address->withCompany('Name of Company');

$address = $address->withAddress1('Address Line 1');

$address = $address->withAddress2('Address Line 2');

$address = $address->withAddress3('Address Line 3');

$address = $address->withPostcode('3000');

$address = $address->withCity('Bern');

$address = $address->withState('BE');

$address = $address->withCountryKey('CH');

$address = $address->withCountry('Schweiz');

$address = $address->withEmail('user@example.com');

$address = $address->withTelephone('');

$address = $address->withSmartphone('');

$address = $address->withFax('');

$address = $address->withWebsite('example.com');

$address = $address->withLocale('de-CH');

$address = $address->withBirthday('');

$address = $address->withNotice('Some message');

$address = $address->withInfo('Some message');

$address = $address->withSelectable(false);

$address = $address->withGreeting(
    greeting: 'John Smith',
    salutation: 'mr'
);
```

## Addresses

### Create Addresses

```php
use Tobento\Service\User\Addresses;
use Tobento\Service\User\AddressesInterface;
use Tobento\Service\User\AddressFactoryInterface;
use Tobento\Service\User\AddressInterface;
use Tobento\Service\User\Address;

$addresses = new Addresses(
    null, // addressFactory: null|AddressFactoryInterface
    // addresses: ...AddressInterface
    new Address(key: 'shipping'),
    new Address(key: 'payment'),
);

var_dump($addresses instanceof AddressesInterface);
// bool(true)
```

Check out [Addresses Interface](#addresses-interface) to learn more about the interface.

### Addresses Factory

Easily create an addresses object with the provided addresses factory:

**createAddresses**

```php
use Tobento\Service\User\AddressesFactory;
use Tobento\Service\User\AddressesFactoryInterface;
use Tobento\Service\User\AddressesInterface;
use Tobento\Service\User\AddressFactoryInterface;
use Tobento\Service\User\AddressInterface;
use Tobento\Service\User\Address;

$addressesFactory = new AddressesFactory(
    addressFactory: null, // null|AddressFactoryInterface
);

var_dump($addressesFactory instanceof AddressesFactoryInterface);
// bool(true)

$addresses = $addressesFactory->createAddresses(
    // addresses: ...AddressInterface
    new Address(key: 'shipping'),
);

var_dump($addresses instanceof AddressesInterface);
// bool(true)
```

**createAddressesFromArray**

```php
use Tobento\Service\User\AddressesFactory;
use Tobento\Service\User\Address;

$addresses = (new AddressesFactory())->createAddressesFromArray([
    ['key' => 'payment'],
    new Address(key: 'shipping'),
]);
```

### Addresses Interface

```php
use Tobento\Service\User\AddressesFactory;
use Tobento\Service\User\AddressesInterface;

$addresses = (new AddressesFactory())->createAddresses();

var_dump($addresses instanceof AddressesInterface);
// bool(true)
```

**addressFactory**

```php
use Tobento\Service\User\AddressesFactory;
use Tobento\Service\User\AddressFactoryInterface;

$addresses = (new AddressesFactory())->createAddresses();

var_dump($addresses->addressFactory() instanceof AddressFactoryInterface);
// bool(true)
```

**get**

The get method returns the address by the specified key. If the address does not exist yet, it will create and add it to the addresses.

```php
use Tobento\Service\User\AddressesFactory;
use Tobento\Service\User\AddressInterface;

$addresses = (new AddressesFactory())->createAddresses();

$address = $addresses->get(key: 'payment');

var_dump($address instanceof AddressInterface);
// bool(true)
```

**add**

```php
use Tobento\Service\User\AddressesFactory;

$addresses = (new AddressesFactory())->createAddresses();

$address = $addresses->addressFactory()->createAddress(key: 'payment');

$addresses->add($address);
```

**create**

The create method creates an address with the specified parameters, but does it not add to the addresses.

```php
use Tobento\Service\User\AddressesFactory;
use Tobento\Service\User\AddressInterface;

$addresses = (new AddressesFactory())->createAddresses();

$address = $addresses->create(['key' => 'payment']);

var_dump($address instanceof AddressInterface);
// bool(true)

// you might add it to the addresses
$addresses->add($address);
```

**address**

The address method creates an address and adds it to the addresses.

```php
use Tobento\Service\User\AddressesFactory;
use Tobento\Service\User\AddressInterface;

$addresses = (new AddressesFactory())->createAddresses();

$address = $addresses->address(['key' => 'payment']);

var_dump($address instanceof AddressInterface);
// bool(true)
```

**has**

Check if an address exists.

```php
use Tobento\Service\User\AddressesFactory;

$addresses = (new AddressesFactory())->createAddresses();

var_dump($addresses->has(key: 'payment'));
// bool(false)

$addresses->address(['key' => 'payment', 'firstname' => 'John']);

var_dump($addresses->has(key: 'payment'));
// bool(true)

// you might check for each address parameter
var_dump($addresses->has(
    key: 'payment',
    with: ['firstname', 'lastname'],
));
// bool(false)

var_dump($addresses->has(
    key: 'payment',
    with: ['firstname'],
));
// bool(true)
```

**delete**

```php
use Tobento\Service\User\AddressesFactory;

$addresses = (new AddressesFactory())->createAddresses();

$addresses->delete(key: 'payment');
```

**all**

```php
use Tobento\Service\User\AddressesFactory;
use Tobento\Service\User\AddressInterface;

$addresses = (new AddressesFactory())->createAddresses();

$addresses->address(['key' => 'payment']);

foreach($addresses->all() as $address) {
    var_dump($address instanceof AddressInterface);
    // bool(true)
}

// or just
foreach($addresses as $address) {
    var_dump($address instanceof AddressInterface);
    // bool(true)
}
```

**filter**

You might filter addresses returning a new instance.

```php
use Tobento\Service\User\AddressesFactory;
use Tobento\Service\User\AddressInterface;

$addresses = (new AddressesFactory())->createAddresses();

$addresses = $addresses->filter(
    fn(AddressInterface $a): bool => $a->countryKey() === 'CH'
);
```

**group**

The group method filters addresses by the specified group.

```php
use Tobento\Service\User\AddressesFactory;

$addresses = (new AddressesFactory())->createAddresses();

$addresses = $addresses->group('addressbook');
```

## Addressable

```php
use Tobento\Service\User\User;
use Tobento\Service\User\Addressable;

$user = new User(username: 'username');

var_dump($user instanceof Addressable);
// bool(true)
```

**addresses**

```php
use Tobento\Service\User\User;
use Tobento\Service\User\AddressesInterface;

$user = new User(username: 'username');

var_dump($user->addresses() instanceof AddressesInterface);
// bool(true)
```

Check out the [Addresses Interface](#addresses-interface) to learn more about the interface.

**address**

The address method returns the address if exists or creates a new address for the specified key.

```php
use Tobento\Service\User\User;
use Tobento\Service\User\AddressInterface;

$user = new User(username: 'username');

// returns primary address
var_dump($user->address() instanceof AddressInterface);
// bool(true)

var_dump($user->address(key: 'payment') instanceof AddressInterface);
// bool(true)
```

**hasAddress**

```php
use Tobento\Service\User\User;

$user = new User(username: 'username');

var_dump($user->hasAddress(key: 'payment'));
// bool(false)

// you might check for each address parameter
var_dump($user->hasAddress(
    key: 'payment',
    with: ['firstname', 'lastname'],
));
// bool(false)
```


# Credits

- [Tobias Strub](https://www.tobento.ch)
- [All Contributors](../../contributors)