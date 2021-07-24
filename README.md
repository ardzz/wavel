# Whatsapp Laravel
![](https://raw.githubusercontent.com/ardzz/wavel/master/images/wavel_header.png)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/ardzz/wavel.svg?style=flat-square)](https://packagist.org/packages/ardzz/wavel)
[![Total Downloads](https://img.shields.io/packagist/dt/ardzz/wavel.svg?style=flat-square)](https://packagist.org/packages/ardzz/wavel)
[![Average time to resolve an issue](http://isitmaintained.com/badge/resolution/ardzz/wavel.svg)](http://isitmaintained.com/project/ardzz/wavel "Average time to resolve an issue")
[![Percentage of issues still open](http://isitmaintained.com/badge/open/ardzz/wavel.svg)](http://isitmaintained.com/project/ardzz/wavel "Percentage of issues still open")

An elegant package to integrate Laravel with [Whatsapp automate](https://github.com/open-wa/wa-automate-nodejs)

## Installation

You can install the package via composer:

```bash
composer require ardzz/wavel
```

## Push Vendor
```bash
php artisan vendor:publish --provider="Ardzz\\Wavel\\WavelServiceProvider"
```
## Configuration
```dotenv
# Host of openwa easy api
WAVEL_HOST=
# Api key if needed
WAVEL_API_KEY=
# Proxy client
WAVEL_PROXY=
```

## Usage
Outside laravel (standalone)
```php
$wavel = new \Ardzz\Wavel\WavelFactory('127.0.0.1:9090', 'VerY_S3creT');

$sendMessage = $wavel->text()->message('This message sent by using wavel', '6288888888');
var_dump($sendMessage->isSuccess());
```
Inside laravel (facade)
```php
$wavel = \Ardzz\Wavel\Wavel::text()->message('This message sent by using wavel', '6288888888');
dd($wavel);
```

### [More usage](https://wavel.ardzz.codes/)

### Testing

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email ardzz@indoxploit.or.id instead of using the issue tracker.

## Credits

-   [Naufal Reky Ardhana](https://github.com/ardzz)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
