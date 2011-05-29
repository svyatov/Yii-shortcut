<?php
/**
 * Класс-ярлык для часто употребляемых выражений Yii framework
 *
 * @author Leonid Svyatov <leonid@svyatov.ru>
 * @copyright Copyright (c) 2010-2011, Leonid Svyatov
 * @link http://github.com/Svyatov/Yii-Shortcut
 * @license http://www.yiiframework.com/license/
 * @version 1.1.0 / 29.05.2011
 */
class Y
{
    /**
     * Возвращает относительный URL приложения
     * @param bool $absolute Вернуть ли абсолютный URL, по умолчанию false
     * Этот параметр появился с версии 1.1.0
     * @return string
     */
    public static function baseUrl($absolute = false)
    {
        return Yii::app()->getRequest()->getBaseUrl($absolute);
    }

    /**
     * Возвращает true, если текущее соединение является защищенным (HTTPS), иначе false
     * @return bool
     * @sinse 1.1.0
     */
    public static function isSecureConnection()
    {
        return Yii::app()->getRequest()->getIsSecureConnection();
    }

    /**
     * Возвращает true, если текущий запрос является Ajax запросом, иначе false
     * @return bool
     * @since 1.1.0
     */
    public static function isAjaxRequest()
    {
        return Yii::app()->getRequest()->getIsAjaxRequest();
    }

    /**
     * Возвращает true, если текущий запрос является PUT запросом, иначе false
     * @return bool
     * @since 1.1.0
     */
    public static function isPutRequest()
    {
        return Yii::app()->getRequest()->getIsPutRequest();
    }

    /**
     * Возвращает true, если текущий запрос является DELETE запросом, иначе false
     * @return bool
     * @since 1.1.0
     */
    public static function isDeleteRequest()
    {
        return Yii::app()->getRequest()->getIsDeleteRequest();
    }

    /**
     * Возвращает true, если текущий запрос является POST запросом, иначе false
     * @return bool
     * @since 1.1.0
     */
    public static function isPostRequest()
    {
        return Yii::app()->getRequest()->getIsPostRequest();
    }

    /**
     * Возвращает ссылку на cache-компонент приложения
     * @return ICache
     */
    public static function cache()
    {
        return Yii::app()->getCache();
    }

    /**
     * Удаляет кэш с ключом $id
     * @param string $id Имя ключа
     * @return boolean
     */
    public static function cacheDelete($id)
    {
        return Yii::app()->getCache()->delete($id);
    }

    /**
     * Возвращает значение кэша с ключом $id
     * @param string $id Имя ключа
     * @return mixed
     */
    public static function cacheGet($id)
    {
        return Yii::app()->getCache()->get($id);
    }

    /**
     * Сохраняет значение $value в кэш с ключом $id на время $expire (в секундах)
     * @param string $id Имя ключа
     * @param mixed $value Значение ключа
     * @param integer $expire Время хранения в секундах
     * @param ICacheDependency $dependency Смотреть {@link ICacheDependency}
     * @return boolean
     */
    public static function cacheSet($id, $value, $expire = 0, $dependency = null)
    {
        return Yii::app()->getCache()->set($id, $value, $expire, $dependency);
    }

    /**
     * Удаляет куку
     * @param string $name Имя куки
     */
    public static function cookieDelete($name)
    {
        if (isset(Yii::app()->getRequest()->cookies[$name])) {
            unset(Yii::app()->getRequest()->cookies[$name]);
        }
    }

    /**
     * Возвращает значение куки, если оно есть, иначе значение $default
     * @param string $name Имя куки
     * @param mixed $default Значение, возвращаемое в случае отсутствия куки с заданным именем
     * Этот параметр появился с версии 1.1.0
     * @return mixed
     */
    public static function cookieGet($name, $default = null)
    {
        if (isset(Yii::app()->getRequest()->cookies[$name])) {
            return Yii::app()->getRequest()->cookies[$name]->value;
        }

        return $default;
    }

    /**
     * Устанавливает куку
     * @param string $name Имя куки
     * @param string $value Значение куки
     * @param int $expire Время хранения в секундах
     * @param string $path Путь на сайте, для которого кука действительна
     * @param string $domain Домен, для которого кука действительна
     */
    public static function cookieSet($name, $value, $expire = null, $path = '/', $domain = null)
    {
        $cookie = new CHttpCookie($name, $value);
        $cookie->expire = ($expire ? $expire : 0) + time();
        $cookie->path = $path ? $path : '';
        $cookie->domain = $domain ? $domain : '';
        Yii::app()->getRequest()->cookies[$name] = $cookie;
    }

    /**
     * Возвращает значение токена CSRF
     * @return string
     */
    public static function csrf()
    {
        return Yii::app()->getRequest()->getCsrfToken();
    }

    /**
     * Возвращает имя токена CSRF (по умолчанию YII_CSRF_TOKEN)
     * @return string
     */
    public static function csrfName()
    {
        return Yii::app()->getRequest()->csrfTokenName;
    }

    /**
     * Возвращает готовую строчку для передачи CSRF-параметра в ajax-запросе
     *
     * Пример с использованием jQuery:
     *      $.post('url', { param: 'blabla', <?=Y::csrfJsParam();?> }, ...)
     * будет соответственно заменено на:
     *      $.post('url', { param: 'blabla', [csrfName]: '[csrfToken]' }, ...)
     *
     * @return string
     */
    public static function csrfJsParam()
    {
        return Yii::app()->getRequest()->csrfTokenName . ":'" . Yii::app()->getRequest()->getCsrfToken() . "'";
    }

