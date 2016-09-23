# Laravel Reviewable

## Installation

First, pull in the package through Composer.

```js
composer require tshafer/laravel-reviewable
```

And then include the service provider within `app/config/app.php`.

```php
'providers' => [
    Tshafer\Reviewable\ReviewableServiceProvider::class
];
```

At last you need to publish and run the migration.
```
php artisan vendor:publish --provider="Tshafer\Reviewable\ReviewableServiceProvider" && php artisan migrate
```

-----

### Setup a Model
```php
<?php

namespace App;

use Tshafer\Reviewable\Contracts\Reviewable;
use Tshafer\Reviewable\Traits\Reviewable as ReviewableTrait;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements Reviewable
{
    use ReviewableTrait;
}
```

### Create a review
```php
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
```php
$review = $post->updateReview(1, [
    'title' => 'new title',
    'body' => 'new body',
    'rating' => 3,
]);
```

### Delete a review
```php
$post->deleteReview(1);
```
