# Laravel Reviewable

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

## Install

Via Composer

``` bash
$ composer require draperstudio/laravel-reviewable
```

And then include the service provider within `app/config/app.php`.

``` php
'providers' => [
    DraperStudio\Reviewable\ReviewableServiceProvider::class
];
```

At last you need to publish and run the migration.

```
php artisan vendor:publish --provider="DraperStudio\Reviewable\ReviewableServiceProvider" && php artisan migrate
```

## Usage

### Setup a Model
``` php
<?php

/*
 * This file is part of Laravel Reviewable.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App;

use DraperStudio\Reviewable\Contracts\Reviewable;
use DraperStudio\Reviewable\Traits\Reviewable as ReviewableTrait;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements Reviewable
{
    use ReviewableTrait;
}
```

### Create a review
``` php
$user = User::first();
$post = Post::first();

$review = $post->review([
    'title' => 'Some title',
    'body' => 'Some body',
    'rating' => 5,
], $user);

dd($review);
```

### Update a review
``` php
$review = $post->updateReview(1, [
    'title' => 'new title',
    'body' => 'new body',
    'rating' => 3,
]);
```

### Delete a review
``` php
$post->deleteReview(1);
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email hello@draperstudio.tech instead of using the issue tracker.

## Credits

- [DraperStudio][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/DraperStudio/laravel-reviewable.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/DraperStudio/Laravel-Reviewable/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/DraperStudio/laravel-reviewable.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/DraperStudio/laravel-reviewable.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/DraperStudio/laravel-reviewable.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/DraperStudio/laravel-reviewable
[link-travis]: https://travis-ci.org/DraperStudio/Laravel-Reviewable
[link-scrutinizer]: https://scrutinizer-ci.com/g/DraperStudio/laravel-reviewable/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/DraperStudio/laravel-reviewable
[link-downloads]: https://packagist.org/packages/DraperStudio/laravel-reviewable
[link-author]: https://github.com/DraperStudio
[link-contributors]: ../../contributors