    /**
     * Ярлык для функции dump класса CVarDumper для отладки приложения
     * @param mixed $var Переменная для вывода
     * @param boolean $doEnd Остановить ли дальнейшее выполнение приложения, по умолчанию - true
     */
    public static function dump($var, $doEnd = true)
    {
        echo '<pre>';
        CVarDumper::dump($var, 10, true);
        echo '</pre>';

        if ($doEnd) {
            Yii::app()->end();
        }
    }

    /**
     * Выводит текст и завершает приложение (применяется в ajax-действиях)
     * @param string $text Текст для вывода
     */
    public static function end($text = '')
    {
        echo $text;
        Yii::app()->end();
    }

    /**
     * Выводит данные в формате JSON и завершает приложение (применяется в ajax-действиях)
     * @param mixed $data Данные для вывода
     */
    public static function endJson($data)
    {
        echo json_encode($data);
        Yii::app()->end();
    }

    /**
     * Устанавливает флэш-извещение для юзера
     * @param string $key Ключ извещения
     * @param string $msg Сообщение извещения
     */
    public static function flash($key, $msg)
    {
        Yii::app()->user->setFlash($key, $msg);
    }

    /**
     * Устанавливает флэш-извещение для юзера и редиректит по указанному маршруту
     * @param string $key Ключ извещения
     * @param string $msg Сообщение извещения
     * @param string $route Маршрут куда редиректить
     * @param array $params Дополнительные параметры маршрута
     */
    public static function flashRedir($key, $msg, $route, $params = array())
    {
        Yii::app()->user->setFlash($key, $msg);
        Yii::app()->getRequest()->redirect(self::url($route, $params));
    }

    /**
     * Проверяет наличие определенной роли у текущего юзера
     * @param string $roleName Имя роли
     * @return boolean
     * @since 1.0.2
     */
    public static function hasAccess($roleName)
    {
        return Yii::app()->user->checkAccess($roleName);
    }

    /**
     * Возвращает true, если пользователь авторизован, иначе - false
     * @return boolean
     */
    public static function isAuthed()
    {
        return !Yii::app()->user->getIsGuest();
    }

    /**
     * Возвращает true, если пользователь гость и неавторизован, иначе - false
     * @return boolean
     */
    public static function isGuest()
    {
        return Yii::app()->user->getIsGuest();
    }

    /**
     * Возвращает пользовательский параметр приложения
     * @param string $key Ключ параметра или ключи вложенных параметров через точку
     * 'Media.Foto.thumbsize' преобразуется в ['Media']['Foto']['thumbsize']
     * @param mixed $default Значение, возвращаемое в случае отсутствия параметра
     * @return mixed
     */
    public static function param($key, $default = null)
    {
        $params = Yii::app()->getParams();

        if (strpos($key, '.') === false) {
            return ($params->contains($key)) ? $params->itemAt($key) : $default;
        }

        $keys = explode('.', $key);

        if (!$params->contains($keys[0])) {
            return $default;
        }

        $param = $params->itemAt($keys[0]);
        unset($keys[0]);

        foreach ($keys as $k) {
            if (!isset($param[$k]) && !array_key_exists($k, $param)) {
                return $default;
            }
            $param = $param[$k];
        }

        return $param;
    }

    /**
     * Редиректит по указанному маршруту
     * @param string $route Маршрут
     * @param array $params Дополнительные параметры маршрута
     */
    public static function redir($route, $params = array())
    {
        Yii::app()->getRequest()->redirect(self::url($route, $params));
    }

    /**
     * Редиректит по указанному роуту, если юзер авторизован
     * @param string $route Маршрут
     * @param array $params Дополнительные параметры маршрута
     */
    public static function redirAuthed($route, $params = array())
    {
        if (!Yii::app()->user->getIsGuest()) {
            Yii::app()->getRequest()->redirect(self::url($route, $params));
        }
    }

    /**
     * Редиректит по указанному роуту, если юзер гость
     * @param string $route Маршрут
     * @param array $params Дополнительные параметры маршрута
     */
    public static function redirGuest($route, $params = array())
    {
        if (Yii::app()->user->getIsGuest()) {
            Yii::app()->getRequest()->redirect(self::url($route, $params));
        }
    }

    /**
     * Возвращает ссылку на request-компонент приложения
     * @return CHttpRequest
     */
    public static function request()
    {
        return Yii::app()->getRequest();
    }

    /**
     * Выводит статистику использованных приложением ресурсов
     * @param boolean $return Определяет возвращать результат или сразу выводить
     * @return string
     */
    public static function stats($return = false)
    {
        $stats = '';
        $dbStats = Yii::app()->getDb()->getStats();

        if (is_array($dbStats)) {
            $stats = 'Выполнено запросов: ' . $dbStats[0] . ' (за ' . round($dbStats[1], 5) . ' сек.)<br />';
        }

        $memory = round(Yii::getLogger()->getMemoryUsage() / 1048576, 3);
        $time = round(Yii::getLogger()->getExecutionTime(), 3);

        $stats .= 'Использовано памяти: ' . $memory . ' Мб<br />';
        $stats .= 'Время выполнения: ' . $time . ' сек.';

        if ($return) {
            return $stats;
        }

        echo $stats;
    }

    /**
     * Возвращает URL, сформированный на основе указанного маршрута и параметров
     * @param string $route Маршрут
     * @param array $params Дополнительные параметры маршрута
     * @return string
     */
    public static function url($route, $params = array())
    {
        if (is_object($controller = Yii::app()->getController())) {
            return $controller->createUrl($route, $params);
        }

        return Yii::app()->createUrl($route, $params);
    }

    /**
     * Возвращает ссылку на user-компонент приложения
     * @return IWebUser
     */
    public static function user()
    {
        return Yii::app()->user;
    }

    /**
     * Возвращает Id текущего юзера
     * @return mixed
     */
    public static function userId()
    {
        return Yii::app()->user->getId();
    }
}