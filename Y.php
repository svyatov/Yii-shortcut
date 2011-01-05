<?php
/**
 * Класс-ярлык для часто употребляемых выражений Yii framework
 *
 * @author Leonid Svyatov <leonid@svyatov.ru>
 * @copyright Copyright (c) 2010-2011, Leonid Svyatov
 * @license http://www.yiiframework.com/license/
 * @version 1.0.4 / 05.01.2011
 */
class Y
{
    /**
     * Возвращает относительный URL приложения
     * @return string
     */
    public static function baseUrl()
    {
        return Yii::app()->baseUrl;
    }

    /**
     * Возвращает ссылку на cache-компонент приложения
     * @return CCache
     */
    public static function cache()
    {
        return Yii::app()->cache;
    }

    /**
     * Удаляет кэш с ключом $id
     * @param string $id имя ключа
     * @return boolean
     */
    public static function cacheDelete($id)
    {
        return Yii::app()->cache->delete($id);
    }

    /**
     * Возвращает значение кэша с ключом $id
     * @param string $id имя ключа
     * @return mixed
     */
    public static function cacheGet($id)
    {
        return Yii::app()->cache->get($id);
    }

    /**
     * Сохраняет значение $value в кэш с ключом $id на время $expire (в секундах)
     * @param string $id имя ключа
     * @param mixed $value значение ключа
     * @param integer $expire время хранения в секундах
     * @param ICacheDependency $dependency
     * @return boolean
     */
    public static function cacheSet($id, $value, $expire = 0, $dependency = null)
    {
        return Yii::app()->cache->set($id, $value, $expire, $dependency);
    }

    /**
     * Удаляет куку
     * @param string $name имя куки
     */
	public static function cookieDelete($name)
	{
	    if (isset(Yii::app()->request->cookies[$name])) {
	        unset(Yii::app()->request->cookies[$name]);
        }
	}

    /**
     * Возвращает значение куки
     * @param string $name имя куки
     * @return string|null
     */
	public static function cookieGet($name)
	{
	    if (isset(Yii::app()->request->cookies[$name])) {
	        return Yii::app()->request->cookies[$name]->value;
        }

        return null;
	}

    /**
     * Устанавливает куку
     * @param string $name имя куки
     * @param string $value значение куки
     * @param integer $expire seconds время хранения (time() + ...) в секундах
     * @param string $path путь на сайте, для которого кука действительна
     * @param string $domain домен, для которого кука действительна
     */
	public static function cookieSet($name, $value, $expire = null, $path = '/', $domain = null)
	{
	    $cookie = new CHttpCookie($name, $value);
	    $cookie->expire = $expire ? $expire : 0;
	    $cookie->path   = $path   ? $path   : '';
	    $cookie->domain = $domain ? $domain : '';
        Yii::app()->request->cookies[$name] = $cookie;
	}

    /**
     * Возвращает значение токена CSRF
     * @return string
     */
    public static function csrf()
    {
        return Yii::app()->request->csrfToken;
    }

    /**
     * Возвращает имя токена CSRF (по умолчанию YII_CSRF_TOKEN)
     * @return string
     */
    public static function csrfName()
    {
        return Yii::app()->request->csrfTokenName;
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
        return Yii::app()->request->csrfTokenName.":'".Yii::app()->request->csrfToken."'";
    }

    /**
     * Ярлык для функции dump класса CVarDumper для отладки приложения
     * @param mixed $var переменная для вывода
     * @param boolean $toDie остановить ли дальнейшее выполнение приложения, по умолчанию - true
     */
    public static function dump($var, $toDie = true)
    {
        echo '<pre>';
        CVarDumper::dump($var, 10, true);
        echo '</pre>';

        if ($toDie) {
            Yii::app()->end();
        }
    }

    /**
     * Выводит текст и завершает приложение (применяется в ajax-действиях)
     * @param string $text текст для вывода
     */
    public static function end($text = '')
    {
        echo $text;
        Yii::app()->end();
    }

    /**
     * Выводит данные в формате JSON и завершает приложение (применяется в ajax-действиях)
     * @param string $data данные для вывода
     */
    public static function endJson($data)
    {
        echo json_encode($data);
        Yii::app()->end();
    }

