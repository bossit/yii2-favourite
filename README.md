# yii2-favourite

Favourite component for Yii2.

[![Latest Stable Version](https://poser.pugx.org/bossit/yii2-favourite/v/stable)](https://packagist.org/packages/bossit/yii2-favourite)
[![Build Status](https://travis-ci.org/bossit/yii2-favourite.svg?branch=master)](https://travis-ci.org/bossit/yii2-favourite)
[![Total Downloads](https://poser.pugx.org/bossit/yii2-favourite/downloads)](https://packagist.org/packages/bossit/yii2-favourite)

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
        'lifetime' => 31536000,
        'cookieName' => 'favourite'
    ],
],
```

That's it, you are ready to use it as Yii2 components.


##### Examples:
```php
// add to favourite
\Yii::$app->favourite->add($productId);

// remove from favourite
\Yii::$app->favourite->remove($productId);

// get items of favourite
\Yii::$app->favourite->getItems();
```