# nova-queues

Queue resource for Laravel Nova.

## Installation

Install package with Composer.

```sh
composer require den1n/nova-queues
```

Publish package resources.

```sh
php artisan vendor:publish --provider=Den1n\NovaQueues\ServiceProvider
```

This will publish the following resources:

* Configuration file `config/nova-queues.php`.
* Translations `resources/lang/vendor/nova-queues`.
* Views `resources/views/vendor/nova-queues`.

Create database queue table if it's not exists.

```sh
php artisan queue:table
```

Migrate database.

```sh
php artisan migrate
```

Add instance of class `Den1n\NovaQueues\Tool` to your `App\Providers\NovaServiceProvider::tools()` method to display the jobs within your Nova resources.

```php
/**
 * Get the tools that should be listed in the Nova sidebar.
 *
 * @return array
 */
public function tools()
{
    return [
        new \Den1n\NovaQueues\Tool,
    ];
}
```

## Screenshots

### Jobs

![Jobs](https://raw.githubusercontent.com/den1n/nova-queues/master/screens/jobs.png)

### Job Details

![Job Details](https://raw.githubusercontent.com/den1n/nova-queues/master/screens/job-details.png)

## Contributing

1. Fork it.
2. Create your feature branch: `git checkout -b my-new-feature`.
3. Commit your changes: `git commit -am 'Add some feature'`.
4. Push to the branch: `git push origin my-new-feature`.
5. Submit a pull request.

## Support

If you require any support open an issue on this repository.

## License

MIT
