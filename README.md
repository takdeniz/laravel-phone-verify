##Laravel Phone Verify
Verifies phone number via nexmo

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tarfin-labs/netgsm.svg?style=flat-square)](https://packagist.org/packages/takdeniz/laravel-phone-verify)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/tarfin-labs/netgsm/tests?label=tests)
[![Quality Score](https://img.shields.io/scrutinizer/g/tarfin-labs/netgsm.svg?style=flat-square)](https://scrutinizer-ci.com/g/tarfin-labs/netgsm)
[![Total Downloads](https://img.shields.io/packagist/dt/takdeniz/laravel-phone-verify.svg?style=flat-square)](https://packagist.org/packages/tarfin-labs/netgsm)

## Introduction
This package, you can send easily with Laravel 6.x, 7.x.


## Contents

- [Installation](#installation)
   - [Setting up the Netgsm service](#setting-up)
- [Usage](#usage)
    - [Service Methods](#service-methods)
    - [SMS Sending](#sms-sending)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
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



#### Sms Sending with Using Notification Channel

In order to let your Notification know which phone number you are sending to, add the routeNotificationForNetgsm method to your Notifiable model e.g your User Model

``` php
public function routeNotificationForNetgsm()
{
    /*
       where `phone` is a field in your users table, 
       phone number format can be either `5051234567` or `5051234567, 5441234568`.
    */
    return $this->phone;
}
```


## Credits

- [Tuncay Akdeniz](https://github.com/takdeniz)


### License
Laravel Netgsm is open-sourced software licensed under the MIT license.