    /**
     * Устанавливает флэш-извещение для юзера
     * @param string $key ключ извещения
     * @param string $msg сообщение извещения
     */
    public static function flash($key, $msg)
    {
        Yii::app()->user->setFlash($key, $msg);
    }

    /**
     * Устанавливает флэш-извещение для юзера и редиректит по указанному роуту
     * @param string $key ключ извещения
     * @param string $msg сообщение извещения
     * @param string $route маршрут куда редиректить
     * @param array $params дополнительные параметры маршрута
     */
    public static function flashRedir($key, $msg, $route, $params = array())
    {
        Yii::app()->user->setFlash($key, $msg);
        Yii::app()->request->redirect(self::url($route, $params));
    }

    /**
     * Проверка наличия определенной роли у текущего пользователя
     * @param string $roleName имя роли
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
        return !Yii::app()->user->isGuest;
    }
    
    /**
     * Возвращает true, если пользователь гость и неавторизован, иначе - false
     * @return boolean
     */
    public static function isGuest()
    {
        return Yii::app()->user->isGuest;
    }

    /**
     * Возвращает пользовательский параметр приложения с именем $key
     * @param string $key ключ параметра или ключи через точку вложенных параметров
     * 'Media.Foto.thumbsize' преобразуется в ['Media']['Foto']['thumbsize']
     * @return mixed
     */
    public static function param($key)
    {
        if (strpos($key, '.') === false) {
            return Yii::app()->params[$key];
        }

        $keys = explode('.', $key);
        $param = Yii::app()->params[$keys[0]];
        unset($keys[0]);

        foreach ($keys as $k) {
            if (!isset($param[$k])) {
                return null;
            }
            $param = $param[$k];
        }

        return $param;
    }

    /**
     * Редиректит по указанному маршруту
     * @param string $route маршрут
     * @param array $params дополнительные параметры маршрута
     */
    public static function redir($route, $params = array())
    {
        Yii::app()->request->redirect(self::url($route, $params));
    }

    /**
     * Редиректит по указанному роуту, если юзер авторизован
     * @param string $route маршрут
     * @param array $params дополнительные параметры маршрута
     */
    public static function redirAuthed($route, $params = array())
    {
        if (!Yii::app()->user->isGuest) {
            Yii::app()->request->redirect(self::url($route, $params));
        }
    }

    /**
     * Редиректит по указанному роуту, если юзер гость
     * @param string $route маршрут
     * @param array $params дополнительные параметры маршрута
     */
    public static function redirGuest($route, $params = array())
    {
        if (Yii::app()->user->isGuest) {
            Yii::app()->request->redirect(self::url($route, $params));
        }
    }

    /**
     * Возвращает ссылку на request-компонент приложения
     * @return CHttpRequest
     */
    public static function request()
    {
        return Yii::app()->request;
    }

    /**
     * Выводит статистику использованных приложением ресурсов
     * @param boolean $return определяет возвращать результат или сразу выводить
     * @return string
     */
    public static function stats($return = false)
    {
        $stats = '';
        $db_stats = Yii::app()->db->getStats();

        if (is_array($db_stats)) {
            $stats = 'Выполнено запросов: '.$db_stats[0].' (за '.round($db_stats[1], 5).' сек.)<br />';
        }

        $memory = round(Yii::getLogger()->memoryUsage/1024/1024, 3);
        $time = round(Yii::getLogger()->executionTime, 3);

        $stats .= 'Использовано памяти: '.$memory.' Мб<br />';
        $stats .= 'Время выполнения: '.$time.' сек.';

        if ($return) {
            return $stats;
        }

        echo $stats;
    }

    /**
     * Возвращает URL, сформированный на основе указанного маршрута и параметров
     * @param string $route маршрут
     * @param array $params дополнительные параметры маршрута
     * @return string
     */
    public static function url($route, $params = array())
    {
        if (is_object(Yii::app()->controller)) {
            return Yii::app()->controller->createUrl($route, $params);
        }

        return Yii::app()->createUrl($route, $params);
    }

    /**
     * Возвращает ссылку на user-компонент приложения
     * @return CWebUser
     */
    public static function user()
    {
        return Yii::app()->user;
    }

    /**
     * Возвращает Id текущего пользователя
     * @return mixed
     */
    public static function userId()
    {
        return Yii::app()->user->id;
    }
}