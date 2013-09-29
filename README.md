# Y

Shortcuts for [Yii framework](http://www.yiiframework.com)


## Install

Install it via [Composer](http://getcomposer.org).

Or get the [latest release](https://github.com/svyatov/Yii-shortcut/releases) and put `Y.php` file in your application `protected/components` folder.


## Usage

1) creating URL by route in a widget

```php
<?php
// Standart code
Yii::app()->controller->createUrl('user/login');

// Y code
Y::url('user/login');
```

2) Get/set some cache value

```php
<?php
// Standart code
Yii::app()->cache->get('user_settings');
Yii::app()->cache->set('user_settings', $userSettings);

// Y code
Y::cacheGet('user_settings');
Y::cacheSet('user_settings', $userSettings);
```

3) the same with cookies;

4) getting the value of CSRF token

```php
<?php
// Standart code
Yii::app()->request->csrfToken;

// Y code
Y::csrf();
```

5) inserting CSRF name and token in some jQuery request

```phtml
// Standart code
<script>
$.post('/user/login', {<?=Yii::app()->request->csrfTokenName;?>: '<?=Yii::app()->request->csrfToken;?>', ...} ...);
</script>

// Y code
<script>
$.post('/user/login', {<?=Y::csrfJsParam();?>, ...} ...);
</script>
```

6) quick variable dump with code highlighting

```php
<?php
// Standart code
echo '<pre>';
CVarDumper::dump($testVariable, 10, true);
Yii::app()->end();

// Y code
Y::dump($testVariable);
```

7) short action ending without template rendering (e.g. for AJAX requests)

```php
<?php
// Standart code
echo $result;
Yii::app()->end();
// or
echo json_encode($result);
Yii::app()->end();

// Y code
Y::end($result);
// or
Y::endJson($result);
```

8) redirects

```php
<?php
// Standart code
$this->redirect($this->createUrl('user/settings')); // the shortest example
Yii::app()->request->redirect(Yii::app()->controller->createUrl('user/settings')); // if we inside some widget

// Y code
Y::redir('user/settings'); // you can use wherever you want, controller/widget, it doesn't matter
```

9) detecting current user status (is he a guest or he is authenticated)

```php
<?php
// Standart code
if (Yii::app()->user->isGuest) {} // is user a guest?
// or
if (!Yii::app()->user->isGuest) {} // is user authenticated?

// Y code
if (Y::isGuest()) {} // is user a guest?
// or
if (Y::isAuthed()) {} // is user authenticated?
// the code speaks for himself, it's more expressive and more readable
```

As you can see, the amount of code becomes at least 2 times smaller. So you need to type 2 times less and you can read and understand it 2 times faster.


## Changelog

* **v1.3.1** / 28.09.2013

    `fix` Fixed urls to repo. No code changes.

* **v1.3.0** / 12.07.2013

    `new` Everything is translated to English.

    `new` Added LICENSE file.

    `chg` Updated composer.json file.

    `chg` Added second argument $options to cookieDelete() method.

    `chg` Added $secure and $httpOnly arguments to cookieSet() method. Besides, $value argument could be an instance of CHttpCookie class now.

    `chg` CSRF token name in method csrfJsParam() now quoted.

    `chg` Default $message argument value in flash() method changed to 'false' so now there is a way to remove flash message by passing 'null' as $message argument.

    `chg` Added $params and $allowCaching arguments to hasAccess() method. It doesn't change previous behaviour but extending method abilities.

    `chg` Code refactoring.

* **v1.2.1** / 25.01.2012

    `new` Added method getFile().

* **v1.2.0** / 20.10.2011

    `new` Added methods: format, script, session, sessionGet, sessionSet, sessionDelete.

    `new` Added internal caching of application components.

    `chg` cookieDelete() method now returns the object of removed cookie (like the original method).

* **v1.1.5** / 29.09.2011

    `new` Added method dbCmd().

    `fix` Fixed errors in @since phpDoc tags.

* **v1.1.4** / 27.09.2011

    `fix` Fixed bug in cookieSet() method, which prevents setting cookie if there was no $expire argument.

    `chg` Cookie methods now use native methods of the CCookieCollection class.

* **v1.1.3** / 19.07.2011

    `new` Added methods: getGet, getPost, getRequest, getPdo, hasFlash.

    `chg` cache(), cacheDelete(), cacheGet(), cacheSet() methods now have $cacheId argument, which gives the ability to select different cache backends.

    `chg` Added $options argument to endJson() method, which gives the ability to pass options to native json_encode() function.

    `chg` More "magic" removed. Code refactoring.

* **v1.1.0** / 29.05.2011

    `new` Added methods: isAjaxRequest, isPutRequest, isDeleteRequest, isPostRequest, isSecureConnection.

    `new` Added changelog to README. README.markdown renamed to README.md

    `chg` Removed almost every "magic" inside methods.

    `chg` Added $absolute argument to baseUrl() method, which gives the ability to get absolute URL instead of relative one.

    `chg` Added $default argument to cookieGet() method, which gives the ability to return value of $default variable if cookie with specified name doesn't exist.

    `chg` Added $default argument to param() method, which gives the ability to return value of $default variable if parameter with specified name doesn't exist. Also, method code refactored.

    `chg` Fixed and enhanced phpDoc comments.

* **v1.0.4** / 05.01.2011

    `chg` Code refactoring. Class uploaded to GitHub.

* **v1.0.3** / 16.12.2010

    `fix` Fixed bug in param() method.

* **v1.0.2** / 16.12.2010

    `new` Added method hasAccess().

    `new` Enhanced method param(). Now key could contain dot delimited string to access nested variables. For example: 'site.title' returns value at param['site']['title']. Thanks for idea to sergebezborodov.

    `chg` Code refactoring.
