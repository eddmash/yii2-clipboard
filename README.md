yii2-clipboard
=================================

A Yii2 extension that makes it easy to copy input item value on to clipboard.


## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

> Read this [web tip /wiki](http://webtips.krajee.com/setting-composer-minimum-stability-application/) on setting
the `minimum-stability` settings for your application's composer.json.

Either run

```
$ php composer.phar require eddmash/yii2-clipboard "@dev"
```

or add

```
"eddmash/yii2-clipboard": "@dev"
```

to the ```require``` section of your `composer.json` file.


## Usage

You can use the widget which create a input that has copy button.

```php 

    echo \Eddmash\Clipboard\Clipboard::widget([
        'model' => $model,
        'attribute' => 'email',
        'options'=>['readonly'=>""]
    ]); 

```
Or if you need to use it without a model. 
The `Clipboard::input()` method is works like `HTML::tag()` actually its use it to create its output.
The only difference is that it takes the first argument as the view object on which the output is being done.

```php 
    
    $url = "https://packagist.org/packages/eddmash/yii2-clipboard";
    Clipboard::input($this, 'text', 'url', $url, ['id' => 'url', 'readonly' => true])

```

Or if simply need the composer.js loaded on a view

```php 
    \Eddmash\Clipboard\ClipboardAsset::register($this)
```

Learn more [yii2-clipboard documentation](https://eddmash.github.io/yii2-clipboard/docs/v1_0_0/classes/Eddmash.Clipboard.Clipboard.html)

