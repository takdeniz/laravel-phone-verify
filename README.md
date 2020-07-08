##Laravel Phone Verify
Verifies phone number via Nexmo and Netgsm
 
## Introduction
It sends verification notifications, it has a controller to verify the phone number 

## Contents

- [Installation](#installation)
   - [Configure](#configure)
- [Credits](#credits)
- [License](#license)


## Installation

You can install the package via composer:

```bash
composer require takdeniz/laravel-phone-verify
```

Publish configurations and migrations, then migrate comments table.

```
php artisan vendor:publish --provider="Takdeniz\PhoneVerify\VerifyPhoneServiceProvider"
```


#### configure

``` php
class User implements MustVerifyPhoneContract {
    use MustVerifyPhone;
    ...
}
```


## Credits

- [Tuncay Akdeniz](https://github.com/takdeniz)


### License
Laravel Phone Verify is open-sourced software licensed under the MIT license.
