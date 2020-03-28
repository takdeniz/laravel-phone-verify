##Laravel Phone Verify
Verifies phone number via nexmo

## Introduction


## Contents

- [Installation](#installation)
   - [Setting up](#setting-up)
- [Usage](#usage)
    - [Service Methods](#service-methods)
    - [SMS Sending](#sms-sending)
- [Testing](#testing)
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
Laravel Phone Verify is open-sourced software licensed under the MIT license.
