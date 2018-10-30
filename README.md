# Ark Delegates

Source of [https://delegates.arkx.io](https://delegates.arkx.io).

## Requirements

- A license for https://nova.laravel.com for the administration.

## Development

- https://laravel.com/docs/5.7/homestead
- https://laravel.com/docs/5.7/valet
- https://vessel.shippingdocker.com/

## Deployment

```
php artisan migrate:fresh --seed
php artisan ark:poll:delegates
php artisan ark:poll:voters
php artisan ark:poll:blocks
php artisan ark:poll:supply
php artisan ark:migrate:shares
php artisan ark:cache:stablity
php artisan ark:cache:forging
php artisan ark:cache:calculator
```

## Security

If you discover a security vulnerability within this package, please send an e-mail to hello@brianfaust.me. All security vulnerabilities will be promptly addressed.

## Credits

- [Brian Faust](https://github.com/faustbrian)
- [All Contributors](../../contributors)

## License

[MIT](LICENSE) © [ArkX](https://arkx.io)
