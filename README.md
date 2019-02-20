# yii2-favourite

Favourite component for Yii2.

## Install

The preferred way to install this component is through [composer](https://getcomposer.org/download/).

```
$ composer require bossit/yii2-favourite:^1.0  
```

## Usage

The preferred way is to setup the components into our Application's configuration array:

```php
'components' => [
    'favourite' => [
        'class'    => \bossit\logger\FavouriteService::class,
        'lifetime' => 31536000
    ],
],
```

That's it, you are ready to use it as Yii2 components.