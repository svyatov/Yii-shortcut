# Y

Класс-ярлык для часто употребляемых выражений [http://www.yiiframework.com](Yii framework)

## Установка

`git clone git://github.com/Svyatov/Yii-Shortcut.git`


## Использование

### Установка

Положите файл `Y.php` в папку `protected/components` вашего приложения.


### Применение

1) в виджете нам нужно создать урл по роуту

    // стандартная запись
    Yii::app()->controller->createUrl(...);

    // мой класс
    Y::url(...);

2) достаем/устанавлием значение какого-то кэша

    // стандартная запись
    Yii::app()->cache->get(...);
    Yii::app()->cache->set(...);

    // мой класс
    Y::cacheGet(...);
    Y::cacheSet(...);

3) с куками аналогично;

4) достаем значение CSRF токена для вставки в форму или для ajax-запроса

    // стандартная запись
    Yii::app()->request->csrfToken;

    // мой класс
    Y::csrf();

5) надо передать параметр CSRF в ajax-запросе jQuery?

    // стандартная запись
    <script>
    $.post('/bla/bla', {<?=Yii::app()->request->csrfTokenName;?>: '<?=Yii::app()->request->csrfToken;?>', ...} ... );
    </script>

    // мой класс
    <script>
    $.post('/bla/bla', {<?=Y::csrfJsParam();?>, ...} ... );
    </script>

6) быстрый дамп с подсветкой:

    // стандартная запись
    echo '<pre>';
    CVarDumper::dump(...);
    Yii::app()->end();

    // мой класс
    Y::dump(...);

7) выводим результат действия для ajax-запроса

    // стандартная запись
    echo $result;
    Yii::app()->end();
    // или
    echo json_encode($result);
    Yii::app()->end();

    // мой класс
    Y::end($result);
    // или соответственно
    Y::endJson($result);

8) редиректы

    // стандартная запись
    $this->redirect($this->createUrl(...)); // самая короткая запись
    Yii::app()->request->redirect(Yii::app()->controller->createUrl(...)); // а это для компонента, например

    // мой класс
    Y::redir(...); // можно использовать в любом месте одинаково

9) определение статуса текущего юзера (авторизован или нет)

    // стандартная запись
    if (Yii::app()->user->isGuest) ... // если гость
    // или
    if (!Yii::app()->user->isGuest) ... // если авторизован

    // мой класс
    if (Y::isGuest()) ... // гость
    // или
    if (Y::isAuthed()) ... // авторизован
    // можно было обойтись одним методом, но так нагляднее получается код

Как видите количество кода сокращается минимум в 2 раза, что соответственно сокращает минимум в 2 раза время на его написание и отладку.


## Контакты

Проблемы, предложения, пожелания жду сюда: [leonid@svyatov.ru](mailto:leonid@svyatov.ru)