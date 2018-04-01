<?php

namespace poster\src;


class DashAPI
{
    private $api;

    public function __construct(PosterApiCore $params)
    {
        $this->api = $params;
    }

    /**
     * dash.getAnalytics: Статистика по продажам
     * @link http://api.joinposter.com/#dash-getanalytics
     *
     * @param array $params [
     * @var mixed $dateFrom Опциональный параметр, дата начала периода в формате `Ymd`. Если не указана, будут выданы все продажи за последние 30 дней от `dateTo`.
     * @var mixed $dateTo Опциональный параметр, дата конца периода в формате `Ymd`. По умолчанию текущая дата.
     * @var mixed $interpolate Опциональный параметр, вывод по: дням — day, неделям — week, месяцам — month. По умолчанию `day`.
     * @var mixed $select Опциональный параметр, тип выборки: оборот — `revenue`, прибыть — `profit`, средний чек — `average_receipt`, кол-во чеков — `transactions`, кол-во клиентов — `visitors`, среднее время — `average_time`. По умолчанию `revenue`.
     * @var mixed $type Опциональный параметр, тип статистики: по официанту — waiters, цеху — workshop, категории — category, товару — products, заведению — spots, клиенту — clients. По умолчанию все.
     * @var mixed $id Опциональный параметр, Id сущности по которой вернется выборка, например: id официанта, цеха, категории, товара, заведения, клиенту. По умолчанию — все.
     * @var mixed $business_day Если `true` то статистика продаж будет возвращаться по тому бизнес дню, в который попадает `dateFrom` время. По умолчанию `false`.
     * ]
     *
     * @return object $response — response from API
     */
    public function getAnalytics($params = array())
    {
        return $this->api->makeApiRequest('dash.getAnalytics', 'get', $params);
    }

    /**
     * dash.getTransaction: Получение транзакций
     * @link http://api.joinposter.com/#dash-gettransaction
     *
     * @param array $params [
     * @var mixed $transaction_id Обязательный параметр, номер чека по которому возвращать информацию
     * @var mixed $include_products Признак включать товары в транзакциях в ответ, `true` — включать, `false` — нет
     * @var mixed $include_history Признак включить историю транзакции в ответ, `true` — включать, `false` — нет
     * @var mixed $timezone Опциональный параметры, если равен `client` то дата возвращается в часовом поясе аккаунта.
     * @var mixed $type Тип статистики: `waiters` — по официанту, `spots` — заведению, `clients` — клиенту. При использовании обязательно указать `id`.
     * @var mixed $id Id сущности по которой получать статистику, если не указано будут выданы транзакции по всем типам статистики. При использовании обязательно указать `type`.
     * @var mixed $status Статус транзакции: 0 — все транзакции, 1 — только открытые, 2 — только закрытые, 3 — удаленные
     * ]
     *
     * @return object $response — response from API
     */
    public function getTransaction($params = array())
    {
        return $this->api->makeApiRequest('dash.getTransaction', 'get', $params);
    }

    /**
     * dash.getTransactions: Список транзакций
     * @link http://api.joinposter.com/#dash-gettransactions
     *
     * @param array $params [
     * @var mixed $dateFrom Опциональный параметр, дата начала выборки в формате `Ymd`, включительно. По умолчанию дата месяц назад.
     * @var mixed $dateTo Опциональный параметр, дата конца выборки в формате `Ymd`, включительно. По умолчанию дата текущего дня.
     * @var mixed $type Тип статистики: `waiters` — по официанту, `spots` — заведению, `clients` — клиенту. При использовании обязательно указать `id`.
     * @var mixed $id Id сущности по которой получать статистику, если не указано будут выданы транзакции по всем типам статистики. При использовании обязательно указать `type`.
     * @var mixed $status Статус транзакции: 0 — все транзакции, 1 — только открытые, 2 — только закрытые, 3 — удаленные
     * @var mixed $include_products Признак включать товары в транзакциях в ответ, `true` — включать, `false` — нет
     * @var mixed $include_history Признак включить историю транзакции в ответ, `true` — включать, `false` — нет
     * @var mixed $next_tr id транзакции после которой нужно получить список транзакций
     * @var mixed $after_date_close Транзакции после даты закрытия в формате unixtimestamp
     * @var mixed $before_date_close Транзакции до даты закрытия в формате unixtimestamp
     * @var mixed $timezone Опциональный параметры, если равен `client` то дата возвращается в часовом поясе аккаунта.
     * ]
     *
     * @return object $response — response from API
     */
    public function getTransactions($params = array())
    {
        return $this->api->makeApiRequest('dash.getTransactions', 'get', $params);
    }

    /**
     * dash.getTransactionProducts: Список продуктов по транзакции
     * @link http://api.joinposter.com/#dash-gettransactionproducts
     *
     * @param array $params [
     * @var mixed $transaction_id Обязательный параметр, id транзакции (номер чека)
     * ]
     *
     * @return object $response — response from API
     */
    public function getTransactionProducts($params = array())
    {
        return $this->api->makeApiRequest('dash.getTransactionProducts', 'get', $params);
    }

    /**
     * dash.getTransactionHistory: История транзакции
     * @link http://api.joinposter.com/#dash-gettransactionhistory
     *
     * @param array $params [
     * @var mixed $transaction_id Обязательный параметр, id транзакции (номер чека)
     * ]
     *
     * @return object $response — response from API
     */
    public function getTransactionHistory($params = array())
    {
        return $this->api->makeApiRequest('dash.getTransactionHistory', 'get', $params);
    }

    /**
     * dash.getProductsSales: Продажи по товарам
     * @link http://api.joinposter.com/#dash-getproductssales
     *
     * @param array $params [
     * @var mixed $spot_id Опциональный параметр, Id заведения по которому возвращать статистику
     * @var mixed $date_from Опциональный параметр, дата начала выборки в формате `Ymd`, включительно. По умолчанию дата месяц назад.
     * @var mixed $date_to Опциональный параметр, дата конца выборки в формате `Ymd`, включительно. По умолчанию дата текущего дня.
     * ]
     *
     * @return object $response — response from API
     */
    public function getProductsSales($params = array())
    {
        return $this->api->makeApiRequest('dash.getProductsSales', 'get', $params);
    }

    /**
     * dash.getCategoriesSales: Продажи по категориям
     * @link http://api.joinposter.com/#dash-getcategoriessales
     *
     * @param array $params [
     * @var mixed $dateFrom Дата начала для выборки в формате `Ymd`. Если не указана, начальная дата считается на месяц позже.
     * @var mixed $dateTo Дата конца для выборки в формате `Ymd`. Если не указана, конечная дата считается текущей.
     * @var mixed $spot_id id заведения, если не указана, будут выданы по всем заведениям
     * ]
     *
     * @return object $response — response from API
     */
    public function getCategoriesSales($params = array())
    {
        return $this->api->makeApiRequest('dash.getCategoriesSales', 'get', $params);
    }

    /**
     * dash.getClientsSales: Продажи по клиентам
     * @link http://api.joinposter.com/#dash-getclientssales
     *
     * @param array $params [
     * @var mixed $dateFrom Дата начала для выборки в формате `Ymd`. Если не указана, начальная дата считается на месяц позже.
     * @var mixed $dateTo Дата конца для выборки в формате `Ymd`. Если не указана, конечная дата считается текущей.
     * @var mixed $interpolate Вывод по часам, дням, неделям, месяцам. Если не указана, по дням
     * ]
     *
     * @return object $response — response from API
     */
    public function getClientsSales($params = array())
    {
        return $this->api->makeApiRequest('dash.getClientsSales', 'get', $params);
    }

    /**
     * dash.getWaitersSales: Продажи по официантам
     * @link http://api.joinposter.com/#dash-getwaiterssales
     *
     * @param array $params [
     * @var mixed $dateFrom Опциональный параметр, дата начала выборки в формате `Ymd`, включает указанный день. По умолчанию дата месяц назад.
     * @var mixed $dateTo Опциональный параметр, дата конца выборки в формате `Ymd`, включает указанный день. По умолчанию дата текущего дня.
     * ]
     *
     * @return object $response — response from API
     */
    public function getWaitersSales($params = array())
    {
        return $this->api->makeApiRequest('dash.getWaitersSales', 'get', $params);
    }

    /**
     * dash.getSpotsSales: Продажи по заведениям
     * @link http://api.joinposter.com/#dash-getspotssales
     *
     * @param array $params [
     * @var mixed $dateFrom Опциональный параметр, дата начала выборки в формате `Ymd`, включительно. По умолчанию дата месяц назад.
     * @var mixed $dateTo Опциональный параметр, дата конца выборки в формате `Ymd`, включительно. По умолчанию дата текущего дня.
     * @var mixed $spot_id Опциональный параметр, id заведения по которому возвращать статистику. Если не указан, будут выданы по всем заведениям.
     * ]
     *
     * @return object $response — response from API
     */
    public function getSpotsSales($params = array())
    {
        return $this->api->makeApiRequest('dash.getSpotsSales', 'get', $params);
    }

    /**
     * dash.getTransactionWriteOffs: Списания по чеку
     * @link http://api.joinposter.com/#dash-gettransactionwriteoffs
     *
     * @param array $params [
     * @var mixed $transaction_id Обязательный параметр, id транзакции (номер чека)
     * ]
     *
     * @return object $response — response from API
     */
    public function getTransactionWriteOffs($params = array())
    {
        return $this->api->makeApiRequest('dash.getTransactionWriteOffs', 'get', $params);
    }

    /**
     * dash.getPaymentsReport: Статистика оплат по дням/месяцам
     * @link http://api.joinposter.com/#dash-getpaymentsreport
     *
     * @param array $params [
     * @var mixed $spot_id Опциональный параметр, Id заведения по которому возвращать статистику
     * @var mixed $date_from Опциональный параметр, дата начала выборки в формате `Ymd`, включительно. По умолчанию дата месяц назад.
     * @var mixed $date_to Опциональный параметр, дата конца выборки в формате `Ymd`, включительно. По умолчанию дата текущего дня.
     * ]
     *
     * @return object $response — response from API
     */
    public function getPaymentsReport($params = array())
    {
        return $this->api->makeApiRequest('dash.getPaymentsReport', 'get', $params);
    }

}


class MenuAPI
{
    private $api;

    public function __construct(PosterApiCore $params)
    {
        $this->api = $params;
    }

    /**
     * menu.getCategories: Список категорий товаров
     * @link http://api.joinposter.com/#menu-getcategories
     *
     * @param array $params [
     * @var mixed $fiscal Фискальный признак категорий: 0 — не фискальные, 1 — фискальные. По умолчанию — все категории.
     * @var mixed $id_1c Позволяет вернуть в ответе id категории товаров в системе 1С. В качестве значения необходимо передать true. По умолчанию не передаётся.
     * ]
     *
     * @return object $response — response from API
     */
    public function getCategories($params = array())
    {
        return $this->api->makeApiRequest('menu.getCategories', 'get', $params);
    }

    /**
     * menu.getCategory: Свойства категории товаров
     * @link http://api.joinposter.com/#menu-getcategory
     *
     * @param array $params [
     * @var mixed $category_id Id категории
     * @var mixed $1c    Позволяет вернуть в ответе id категории товаров в системе 1С. В качестве значения необходимо передать true. По умолчанию не передаётся.
     * ]
     *
     * @return object $response — response from API
     */
    public function getCategory($params = array())
    {
        return $this->api->makeApiRequest('menu.getCategory', 'get', $params);
    }

    /**
     * menu.createCategory: Создание категории товаров
     * @link http://api.joinposter.com/#menu-createcategory
     *
     * @param array $params [
     * @var mixed $category_name Название категории товаров
     * @var mixed $parent_category Id родительской категории
     * @var mixed $category_color Цвет категории: white, red, orange, yellow, green, blue, navy-blue, purple, black, mint-blue, lime-green, pink. По умолчанию принимает white.
     * @var mixed $category_hidden Признак, что категория скрыта: 0 — не скрыта, 1 — скрыта. По умолчанию принимает 0.
     * @var mixed $tax_id Id налога. По умолчанию принимает 0.
     * ]
     *
     * @return object $response — response from API
     */
    public function createCategory($params = array())
    {
        return $this->api->makeApiRequest('menu.createCategory', 'post', $params);
    }

    /**
     * menu.updateCategory: Изменение свойств категории товаров
     * @link http://api.joinposter.com/#menu-updatecategory
     *
     * @param array $params [
     * @var mixed $category_id Id категории товаров
     * @var mixed $category_name Название категории товаров
     * @var mixed $parent_category Id родительской категории
     * @var mixed $category_color Цвет категории: white, red, orange, yellow, green, blue, navy-blue, purple, black, mint-blue, lime-green, pink. По умолчанию не передаётся.
     * @var mixed $category_hidden Признак, что категория скрыта: 0 — не скрыта, 1 — скрыта. По умолчанию не передаётся.
     * @var mixed $tax_id Id налога. По умолчанию не передаётся.
     * ]
     *
     * @return object $response — response from API
     */
    public function updateCategory($params = array())
    {
        return $this->api->makeApiRequest('menu.updateCategory', 'post', $params);
    }

    /**
     * menu.set1cCategoryId: Изменение id категории товаров в системе 1С
     * @link http://api.joinposter.com/#menu-set1ccategoryid
     *
     * @param array $params [
     * @var mixed $id Массив объектов
     * @var mixed $category_id Id категории товаров
     * @var mixed $id_1c Id категории товаров в системе 1С
     * ]
     *
     * @return object $response — response from API
     */
    public function set1cCategoryId($params = array())
    {
        return $this->api->makeApiRequest('menu.set1cCategoryId', 'post', $params);
    }

    /**
     * menu.removeCategory: Удаление категории товаров
     * @link http://api.joinposter.com/#menu-removecategory
     *
     * @param array $params [
     * @var mixed $category_id Id категории товаров
     * ]
     *
     * @return object $response — response from API
     */
    public function removeCategory($params = array())
    {
        return $this->api->makeApiRequest('menu.removeCategory', 'post', $params);
    }

    /**
     * menu.getProducts: Список товаров и тех. карт
     * @link http://api.joinposter.com/#menu-getproducts
     *
     * @param array $params [
     * @var mixed $category_id Id категории товаров. По умолчанию не передаётся.
     * @var mixed $type Тип: products — товары, batchtickets — тех. карты. По умолчанию не передаётся.
     * ]
     *
     * @return object $response — response from API
     */
    public function getProducts($params = array())
    {
        return $this->api->makeApiRequest('menu.getProducts', 'get', $params);
    }

    /**
     * menu.getProduct: Свойства товара или тех. карты
     * @link http://api.joinposter.com/#menu-getproduct
     *
     * @param array $params [
     * @var mixed $product_id Id товара или тех. карты
     * ]
     *
     * @return object $response — response from API
     */
    public function getProduct($params = array())
    {
        return $this->api->makeApiRequest('menu.getProduct', 'get', $params);
    }

    /**
     * menu.createProduct: Создание товара
     * @link http://api.joinposter.com/#menu-createproduct
     *
     * @param array $params [
     * @var mixed $product_name Название товара
     * @var mixed $menu_category_id Id категории меню. Если передать 0, то товар попадет на «Главный экран».
     * @var mixed $workshop Id цеха. Обязательное поле для аккаунтов типа «кафе».
     * @var mixed $weight_flag Признак, что товар штучный или весовой: 0 — штучный, 1 — весовой
     * @var mixed $color Цвет карточки товара: white, red, orange, yellow, green, blue, navy-blue, purple, black, mint-blue, lime-green, pink. По умолчанию принимает white.
     * @var mixed $different_spots_prices Признак, что у товара разные цены в разных заведениях: 0 — одинаковые цены, 1 — разные цены
     * @var mixed $modifications Признак, что товар с модификаторами: 0 — без модификаторов, 1 — с модификаторами
     * @var mixed $modificator_name Название модиикатора. Является обязательным, если в параметре modifications передана 1. Все имена передаются с указанием индекса модификатора в квадратных скобках: modificator_name[0], modificator_name[1] и так далее.
     * @var mixed $barcode Штрихововй код товара. Позволяет использовать сканер штрих-кодов во время продажи товаров. Для штучных товаров рекомендуется использовать 13-значный код, для весовых товаров рекомендуется использовать 7-значный код. Если товар без модификаторов, то параметр передается как barcode, если с модификаторами, то с указанием индекса модификатора в квадратных скобках: barcode[0], barcode[1] и так далее.
     * @var mixed $product_code Артикул товара. Указывается только для аккаунтов типа «магазин». Если товар без модификаторов, то параметр передается как product_code, если с модификаторами, то с указанием индекса модификатора в квадратных скобках: product_code[0], product_code[1] и так далее.
     * @var mixed $cost Первичная себестоимость товара в копейках, которая будет использоваться до первой поставки товара. Если товар без модификаторов, то параметр передается как cost, если с модификаторами, то с указанием индекса модификации в квадратных скобках: cost[0], cost[1] и так далее.
     * @var mixed $price Стоимость товара в копейках. Если товар без модификаторов, то параметр передаётся как price, если с модификаторами, то с указанием индекса модификаторов в квадратных скобках: price[0], price[1] и так далее. Кроме того, если включается свойство «разные цены в разных заведениях», то добавляется ещё один уровень массива, где будут указываться id заведений. То есть, price[1], price[2] и так далее — без модификаторов, и price[0][1], price[1][2] — с модификаторами (в качестве индекса сначала индекс модификации, а потом id заведения).
     * @var mixed $visible Признак, что товар виден на терминале в этом заведении: 0 — не виден, 1 — виден. Используется только при включенном свойстве «разные цены в разных заведениях». Структуру передачи данных идентична параметру price. То есть, visible[1], visible[2] и так далее — без модификаторов (id заведения в качестве индекса), и visible[0][1], visible[1][2] — с модификациями (в качестве индекса сначала индекс модификации, а потом id заведения).
     * ]
     *
     * @return object $response — response from API
     */
    public function createProduct($params = array())
    {
        return $this->api->makeApiRequest('menu.createProduct', 'post', $params);
    }

    /**
     * menu.updateProduct: Изменение свойств товара
     * @link http://api.joinposter.com/#menu-updateproduct
     *
     * @param array $params [
     * @var mixed $id Id товара
     * @var mixed $product_name Название товара
     * @var mixed $menu_category_id Id категории меню. Если передать 0, то товар попадет на «Главный экран».
     * @var mixed $workshop Id цеха. Обязательное поле для аккаунтов типа «кафе».
     * @var mixed $weight_flag Признак, что товар штучный или весовой: 0 — штучный, 1 — весовой
     * @var mixed $color Цвет карточки товара: white, red, orange, yellow, green, blue, navy-blue, purple, black, mint-blue, lime-green, pink. По умолчанию принимает white.
     * @var mixed $different_spots_prices Признак, что у товара разные цены в разных заведениях: 0 — одинаковые цены, 1 — разные цены
     * @var mixed $modifications Признак, что товар с модификаторами: 0 — без модификаторов, 1 — с модификаторами
     * @var mixed $modificator_id Id модиикатора. Является обязательным, если в параметре modifications передана 1. Для существующих модифиторов необходимо передать их существующий modificator_id. Для новых модификаторов необходимо передать 0.
     * @var mixed $modificator_name Название модиикатора. Является обязательным, если в параметре modifications передана 1. Все имена передаются с указанием индекса модификатора в квадратных скобках: modificator_name[0], modificator_name[1] и так далее.
     * @var mixed $barcode Штрихововй код товара. Позволяет использовать сканер штрих-кодов во время продажи товаров. Для штучных товаров рекомендуется использовать 13-значный код, для весовых товаров рекомендуется использовать 7-значный код. Если товар без модификаторов, то параметр передается как barcode, если с модификаторами, то с указанием индекса модификатора в квадратных скобках: barcode[0], barcode[1] и так далее.
     * @var mixed $product_code Артикул товара. Указывается только для аккаунтов типа «магазин». Если товар без модификаторов, то параметр передается как product_code, если с модификаторами, то с указанием индекса модификатора в квадратных скобках: product_code[0], product_code[1] и так далее.
     * @var mixed $price Стоимость товара в копейках. Если товар без модификаторов, то параметр передаётся как price, если с модификаторами, то с указанием индекса модификаторов в квадратных скобках: price[0], price[1] и так далее. Кроме того, если включается свойство «разные цены в разных заведениях», то добавляется ещё один уровень массива, где будут указываться id заведений. То есть, price[1], price[2] и так далее — без модификаторов, и price[0][1], price[1][2] — с модификаторами (в качестве индекса сначала индекс модификации, а потом id заведения).
     * @var mixed $visible Признак, что товар виден на терминале в этом заведении: 0 — не виден, 1 — виден. Используется только при включенном свойстве «разные цены в разных заведениях». Структуру передачи данных идентична параметру price. То есть, visible[1], visible[2] и так далее — без модификаторов (id заведения в качестве индекса), и visible[0][1], visible[1][2] — с модификациями (в качестве индекса сначала индекс модификации, а потом id заведения).
     * ]
     *
     * @return object $response — response from API
     */
    public function updateProduct($params = array())
    {
        return $this->api->makeApiRequest('menu.updateProduct', 'post', $params);
    }

    /**
     * menu.set1cProductId: Изменение id товара в системе 1С
     * @link http://api.joinposter.com/#menu-set1cproductid
     *
     * @param array $params [
     * @var mixed $id Массив объектов
     * @var mixed $product_id Id товара
     * @var mixed $id_1c Id товара в системе 1С
     * ]
     *
     * @return object $response — response from API
     */
    public function set1cProductId($params = array())
    {
        return $this->api->makeApiRequest('menu.set1cProductId', 'post', $params);
    }

    /**
     * menu.set1cModificatorId: Изменение id модификатора товара в системе 1С
     * @link http://api.joinposter.com/#menu-set1cmodificatorid
     *
     * @param array $params [
     * @var mixed $id Массив объектов
     * @var mixed $modificator_id Id модификатора товара
     * @var mixed $id_1c Id модификатора товара в системе 1С
     * ]
     *
     * @return object $response — response from API
     */
    public function set1cModificatorId($params = array())
    {
        return $this->api->makeApiRequest('menu.set1cModificatorId', 'post', $params);
    }

    /**
     * menu.removeProduct: Удаление товара
     * @link http://api.joinposter.com/#menu-removeproduct
     *
     * @param array $params [
     * @var mixed $product_id Id товара
     * ]
     *
     * @return object $response — response from API
     */
    public function removeProduct($params = array())
    {
        return $this->api->makeApiRequest('menu.removeProduct', 'post', $params);
    }

    /**
     * menu.createDish: Создание тех. карты
     * @link http://api.joinposter.com/#menu-createdish
     *
     * @param array $params [
     * @var mixed $product_name Название тех. карты
     * @var mixed $barcode Штриховой код тех. карты. По умолчанию не передаётся.
     * @var mixed $menu_category_id Id категории тех. карты. По умолчанию принимает 0.
     * @var mixed $workshop_id Id цеха. По умолчанию принимает 1.
     * @var mixed $product_color Цвет карточки тех. карты: white, red, orange, yellow, green, blue, navy-blue, purple, black, mint-blue, lime-green, pink. По умолчанию принимает white.
     * @var mixed $weight_flag Признак, что тех. карта весовая: 0 — не весовая, 1 — весовая. По умолчанию принимает 0. Если в тех. карте присутсвует штучный ингредиент, то она не может быть весовой. Если тех. карта с модификациями не может быть весовой.
     * @var mixed $nodiscount Признак, что тех. карта  принимает участие в скидках: 0 — не принимает участие, 1 — принимает участие. По умолчанию принимает 1.
     * @var mixed $price Дельта добавляемой цены к продукту при добавлении модификации. Цена в копейках и может быть нулевой.
     * @var mixed $visible Массив видимости тех. карты по разным заведениям. Ключ массива — id заведения. Можно указать visible не массивом, тогда видимость раскидается на все заведения.
     * @var mixed $ingredient Массив ингредиентов и полуфабрикатов входящих в состав тех. карты
     * @var mixed $modificationgroup Массив групп модификаторов
     * @var mixed $id id полуфабриката или ингредиента
     * @var mixed $type Тип: 1 — ингредиент, 2 — тех. карта или полуфабрикат
     * @var mixed $brutto Вес, количество или литры модификатора
     * @var mixed $netto Нетто
     * @var mixed $bake Признак, используется ли метод приготоволения «варка»: 0 — нет, 1 — да. По умолчанию передаётся 0.
     * @var mixed $cook Признак, используется ли метод приготоволения «запекание»: 0 — нет, 1 — да. По умолчанию передаётся 0.
     * @var mixed $clear Признак, используется ли метод приготоволения «очистка»: 0 — нет, 1 — да. По умолчанию передаётся 0.
     * @var mixed $fry Признак, используется ли метод приготоволения «жарка»: 0 — нет, 1 — да. По умолчанию передаётся 0.
     * @var mixed $stew Признак, используется ли метод приготоволения «тушение»: 0 — нет, 1 — да. По умолчанию передаётся 0.
     * @var mixed $lock Тип зависимости нетто от брутто: 0 — ручная, 1 — автоматическая
     * @var mixed $minNum Минимальное количество модификаторов, которые нужно выбрать
     * @var mixed $maxNum Максимальное количество модификаторов, которые нужно выбрать
     * @var mixed $name Название модификатора
     * @var mixed $modifications Массив модификаторов
     * @var mixed $ingredientId Id ингредиента, тех. карты или полуфабриката
     * ]
     *
     * @return object $response — response from API
     */
    public function createDish($params = array())
    {
        return $this->api->makeApiRequest('menu.createDish', 'post', $params);
    }

    /**
     * menu.updateDish: Изменение свойств тех. карты
     * @link http://api.joinposter.com/#menu-updatedish
     *
     * @param array $params [
     * @var mixed $dish_id Id тех. карты
     * @var mixed $product_name Название тех. карты
     * @var mixed $barcode Штриховой код тех. карты
     * @var mixed $menu_category_id Id категории тех. карты
     * @var mixed $workshop_id Id цеха
     * @var mixed $product_color Цвет карточки тех. карты: white, red, orange, yellow, green, blue, navy-blue, purple, black, mint-blue, lime-green, pink
     * @var mixed $weight_flag Признак, что тех. карта весовая: 0 — не весовая, 1 — весовая. Если в тех. карте присутсвует штучный ингредиент, то она не может быть весовой.
     * @var mixed $nodiscount Признак, что тех. карта  принимает участие в скидках: 0 — не принимает участие, 1 — принимает участие
     * @var mixed $price Дельта добавляемой цены к продукту при добавлении модификации. Может быть нулевой.
     * @var mixed $visible Массив видимости тех. карты по разным заведениям. Ключ массива — id заведения. Можно указать visible не массивом, тогда видимость раскидается на все заведения.
     * @var mixed $ingredient Массив ингредиентов и полуфабрикатов входящих в состав тех. карты
     * @var mixed $modificationgroup Массив групп модификаторов
     * @var mixed $id id полуфабриката или ингредиента
     * @var mixed $type Тип: 1 — ингредиент, 2 — тех. карта или полуфабрикат
     * @var mixed $brutto Вес, количество или литры модификатора
     * @var mixed $netto Нетто
     * @var mixed $bake Признак, используется ли метод приготоволения «варка»: 0 — нет, 1 — да. По умолчанию передаётся 0.
     * @var mixed $cook Признак, используется ли метод приготоволения «запекание»: 0 — нет, 1 — да. По умолчанию передаётся 0.
     * @var mixed $clear Признак, используется ли метод приготоволения «очистка»: 0 — нет, 1 — да. По умолчанию передаётся 0.
     * @var mixed $fry Признак, используется ли метод приготоволения «жарка»: 0 — нет, 1 — да. По умолчанию передаётся 0.
     * @var mixed $stew Признак, используется ли метод приготоволения «тушение»: 0 — нет, 1 — да. По умолчанию передаётся 0.
     * @var mixed $lock Тип зависимости нетто от брутто: 0 — ручная, 1 — автоматическая
     * @var mixed $dish_modification_group_id Id группы которую редактируем. Все группы модификаций продукта, которые не прийдут в запросе, будут удалены.
     * @var mixed $minNum Минимальное количество модификаторов, которые нужно выбрать
     * @var mixed $maxNum Максимальное количество модификаторов, которые нужно выбрать
     * @var mixed $name Название модификатора
     * @var mixed $modifications Массив модификаторов
     * @var mixed $dish_modification_id Id модификации которую редактируем. Все модификации продукта, которые не прийдут в запросе, будут удалены.
     * @var mixed $ingredientId Id ингредиента, тех. карты или полуфабриката
     * ]
     *
     * @return object $response — response from API
     */
    public function updateDish($params = array())
    {
        return $this->api->makeApiRequest('menu.updateDish', 'post', $params);
    }

    /**
     * menu.removeDish: Удаление тех. карты
     * @link http://api.joinposter.com/#menu-removedish
     *
     * @param array $params [
     * @var mixed $dish_id Id тех. карты
     * ]
     *
     * @return object $response — response from API
     */
    public function removeDish($params = array())
    {
        return $this->api->makeApiRequest('menu.removeDish', 'post', $params);
    }

    /**
     * menu.getPrepacks: Список полуфабрикатов
     * @link http://api.joinposter.com/#menu-getprepacks
     *
     * @param array $params [
     * @var mixed $token Авторизационный токен
     * @var mixed $format Опциональный параметр, указывающий формат выдачи ответа. Может быть xml или json. По умолчанию json.
     * @var mixed $1c          Опциональный параметр, если значение `true` — возвращает в ответе id категории товаров в системе 1С. По умолчанию не передаётся.
     * ]
     *
     * @return object $response — response from API
     */
    public function getPrepacks($params = array())
    {
        return $this->api->makeApiRequest('menu.getPrepacks', 'get', $params);
    }

    /**
     * menu.getPrepack: Свойства полуфабриката
     * @link http://api.joinposter.com/#menu-getprepack
     *
     * @param array $params [
     * @var mixed $product_id Id полуфабриката
     * @var mixed $1c    Опциональный параметр, если значение `true` — возвращает в ответе id категории товаров в системе 1С. По умолчанию не передаётся.
     * ]
     *
     * @return object $response — response from API
     */
    public function getPrepack($params = array())
    {
        return $this->api->makeApiRequest('menu.getPrepack', 'get', $params);
    }

    /**
     * menu.createPrepack: Создание полуфабриката
     * @link http://api.joinposter.com/#menu-createprepack
     *
     * @param array $params [
     * @var mixed $product_name Название полуфабриката. Должно быть уникальным.
     * @var mixed $ingredient Ингредиенты входящие в состав полуфабриката
     * @var mixed $product_production_description Опциональный параметр, описание процесса приготовления.
     * @var mixed $id Id ингредиента или полуфабриката
     * @var mixed $type Тип элемента полуфабриката: 1 — ингредиент, 2 — полуфабрикат
     * @var mixed $brutto Брутто элемента полуфабриката
     * @var mixed $netto Нетто элемента полуфабриката
     * @var mixed $lock Зависимость нетто от брутто: 0 — ручная, 1 — автоматическая
     * @var mixed $clear Признак, что используется метод приготовления «очистка»: 0 — не используется, 1 — используется. По умолчанию принимает 0.
     * @var mixed $cook Признак, что используется метод приготовления «запекание»: 0 — не используется, 1 — используется. По умолчанию принимает 0.
     * @var mixed $fry Признак, что используется метод приготовления «жарка»: 0 — не используется, 1 — используется. По умолчанию принимает 0.
     * @var mixed $stew Признак, что используется метод приготовления «тущение»: 0 — не используется, 1 — используется. По умолчанию принимает 0.
     * @var mixed $bake Признак, что используется метод приготовления «варка»: 0 — не используется, 1 — используется. По умолчанию принимает 0.
     * ]
     *
     * @return object $response — response from API
     */
    public function createPrepack($params = array())
    {
        return $this->api->makeApiRequest('menu.createPrepack', 'post', $params);
    }

    /**
     * menu.updatePrepack: Изменение свойств полуфабриката
     * @link http://api.joinposter.com/#menu-updateprepack
     *
     * @param array $params [
     * @var mixed $prepack_id Id полуфабриката
     * @var mixed $product_name Название полуфабриката
     * @var mixed $product_production_description Описание процесса приготовления
     * @var mixed $ingredient Ингредиенты входящие в состав полуфабриката
     * @var mixed $id Id ингредиента или полуфабриката
     * @var mixed $type Тип элемента полуфабриката: 1 — ингредиент, 2 — полуфабрикат
     * @var mixed $brutto Брутто элемента полуфабриката
     * @var mixed $netto Нетто элемента полуфабриката
     * @var mixed $lock Зависимость нетто от брутто: 0 — ручная, 1 — автоматическая
     * @var mixed $clear Признак, что используется метод приготовления «очистка»: 0 — не используется, 1 — используется. По умолчанию принимает 0.
     * @var mixed $cook Признак, что используется метод приготовления «запекание»: 0 — не используется, 1 — используется. По умолчанию принимает 0.
     * @var mixed $fry Признак, что используется метод приготовления «жарка»: 0 — не используется, 1 — используется. По умолчанию принимает 0.
     * @var mixed $stew Признак, что используется метод приготовления «тущение»: 0 — не используется, 1 — используется. По умолчанию принимает 0.
     * @var mixed $bake Признак, что используется метод приготовления «варка»: 0 — не используется, 1 — используется. По умолчанию принимает 0.
     * ]
     *
     * @return object $response — response from API
     */
    public function updatePrepack($params = array())
    {
        return $this->api->makeApiRequest('menu.updatePrepack', 'post', $params);
    }

    /**
     * menu.removePrepack: Удаление полуфабриката
     * @link http://api.joinposter.com/#menu-removeprepack
     *
     * @param array $params [
     * @var mixed $prepack_id Id полуфабриката
     * ]
     *
     * @return object $response — response from API
     */
    public function removePrepack($params = array())
    {
        return $this->api->makeApiRequest('menu.removePrepack', 'post', $params);
    }

    /**
     * menu.getIngredients: Список ингредиентов
     * @link http://api.joinposter.com/#menu-getingredients
     *
     * @param array $params [
     * @var mixed $id_1c Опциональный параметр, если значение `true` — возвращает в ответе id категории товаров в системе 1С. По умолчанию не передаётся.
     * ]
     *
     * @return object $response — response from API
     */
    public function getIngredients($params = array())
    {
        return $this->api->makeApiRequest('menu.getIngredients', 'get', $params);
    }

    /**
     * menu.getIngredient: Свойства ингредиента
     * @link http://api.joinposter.com/#menu-getingredient
     *
     * @param array $params [
     * @var mixed $ingredient_id Id ингредиента
     * @var mixed $1c    Опциональный параметр, если значение `true` — возвращает в ответе id категории товаров в системе 1С. По умолчанию не передаётся.
     * ]
     *
     * @return object $response — response from API
     */
    public function getIngredient($params = array())
    {
        return $this->api->makeApiRequest('menu.getIngredient', 'get', $params);
    }

    /**
     * menu.createIngredient: Создание ингредиента
     * @link http://api.joinposter.com/#menu-createingredient
     *
     * @param array $params [
     * @var mixed $ingredient_name Название ингредиента
     * @var mixed $category_id Id категории ингредиента
     * @var mixed $type Единица измерения ингредиента: kg — килограммы, p — штуки, l — литры
     * @var mixed $weight_ingredient Вес ингредиента, если ингредиент штучный
     * @var mixed $loss_clear Коэффициент потерь при очистке ингредиента, если ингредиент не штучный
     * @var mixed $loss_cook Коэффициент потерь при запекании ингредиента, если ингредиент не штучный
     * @var mixed $loss_fry Коэффициент потерь при жарке ингредиента, если ингредиент не штучный
     * @var mixed $loss_stew Коэффициент потерь при тущении ингредиента, если ингредиент не штучный
     * @var mixed $loss_bake Коэффициент потерь при варке ингредиента, если ингредиент не штучный
     * @var mixed $partial_write_off Признак, что можно списывать штучный ингредиент, как дробный: 0 — нельзя, 1 — можно
     * ]
     *
     * @return object $response — response from API
     */
    public function createIngredient($params = array())
    {
        return $this->api->makeApiRequest('menu.createIngredient', 'post', $params);
    }

    /**
     * menu.updateIngredient: Изменение свойств ингредиента
     * @link http://api.joinposter.com/#menu-updateingredient
     *
     * @param array $params [
     * @var mixed $id Id ингредиента
     * @var mixed $ingredient_name Название ингредиента
     * @var mixed $category_id Id категории ингредиента
     * @var mixed $type Единица измерения ингредиента: kg — килограммы, p — штуки, l — литры. Нельзя менять единицу измерения ингредиента, если он уже поставлялся на склад.
     * @var mixed $weight_ingredient Вес ингредиента, если ингредиент штучный
     * @var mixed $loss_clear Коэффициент потерь при очистке ингредиента, если ингредиент не штучный
     * @var mixed $loss_cook Коэффициент потерь при запекании ингредиента, если ингредиент не штучный
     * @var mixed $loss_fry Коэффициент потерь при жарке ингредиента, если ингредиент не штучный
     * @var mixed $loss_stew Коэффициент потерь при тущении ингредиента, если ингредиент не штучный
     * @var mixed $loss_bake Коэффициент потерь при варке ингредиента, если ингредиент не штучный
     * @var mixed $partial_write_off Признак, что можно списывать штучный ингредиент, как дробный: 0 — нельзя, 1 — можно
     * ]
     *
     * @return object $response — response from API
     */
    public function updateIngredient($params = array())
    {
        return $this->api->makeApiRequest('menu.updateIngredient', 'post', $params);
    }

    /**
     * menu.set1cIngredientId: Изменение id товара в системе 1С
     * @link http://api.joinposter.com/#menu-set1cingredientid
     *
     * @param array $params [
     * @var mixed $id Массив из объектов
     * @var mixed $ingredient_id Id ингредиета
     * @var mixed $id_1c Id ингредиета в системе 1С
     * ]
     *
     * @return object $response — response from API
     */
    public function set1cIngredientId($params = array())
    {
        return $this->api->makeApiRequest('menu.set1cIngredientId', 'post', $params);
    }

    /**
     * menu.removeIngredient: Удаление ингредиета
     * @link http://api.joinposter.com/#menu-removeingredient
     *
     * @param array $params [
     * @var mixed $ingredient_id Id ингредиета
     * ]
     *
     * @return object $response — response from API
     */
    public function removeIngredient($params = array())
    {
        return $this->api->makeApiRequest('menu.removeIngredient', 'post', $params);
    }

    /**
     * menu.getCategoriesIngredients: Список категорий ингредиентов
     * @link http://api.joinposter.com/#menu-getcategoriesingredients
     *
     * @param array $params [
     * @var mixed $1c    Опциональный параметр, если значение `true` — возвращает в ответе id категории товаров в системе 1С. По умолчанию не передаётся.
     * ]
     *
     * @return object $response — response from API
     */
    public function getCategoriesIngredients($params = array())
    {
        return $this->api->makeApiRequest('menu.getCategoriesIngredients', 'get', $params);
    }

    /**
     * menu.getCategoryIngredients: Свойства категории ингредиентов
     * @link http://api.joinposter.com/#menu-getcategoryingredients
     *
     * @param array $params [
     * @var mixed $category_id Id категории ингредиентов
     * @var mixed $1c    Опциональный параметр, если значение `true` — возвращает в ответе id категории товаров в системе 1С. По умолчанию не передаётся.
     * ]
     *
     * @return object $response — response from API
     */
    public function getCategoryIngredients($params = array())
    {
        return $this->api->makeApiRequest('menu.getCategoryIngredients', 'get', $params);
    }

    /**
     * menu.createCategoryIngredients: Создание категории ингредиентов
     * @link http://api.joinposter.com/#menu-createcategoryingredients
     *
     * @param array $params [
     * @var mixed $category_name Название категории ингредиентов
     * ]
     *
     * @return object $response — response from API
     */
    public function createCategoryIngredients($params = array())
    {
        return $this->api->makeApiRequest('menu.createCategoryIngredients', 'post', $params);
    }

    /**
     * menu.updateCategoryIngredients: Изменение свойств категории ингредиентов
     * @link http://api.joinposter.com/#menu-updatecategoryingredients
     *
     * @param array $params [
     * @var mixed $category_id Id категории ингредиентов
     * @var mixed $category_name Новое название категории ингредиентов
     * ]
     *
     * @return object $response — response from API
     */
    public function updateCategoryIngredients($params = array())
    {
        return $this->api->makeApiRequest('menu.updateCategoryIngredients', 'post', $params);
    }

    /**
     * menu.set1cCategoryIngredientsId: Изменение id категории ингредиентов в системе 1С
     * @link http://api.joinposter.com/#menu-set1ccategoryingredientsid
     *
     * @param array $params [
     * @var mixed $id Массив из объектов
     * @var mixed $category_id Id категории ингредиентов
     * @var mixed $id_1c Id категории ингредиентов в системе 1С
     * ]
     *
     * @return object $response — response from API
     */
    public function set1cCategoryIngredientsId($params = array())
    {
        return $this->api->makeApiRequest('menu.set1cCategoryIngredientsId', 'post', $params);
    }

    /**
     * menu.removeCategoryIngredients: Удаление категории ингредиентов
     * @link http://api.joinposter.com/#menu-removecategoryingredients
     *
     * @param array $params [
     * @var mixed $category_id Id категории ингредиентов
     * @var mixed $with_ingredients Признак, удалять ли ингредиенты в категории: 0 — не удалять, 1 — удалять. По умолчанию принимает 0.
     * ]
     *
     * @return object $response — response from API
     */
    public function removeCategoryIngredients($params = array())
    {
        return $this->api->makeApiRequest('menu.removeCategoryIngredients', 'post', $params);
    }

    /**
     * menu.getWorkshops: Список цехов
     * @link http://api.joinposter.com/#menu-getworkshops
     *
     * @param array $params [
     * ]
     *
     * @return object $response — response from API
     */
    public function getWorkshops($params = array())
    {
        return $this->api->makeApiRequest('menu.getWorkshops', 'get', $params);
    }

    /**
     * menu.getWorkshop: Свойства цеха
     * @link http://api.joinposter.com/#menu-getworkshop
     *
     * @param array $params [
     * @var mixed $workshop_id Id цеха
     * ]
     *
     * @return object $response — response from API
     */
    public function getWorkshop($params = array())
    {
        return $this->api->makeApiRequest('menu.getWorkshop', 'get', $params);
    }

    /**
     * menu.createWorkshop: Создание цеха
     * @link http://api.joinposter.com/#menu-createworkshop
     *
     * @param array $params [
     * @var mixed $workshop_name Обязательный параметр, название цеха
     * ]
     *
     * @return object $response — response from API
     */
    public function createWorkshop($params = array())
    {
        return $this->api->makeApiRequest('menu.createWorkshop', 'post', $params);
    }

    /**
     * menu.updateWorkshop: Изменение свойств цеха
     * @link http://api.joinposter.com/#menu-updateworkshop
     *
     * @param array $params [
     * @var mixed $workshop_id Id цеха
     * @var mixed $workshop_name Название цеха
     * ]
     *
     * @return object $response — response from API
     */
    public function updateWorkshop($params = array())
    {
        return $this->api->makeApiRequest('menu.updateWorkshop', 'post', $params);
    }

    /**
     * menu.removeWorkshop: Удаление цеха
     * @link http://api.joinposter.com/#menu-removeworkshop
     *
     * @param array $params [
     * @var mixed $workshop_id Id цеха
     * ]
     *
     * @return object $response — response from API
     */
    public function removeWorkshop($params = array())
    {
        return $this->api->makeApiRequest('menu.removeWorkshop', 'post', $params);
    }

}


class StorageAPI
{
    private $api;

    public function __construct(PosterApiCore $params)
    {
        $this->api = $params;
    }

    /**
     * storage.getManufactures: Список производств
     * @link http://api.joinposter.com/#storage-getmanufactures
     *
     * @param array $params [
     * @var mixed $num Количество производств, которое необходимо получить
     * @var mixed $offset Сколько записей необходимо пропустить от начала списка
     * ]
     *
     * @return object $response — response from API
     */
    public function getManufactures($params = array())
    {
        return $this->api->makeApiRequest('storage.getManufactures', 'get', $params);
    }

    /**
     * storage.getManufacture: Данные производства
     * @link http://api.joinposter.com/#storage-getmanufacture
     *
     * @param array $params [
     * @var mixed $manufacture_id Id производства, для которого необходимо вернуть детальные данные
     * ]
     *
     * @return object $response — response from API
     */
    public function getManufacture($params = array())
    {
        return $this->api->makeApiRequest('storage.getManufacture', 'get', $params);
    }

    /**
     * storage.getManufacturesWriteOffs: Списания по производствам
     * @link http://api.joinposter.com/#storage-getmanufactureswriteoffs
     *
     * @param array $params [
     * @var mixed $date_from Дата начала выборки, формат "Y-m-d"
     * @var mixed $date_to Дата конца выборки, формат "Y-m-d"
     * @var mixed $per_page Количество чеков на одной странице. По умолчанию принимает 100, максимальное значение — 1000.
     * @var mixed $page Номер страницы, по умолчанию принимает 1
     * ]
     *
     * @return object $response — response from API
     */
    public function getManufacturesWriteOffs($params = array())
    {
        return $this->api->makeApiRequest('storage.getManufacturesWriteOffs', 'get', $params);
    }

    /**
     * storage.createManufacture: Создание производства
     * @link http://api.joinposter.com/#storage-createmanufacture
     *
     * @param array $params [
     * @var mixed $date Дата производства
     * @var mixed $storage_id id склада
     * @var mixed $products Список тех.карт или полуфабрикатов, которые входят в производство
     * ]
     *
     * @return object $response — response from API
     */
    public function createManufacture($params = array())
    {
        return $this->api->makeApiRequest('storage.createManufacture', 'post', $params);
    }

    /**
     * storage.updateManufacture: Изменение данных производства
     * @link http://api.joinposter.com/#storage-updatemanufacture
     *
     * @param array $params [
     * @var mixed $manufacture_id id изменяемого производства
     * @var mixed $date Дата производства
     * @var mixed $storage_id id склада
     * @var mixed $products Список тех.карт/полуфабрикатов, которые входят в производство
     * ]
     *
     * @return object $response — response from API
     */
    public function updateManufacture($params = array())
    {
        return $this->api->makeApiRequest('storage.updateManufacture', 'post', $params);
    }

    /**
     * storage.getMoves: Получить все перемещения
     * @link http://api.joinposter.com/#storage-getmoves
     *
     * @param array $params [
     * @var mixed $dateFrom Опциональный параметр, дата начала выборки в формате `Ymd`, включительно. По умолчанию дата месяц назад.
     * @var mixed $dateTo Опциональный параметр, дата конца выборки в формате `Ymd`, включительно. По умолчанию дата текущего дня.
     * ]
     *
     * @return object $response — response from API
     */
    public function getMoves($params = array())
    {
        return $this->api->makeApiRequest('storage.getMoves', 'get', $params);
    }

    /**
     * storage.getMove: Получить содержимое перемещения
     * @link http://api.joinposter.com/#storage-getmove
     *
     * @param array $params [
     * @var mixed $move_id Обязательный параметр, id перемещения
     * @var mixed $timezone Опциональный параметры, если равен `client` то дата возвращается в часовом поясе аккаунта.
     * ]
     *
     * @return object $response — response from API
     */
    public function getMove($params = array())
    {
        return $this->api->makeApiRequest('storage.getMove', 'get', $params);
    }

    /**
     * storage.createMoving: Создание перемещения
     * @link http://api.joinposter.com/#storage-createmoving
     *
     * @param array $params [
     * @var mixed $date Дата и время списания в формате `Ymd`
     * @var mixed $from_storage_id id склада c которого делаем перемещение
     * @var mixed $to_storage_id id склада  на который делаем перемещение
     * @var mixed $ingredient Массив объектов для перемещения
     * @var mixed $id id ингредиента, товара или модификатора товара
     * @var mixed $type Тип списываемого объекта: товар — 1, ингредиент — 4, модификатор товара — 5
     * @var mixed $num Количество списываемого ингредиента
     * @var mixed $reason Опциональный параметр, причина списания
     * @var mixed $packing Опциональный параметр, id фасовки
     * @var mixed $sum Цена за единицу в гривнах\рублях
     * ]
     *
     * @return object $response — response from API
     */
    public function createMoving($params = array())
    {
        return $this->api->makeApiRequest('storage.createMoving', 'post', $params);
    }

    /**
     * storage.updateMoving: Изменение перемещения
     * @link http://api.joinposter.com/#storage-updatemoving
     *
     * @param array $params [
     * @var mixed $moving_id id перемещения которое редактируем
     * @var mixed $date Дата и время списания в формате `Ymd`
     * @var mixed $from_storage_id id склада c которого делаем перемещение
     * @var mixed $to_storage_id id склада  на который делаем перемещение
     * @var mixed $ingredient Массив объектов для перемещения
     * @var mixed $id id ингредиента, товара или модификатора товара
     * @var mixed $type Тип списываемого объекта: товар — 1, ингредиент — 4, модификатор товара — 5
     * @var mixed $num Количество списываемого ингредиента
     * @var mixed $reason Опциональный параметр, причина списания
     * @var mixed $packing Опциональный параметр, id фасовки
     * @var mixed $sum Цена за единицу в гривнах\рублях
     * ]
     *
     * @return object $response — response from API
     */
    public function updateMoving($params = array())
    {
        return $this->api->makeApiRequest('storage.updateMoving', 'post', $params);
    }

    /**
     * storage.deleteMoving: Удаление перемещения
     * @link http://api.joinposter.com/#storage-deletemoving
     *
     * @param array $params [
     * @var mixed $moving_id id перемещения для удаления
     * ]
     *
     * @return object $response — response from API
     */
    public function deleteMoving($params = array())
    {
        return $this->api->makeApiRequest('storage.deleteMoving', 'post', $params);
    }

    /**
     * storage.getSupplies: Получить все поставки
     * @link http://api.joinposter.com/#storage-getsupplies
     *
     * @param array $params [
     * @var mixed $dateFrom Опциональный параметр, дата начала выборки в формате `Ymd`, включительно. По умолчанию дата месяц назад.
     * @var mixed $dateTo Опциональный параметр, дата конца выборки в формате `Ymd`, включительно. По умолчанию дата текущего дня.
     * @var mixed $limit Опциональный параметр, количество поставок, которое необходимо получить. Если используется `dateFrom` и `dateTo` то этот параметр игнорируется.
     * @var mixed $offset Опциональный параметр, сколько записей необходимо пропустить от начала списка. По умолчанию, будут выданы все поставки.  Если используется `dateFrom` и `dateTo` то этот параметр игнорируется.
     * ]
     *
     * @return object $response — response from API
     */
    public function getSupplies($params = array())
    {
        return $this->api->makeApiRequest('storage.getSupplies', 'get', $params);
    }

    /**
     * storage.createSupply: Создание поставки
     * @link http://api.joinposter.com/#storage-createsupply
     *
     * @param array $params [
     * @var mixed $date Дата поставки в формате `Y-m-d H:i:s`
     * @var mixed $supplier_id id поставщика
     * @var mixed $storage_id id склада на который делаем поставку
     * @var mixed $account_id Опциональный параметр, id счета в бухгалтерии к которому привязываем поставку
     * @var mixed $ingredient Массив объектов для поставки
     * @var mixed $id id ингредиента, товара или модификатора товара
     * @var mixed $type Тип списываемого объекта: товар — 1, ингредиент — 4, модификатор товара — 5
     * @var mixed $num Количество списываемого ингредиента
     * @var mixed $sum Цена за единицу в гривнах\рублях
     * @var mixed $packing Опциональный параметр, id фасовки
     * ]
     *
     * @return object $response — response from API
     */
    public function createSupply($params = array())
    {
        return $this->api->makeApiRequest('storage.createSupply', 'post', $params);
    }

    /**
     * storage.updateSupply: Изменение поставки
     * @link http://api.joinposter.com/#storage-updatesupply
     *
     * @param array $params [
     * @var mixed $supply_id id поставки которую редактируем
     * @var mixed $date Дата поставки в формате `Y-m-d H:i:s`
     * @var mixed $supplier_id id поставщика
     * @var mixed $storage_id Обязательный параметр, id склада на который делаем поставку
     * @var mixed $account_id Опциональный параметр, id счета в бухгалтерии к которому привязываем поставку
     * @var mixed $ingredient Массив объектов для поставки
     * @var mixed $id id ингредиента, товара или модификатора товара
     * @var mixed $type Тип списываемого объекта: товар — 1, ингредиент — 4, модификатор товара — 5
     * @var mixed $num Количество списываемого ингредиента
     * @var mixed $sum Цена за единицу в гривнах\рублях
     * @var mixed $packing Опциональный параметр, id фасовки
     * ]
     *
     * @return object $response — response from API
     */
    public function updateSupply($params = array())
    {
        return $this->api->makeApiRequest('storage.updateSupply', 'post', $params);
    }

    /**
     * storage.deleteSupply: Удаление поставки
     * @link http://api.joinposter.com/#storage-deletesupply
     *
     * @param array $params [
     * @var mixed $supply_id id поставки для удаления
     * ]
     *
     * @return object $response — response from API
     */
    public function deleteSupply($params = array())
    {
        return $this->api->makeApiRequest('storage.deleteSupply', 'post', $params);
    }

    /**
     * storage.getIngredientWriteOff: Получить не ручные списания
     * @link http://api.joinposter.com/#storage-getingredientwriteoff
     *
     * @param array $params [
     * @var mixed $dateFrom Опциональный параметр, дата начала выборки в формате `Ymd`, включительно. По умолчанию дата месяц назад.
     * @var mixed $dateTo Опциональный параметр, дата конца выборки в формате `Ymd`, включительно. По умолчанию дата текущего дня.
     * @var mixed $storage_id Опциональный параметр, id склада по которому возвращать списания. По умолчанию по всем складам.
     * @var mixed $ingredient_id Опциональный параметр, id ингредиента по которому возвращать списания. По умолчанию по всем ингредиентам.
     * ]
     *
     * @return object $response — response from API
     */
    public function getIngredientWriteOff($params = array())
    {
        return $this->api->makeApiRequest('storage.getIngredientWriteOff', 'get', $params);
    }

    /**
     * storage.createWriteOff: Создание списания
     * @link http://api.joinposter.com/#storage-createwriteoff
     *
     * @param array $params [
     * @var mixed $date Дата поставки в формате `Y-m-d H:i:s`
     * @var mixed $storage_id id склада с которого делаем списание
     * @var mixed $ingredient Массив объектов для списания
     * @var mixed $id id ингредиента, товара или модификатора товара
     * @var mixed $type Тип списываемого объекта: товар — 1, ингредиент — 4, модификатор товара — 5
     * @var mixed $weight Количество списываемого ингредиента
     * @var mixed $sum Цена за единицу в гривнах\рублях
     * @var mixed $packing Опциональный параметр, id фасовки
     * @var mixed $reason Опциональный параметр, причина списания
     * ]
     *
     * @return object $response — response from API
     */
    public function createWriteOff($params = array())
    {
        return $this->api->makeApiRequest('storage.createWriteOff', 'post', $params);
    }

    /**
     * storage.updateWriteOff: Изменение списания
     * @link http://api.joinposter.com/#storage-updatewriteoff
     *
     * @param array $params [
     * @var mixed $id id ингредиента, товара или модификатора товара
     * @var mixed $date Дата поставки в формате `Y-m-d H:i:s`. Дата должна находиться в инвентаризационном периоде в котором произвели списание.
     * @var mixed $storage_id id склада с которого делаем списание
     * @var mixed $ingredient Массив объектов для списания
     * @var mixed $type Тип списываемого объекта: товар — 1, ингредиент — 4, модификатор товара — 5
     * @var mixed $weight Количество списываемого ингредиента
     * @var mixed $sum Цена за единицу в гривнах\рублях
     * @var mixed $packing Опциональный параметр, id фасовки
     * @var mixed $reason Опциональный параметр, причина списания
     * ]
     *
     * @return object $response — response from API
     */
    public function updateWriteOff($params = array())
    {
        return $this->api->makeApiRequest('storage.updateWriteOff', 'post', $params);
    }

    /**
     * storage.deleteWriteOff: Удаление списания
     * @link http://api.joinposter.com/#storage-deletewriteoff
     *
     * @param array $params [
     * @var mixed $write_off_id id списания для удаления
     * ]
     *
     * @return object $response — response from API
     */
    public function deleteWriteOff($params = array())
    {
        return $this->api->makeApiRequest('storage.deleteWriteOff', 'post', $params);
    }

    /**
     * storage.getPacks: Список фасовок
     * @link http://api.joinposter.com/#storage-getpacks
     *
     * @param array $params [
     * ]
     *
     * @return object $response — response from API
     */
    public function getPacks($params = array())
    {
        return $this->api->makeApiRequest('storage.getPacks', 'get', $params);
    }

    /**
     * storage.getPack: Получить фасовку
     * @link http://api.joinposter.com/#storage-getpack
     *
     * @param array $params [
     * @var mixed $pack_id Id фасовки, для которой необходимо вернуть детальные данные
     * ]
     *
     * @return object $response — response from API
     */
    public function getPack($params = array())
    {
        return $this->api->makeApiRequest('storage.getPack', 'get', $params);
    }

    /**
     * storage.getWastes: Список ручных списаний
     * @link http://api.joinposter.com/#storage-getwastes
     *
     * @param array $params [
     * @var mixed $dateFrom Опциональный параметр. Дата начала выборки (Ymd). По умолчанию дата месяц назад.
     * @var mixed $dateTo Опциональный параметр. Дата конца выборки (Ymd). По умолчанию дата текущего дня.
     * @var mixed $1с_id    Опциональный параметр. Позволяет возвращать ручные списания с учётом удалённых (вернёт флаг delete). В качестве значения необходимо указать true.
     * ]
     *
     * @return object $response — response from API
     */
    public function getWastes($params = array())
    {
        return $this->api->makeApiRequest('storage.getWastes', 'get', $params);
    }

    /**
     * storage.getWaste: Данные ручного списания
     * @link http://api.joinposter.com/#storage-getwaste
     *
     * @param array $params [
     * @var mixed $waste_id id ручного списания для которого необходимо вернуть детальные данные
     * ]
     *
     * @return object $response — response from API
     */
    public function getWaste($params = array())
    {
        return $this->api->makeApiRequest('storage.getWaste', 'get', $params);
    }

    /**
     * storage.getWasteReasons: Список причин списания
     * @link http://api.joinposter.com/#storage-getwastereasons
     *
     * @param array $params [
     * ]
     *
     * @return object $response — response from API
     */
    public function getWasteReasons($params = array())
    {
        return $this->api->makeApiRequest('storage.getWasteReasons', 'get', $params);
    }

    /**
     * storage.getInventoryIngredients: Получить инвентаризацию по ингредиентам
     * @link http://api.joinposter.com/#storage-getinventoryingredients
     *
     * @param array $params [
     * @var mixed $storage_id id склада, если `inventory_id` не указан то обязательный параметр
     * @var mixed $inventory_id id инвентаризации, если `storage_id` не указан то обязательный параметр
     * ]
     *
     * @return object $response — response from API
     */
    public function getInventoryIngredients($params = array())
    {
        return $this->api->makeApiRequest('storage.getInventoryIngredients', 'get', $params);
    }

    /**
     * storage.getStorageInventories: Получить архив инвентаризаций по складам
     * @link http://api.joinposter.com/#storage-getstorageinventories
     *
     * @param array $params [
     * @var mixed $storage_id Обязательный параметр, id склада по которому возвращать инвентаризации
     * ]
     *
     * @return object $response — response from API
     */
    public function getStorageInventories($params = array())
    {
        return $this->api->makeApiRequest('storage.getStorageInventories', 'get', $params);
    }

    /**
     * storage.getStorageLeftovers: Получить все остатки на складах
     * @link http://api.joinposter.com/#storage-getstorageleftovers
     *
     * @param array $params [
     * @var mixed $storage_id Опциональный параметр, id склада по которому возвращать остатки. Если не указан, будут выданы по все складам.
     * @var mixed $type Опциональный параметр, тип сущности по которой возвращать остатки: 1 — товар, 2 — производимая тех-карта, 3 — производимый полуфабрикат, ингредиент — 4, модификатор товара — 5. Если не указан, будут выданы по все сущностям.
     * @var mixed $category_id Опциональный параметр, id категории по которой получать ингредиенты. По умолчанию по всем категориям.
     * @var mixed $zero_leftovers Опциональный параметр, если `true`, метод возвращает нулевые остатки. По умолчанию, не возвращаются.
     * ]
     *
     * @return object $response — response from API
     */
    public function getStorageLeftovers($params = array())
    {
        return $this->api->makeApiRequest('storage.getStorageLeftovers', 'get', $params);
    }

    /**
     * storage.getStorages: Получить все склады
     * @link http://api.joinposter.com/#storage-getstorages
     *
     * @param array $params [
     * ]
     *
     * @return object $response — response from API
     */
    public function getStorages($params = array())
    {
        return $this->api->makeApiRequest('storage.getStorages', 'get', $params);
    }

    /**
     * storage.getSuppliers: Получить всех поставщиков
     * @link http://api.joinposter.com/#storage-getsuppliers
     *
     * @param array $params [
     * @var mixed $id_1c Опциональный параметр, `true` если возвращать id_1
     * ]
     *
     * @return object $response — response from API
     */
    public function getSuppliers($params = array())
    {
        return $this->api->makeApiRequest('storage.getSuppliers', 'get', $params);
    }

    /**
     * storage.getSupplyIngredients: Получить ингредиенты в поставке
     * @link http://api.joinposter.com/#storage-getsupplyingredients
     *
     * @param array $params [
     * @var mixed $supply_id Обязательный параметр, id поставки
     * ]
     *
     * @return object $response — response from API
     */
    public function getSupplyIngredients($params = array())
    {
        return $this->api->makeApiRequest('storage.getSupplyIngredients', 'get', $params);
    }

    /**
     * storage.createSupplier: Создание поставщика
     * @link http://api.joinposter.com/#storage-createsupplier
     *
     * @param array $params [
     * @var mixed $supplier_name Имя поставщика
     * @var mixed $supplier_adress Адрес
     * @var mixed $supplier_phone Телефон
     * @var mixed $supplier_code ЕГРПОУ
     * @var mixed $supplier_tin ИНН
     * @var mixed $supplier_comment Комментарий
     * ]
     *
     * @return object $response — response from API
     */
    public function createSupplier($params = array())
    {
        return $this->api->makeApiRequest('storage.createSupplier', 'post', $params);
    }

}


class ClientsAPI
{
    private $api;

    public function __construct(PosterApiCore $params)
    {
        $this->api = $params;
    }

    /**
     * clients.getClients: Список клиентов
     * @link http://api.joinposter.com/#clients-getclients
     *
     * @param array $params [
     * @var mixed $num Количество клиентов, которое необходимо получить. По умолчанию не передаётся.
     * @var mixed $offset Количество клиентов, которое необходимо пропустить от начала. По умолчанию не передаётся.
     * @var mixed $group_id Id группы клиентов. По умолчанию не передаётся.
     * @var mixed $phone Номер телефона клиента в международном формате. По умолчанию не передаётся.
     * @var mixed $birthday Дата дня рождения клиентов, формат "md". По умолчанию не передаётся.
     * @var mixed $client_id_only Опциональный параметр, позволяет возвращать только client_id клиентов. В качестве значения необходимо указать true.
     * @var mixed $1c    Позволяет вернуть в ответе id клиента в системе 1С. В качестве значения необходимо передать true. По умолчанию не передаётся.
     * @var mixed $order_by Поле, по которому происходит сортировка. По умолчанию принимает `client_id`.
     * @var mixed $sort Порядок сортировки: `asc` — по возрастанию, `desc` — по убыванию. По умолчанию принимает `desc`.
     * ]
     *
     * @return object $response — response from API
     */
    public function getClients($params = array())
    {
        return $this->api->makeApiRequest('clients.getClients', 'get', $params);
    }

    /**
     * clients.getClient: Свойства клиента
     * @link http://api.joinposter.com/#clients-getclient
     *
     * @param array $params [
     * @var mixed $client_id Id клиента
     * @var mixed $1c    Позволяет вернуть в ответе id клиента в системе 1С. В качестве значения необходимо передать true. По умолчанию не передаётся.
     * ]
     *
     * @return object $response — response from API
     */
    public function getClient($params = array())
    {
        return $this->api->makeApiRequest('clients.getClient', 'get', $params);
    }

    /**
     * clients.createClient: Создание клиента
     * @link http://api.joinposter.com/#clients-createclient
     *
     * @param array $params [
     * @var mixed $client_name ФИО клиента
     * @var mixed $client_sex Пол клиента: 0 — не указан, 1 — мужской, 2 — женский
     * @var mixed $client_groups_id_client Id группы клиентов
     * @var mixed $card_number Номер карты клиента
     * @var mixed $discount_per Персональный процент скидки или бонсов. Будет использоваться, если больше, чем процент группы клиента.
     * @var mixed $phone Телефон клиента, уникальный, в системе не может быть два клиента с одинаковым номером
     * @var mixed $email Адрес электронной почты клиента
     * @var mixed $birthday Дата рождения клиента, формат "Y-m-d"
     * @var mixed $city Город клиента
     * @var mixed $country Страна клиента
     * @var mixed $address Адрес клиента
     * @var mixed $comment Комментарий к учетной записи клиента
     * @var mixed $bonus Текущий размер накопленных бонусов клиента
     * @var mixed $total_payed_sum Общая сумма покупок в копейках
     * ]
     *
     * @return object $response — response from API
     */
    public function createClient($params = array())
    {
        return $this->api->makeApiRequest('clients.createClient', 'post', $params);
    }

    /**
     * clients.updateClient: Изменение свойств клиента
     * @link http://api.joinposter.com/#clients-updateclient
     *
     * @param array $params [
     * @var mixed $client_id Id клиента
     * @var mixed $client_name ФИО клиента
     * @var mixed $client_sex Пол клиента: 0 — не указан, 1 — мужской, 2 — женский
     * @var mixed $client_groups_id_client Id группы клиентов
     * @var mixed $card_number Номер карты клиента
     * @var mixed $discount_per Персональный процент скидки или бонсов. Будет использоваться, если будет больше, чем процент группы клиента.
     * @var mixed $phone Телефон клиента, уникальный, в системе не может быть два клиента с одинаковым номером
     * @var mixed $email Адрес электронной почты клиента
     * @var mixed $birthday Дата рождения клиента, формат "Y-m-d"
     * @var mixed $city Город клиента
     * @var mixed $country Страна клиента
     * @var mixed $address Адрес клиента
     * @var mixed $comment Комментарий к учетной записи клиента
     * @var mixed $bonus Текущий размер накопленных бонусов клиента
     * @var mixed $total_payed_sum Общая сумма покупок в копейках
     * ]
     *
     * @return object $response — response from API
     */
    public function updateClient($params = array())
    {
        return $this->api->makeApiRequest('clients.updateClient', 'post', $params);
    }

    /**
     * clients.changeClientBonus: Изменение количества бонусов клиента
     * @link http://api.joinposter.com/#clients-changeclientbonus
     *
     * @param array $params [
     * @var mixed $client_id Id клиента
     * @var mixed $count Количество бонусов, которые надо начислить клиенту. Если число положительное — начислить, если число отрицательное — списать.
     * @var mixed $block_webhook Опциональный параметр, если true — в ответ не прийдет вебхук об измении данных этого клиента
     * ]
     *
     * @return object $response — response from API
     */
    public function changeClientBonus($params = array())
    {
        return $this->api->makeApiRequest('clients.changeClientBonus', 'post', $params);
    }

    /**
     * clients.changeClientPayedSum: Изменение общей суммы покупок клиента
     * @link http://api.joinposter.com/#clients-changeclientpayedsum
     *
     * @param array $params [
     * @var mixed $client_id Id клиента
     * @var mixed $count Сумма покупок, которую надо начислить клиенту. Если число положительное — начислить, если число отрицательное — списать.
     * @var mixed $block_webhook Опциональный параметр, если true — в ответ не прийдет вебхук об измении данных этого клиента
     * ]
     *
     * @return object $response — response from API
     */
    public function changeClientPayedSum($params = array())
    {
        return $this->api->makeApiRequest('clients.changeClientPayedSum', 'post', $params);
    }

    /**
     * clients.set1cClientId: Изменение id клиента в системе 1С
     * @link http://api.joinposter.com/#clients-set1cclientid
     *
     * @param array $params [
     * @var mixed $id Массив объектов
     * @var mixed $client_id Id клиента
     * @var mixed $id_1c Id клиента в системе 1С
     * ]
     *
     * @return object $response — response from API
     */
    public function set1cClientId($params = array())
    {
        return $this->api->makeApiRequest('clients.set1cClientId', 'post', $params);
    }

    /**
     * clients.removeClient: Удаление клиента
     * @link http://api.joinposter.com/#clients-removeclient
     *
     * @param array $params [
     * @var mixed $client_id Id клиента
     * ]
     *
     * @return object $response — response from API
     */
    public function removeClient($params = array())
    {
        return $this->api->makeApiRequest('clients.removeClient', 'post', $params);
    }

    /**
     * clients.getGroups: Список групп клиентов
     * @link http://api.joinposter.com/#clients-getgroups
     *
     * @param array $params [
     * ]
     *
     * @return object $response — response from API
     */
    public function getGroups($params = array())
    {
        return $this->api->makeApiRequest('clients.getGroups', 'get', $params);
    }

    /**
     * clients.getGroup: Свойства группы клиентов
     * @link http://api.joinposter.com/#clients-getgroup
     *
     * @param array $params [
     * @var mixed $group_id Id группы клиентов
     * ]
     *
     * @return object $response — response from API
     */
    public function getGroup($params = array())
    {
        return $this->api->makeApiRequest('clients.getGroup', 'get', $params);
    }

    /**
     * clients.createGroup: Создание группы клиентов
     * @link http://api.joinposter.com/#clients-creategroup
     *
     * @param array $params [
     * @var mixed $client_groups_name Название группы клиентов
     * @var mixed $loyalty_type Тип группы клиентов: 1 — бонусная, 2 — скидочная
     * @var mixed $client_groups_discount Процент группы. Если группа бонусная - 1, то будет начислять бонусы на оплаченную сумму заказа. Если группа скидочная — 2, то будет давать процент скидки на сумму заказа.
     * @var mixed $birthday_bonus Количество бонусов в копейках начисляемые в день рождения клиента. Используется только бонусными группами.
     * ]
     *
     * @return object $response — response from API
     */
    public function createGroup($params = array())
    {
        return $this->api->makeApiRequest('clients.createGroup', 'post', $params);
    }

    /**
     * clients.updateGroup: Изменение свойств группы клиентов
     * @link http://api.joinposter.com/#clients-updategroup
     *
     * @param array $params [
     * @var mixed $client_groups_id Id группы клиентов
     * @var mixed $client_groups_name Название группы клиентов
     * @var mixed $loyalty_type Тип группы клиентов: 1 — бонусная, 2 — скидочная
     * @var mixed $client_groups_discount Процент группы. Если группа бонусная — 1, то будет начислять бонусы на оплаченную сумму заказа. Если группа скидочная — 2, то будет давать процент скидки на сумму заказа.
     * @var mixed $birthday_bonus Количество бонусов в копейках начисляемые в день рождения клиента. Используется только бонусными группами.
     * ]
     *
     * @return object $response — response from API
     */
    public function updateGroup($params = array())
    {
        return $this->api->makeApiRequest('clients.updateGroup', 'post', $params);
    }

    /**
     * clients.removeGroup: Удаление группы клиентов
     * @link http://api.joinposter.com/#clients-removegroup
     *
     * @param array $params [
     * @var mixed $group_id Id группы клиентов
     * ]
     *
     * @return object $response — response from API
     */
    public function removeGroup($params = array())
    {
        return $this->api->makeApiRequest('clients.removeGroup', 'post', $params);
    }

    /**
     * clients.sendSms: Отправка SMS от имени аккаунта
     * @link http://api.joinposter.com/#clients-sendsms
     *
     * @param array $params [
     * @var mixed $phone Номер телефона на которые отправляется SMS. Номер должен быть в международном формате, без лидирующего +.
     * @var mixed $message Текст SMS сообщения
     * ]
     *
     * @return object $response — response from API
     */
    public function sendSms($params = array())
    {
        return $this->api->makeApiRequest('clients.sendSms', 'post', $params);
    }

}


class TransactionsAPI
{
    private $api;

    public function __construct(PosterApiCore $params)
    {
        $this->api = $params;
    }

    /**
     * transactions.getTransactions: Список чеков
     * @link http://api.joinposter.com/#transactions-gettransactions
     *
     * @param array $params [
     * @var mixed $date_from Дата начала выборки, формат "Y-m-d"
     * @var mixed $date_to Дата конца выборки, формат "Y-m-d"
     * @var mixed $per_page Количество чеков на одной странице. По умолчанию принимает 100, максимальное значение — 1000.
     * @var mixed $page Номер страницы, по умолчанию принимает 1
     * ]
     *
     * @return object $response — response from API
     */
    public function getTransactions($params = array())
    {
        return $this->api->makeApiRequest('transactions.getTransactions', 'get', $params);
    }

    /**
     * transactions.getTransactionsWriteOffs: Списания по чекам
     * @link http://api.joinposter.com/#transactions-gettransactionswriteoffs
     *
     * @param array $params [
     * @var mixed $date_from Дата начала выборки, формат "Y-m-d"
     * @var mixed $date_to Дата конца выборки, формат "Y-m-d"
     * @var mixed $per_page Количество чеков на одной странице. По умолчанию принимает 100, максимальное значение — 1000.
     * @var mixed $page Номер страницы, по умолчанию принимает 1
     * ]
     *
     * @return object $response — response from API
     */
    public function getTransactionsWriteOffs($params = array())
    {
        return $this->api->makeApiRequest('transactions.getTransactionsWriteOffs', 'get', $params);
    }

    /**
     * transactions.getTransactionDishComposition: Состав проданной тех. карты
     * @link http://api.joinposter.com/#transactions-gettransactiondishcomposition
     *
     * @param array $params [
     * @var mixed $transaction_id Id чека
     * @var mixed $product_id Id тех. карты
     * @var mixed $modificator_id Id модификатора, по умолчанию принимает 0
     * ]
     *
     * @return object $response — response from API
     */
    public function getTransactionDishComposition($params = array())
    {
        return $this->api->makeApiRequest('transactions.getTransactionDishComposition', 'get', $params);
    }

    /**
     * transactions.createTransaction: Создание чека
     * @link http://api.joinposter.com/#transactions-createtransaction
     *
     * @param array $params [
     * @var mixed $spot_id Id заведения в котором нужно создать чек
     * @var mixed $spot_tablet_id Id терминала в котором нужно создать чек
     * @var mixed $table_id Id стола
     * @var mixed $user_id Id сотрудника
     * @var mixed $guests_count Количество гостей за столом
     * @var mixed $time Время операции в формате microtime, по умолчанию принимает текущее время
     * ]
     *
     * @return object $response — response from API
     */
    public function createTransaction($params = array())
    {
        return $this->api->makeApiRequest('transactions.createTransaction', 'post', $params);
    }

    /**
     * transactions.addTransactionProduct: Добавление товара в чек
     * @link http://api.joinposter.com/#transactions-addtransactionproduct
     *
     * @param array $params [
     * @var mixed $spot_id Id заведения
     * @var mixed $spot_tablet_id Id терминала
     * @var mixed $transaction_id Id чека
     * @var mixed $product_id Id товара или тех. карты
     * @var mixed $modificator_id Id модификатора товара, по умолчанию не передаётся
     * @var mixed $modification Модификации тех. карты, по умолчанию не передаётся
     * @var mixed $price Стоимость товара или тех. карты, если она должна отличаться от базовой, по умолчанию не передаётся
     * @var mixed $time Время операции в формате microtime, по умолчанию принимает текущее время
     * @var mixed $m Id модификации тех. карты
     * @var mixed $a Количество модификации тех. карты
     * ]
     *
     * @return object $response — response from API
     */
    public function addTransactionProduct($params = array())
    {
        return $this->api->makeApiRequest('transactions.addTransactionProduct', 'post', $params);
    }

    /**
     * transactions.changeTransactionProductCount: Изменение количества товара в чеке
     * @link http://api.joinposter.com/#transactions-changetransactionproductcount
     *
     * @param array $params [
     * @var mixed $spot_id Id заведения
     * @var mixed $spot_tablet_id Id терминала
     * @var mixed $transaction_id Id чека
     * @var mixed $product_id Id товара или тех. карты
     * @var mixed $modificator_id Id модификатора товара, по умолчанию не передаётся
     * @var mixed $modification Модификации тех. карты, по умолчанию не передаётся
     * @var mixed $count Количество товара или тех. карты
     * @var mixed $time Время операции в формате microtime, по умолчанию принимает текущее время
     * @var mixed $m Id модификации тех. карты
     * @var mixed $a Количество модификации тех. карты
     * ]
     *
     * @return object $response — response from API
     */
    public function changeTransactionProductCount($params = array())
    {
        return $this->api->makeApiRequest('transactions.changeTransactionProductCount', 'post', $params);
    }

    /**
     * transactions.removeTransactionProduct: Удалить товар из чека
     * @link http://api.joinposter.com/#transactions-removetransactionproduct
     *
     * @param array $params [
     * @var mixed $spot_id Id заведения
     * @var mixed $spot_tablet_id Id терминала
     * @var mixed $transaction_id Id чека
     * @var mixed $product_id Id товара или тех. карты
     * @var mixed $modificator_id Id модификатора товара, по умолчанию не передаётся
     * @var mixed $time Время операции в формате microtime, по умолчанию принимает текущее время
     * ]
     *
     * @return object $response — response from API
     */
    public function removeTransactionProduct($params = array())
    {
        return $this->api->makeApiRequest('transactions.removeTransactionProduct', 'post', $params);
    }

    /**
     * transactions.changeClient: Добавление клиента в чек
     * @link http://api.joinposter.com/#transactions-changeclient
     *
     * @param array $params [
     * @var mixed $spot_id Id заведения
     * @var mixed $spot_tablet_id Id терминала
     * @var mixed $transaction_id Id чека
     * @var mixed $client_id Id клиента
     * @var mixed $time Время операции в формате microtime, по умолчанию принимает текущее время
     * ]
     *
     * @return object $response — response from API
     */
    public function changeClient($params = array())
    {
        return $this->api->makeApiRequest('transactions.changeClient', 'post', $params);
    }

    /**
     * transactions.changeComment: Добавление комментария в чек
     * @link http://api.joinposter.com/#transactions-changecomment
     *
     * @param array $params [
     * @var mixed $spot_id Id заведения
     * @var mixed $spot_tablet_id Id терминала
     * @var mixed $transaction_id Id чека
     * @var mixed $comment Комментарий к чеку
     * @var mixed $time Время операции в формате microtime, по умолчанию принимает текущее время
     * ]
     *
     * @return object $response — response from API
     */
    public function changeComment($params = array())
    {
        return $this->api->makeApiRequest('transactions.changeComment', 'post', $params);
    }

    /**
     * transactions.changeRecipientFor54FZ: Указание адресата
     * @link http://api.joinposter.com/#transactions-changerecipientfor54fz
     *
     * @param array $params [
     * @var mixed $spot_id Id заведения
     * @var mixed $spot_tablet_id Id терминала
     * @var mixed $transaction_id Id чека
     * @var mixed $type Способ отправления копии фискального чека: email — через эл. почту, phone — через SMS (не передавать свойство, если нужно отвязать получателя)
     * @var mixed $contact Контакт получателя: эл. почта или номер телефона
     * @var mixed $time Время операции в формате microtime, по умолчанию принимает текущее время
     * ]
     *
     * @return object $response — response from API
     */
    public function changeRecipientFor54FZ($params = array())
    {
        return $this->api->makeApiRequest('transactions.changeRecipientFor54FZ', 'post', $params);
    }

    /**
     * transactions.closeTransaction: Закрытие чека
     * @link http://api.joinposter.com/#transactions-closetransaction
     *
     * @param array $params [
     * @var mixed $spot_id Id заведения
     * @var mixed $spot_tablet_id Id терминала
     * @var mixed $transaction_id Id чека
     * @var mixed $payed_cash Сумма оплаты наличным расчётом
     * @var mixed $payed_card Сумма оплаты безналичным расчётом
     * @var mixed $payed_cert Сумма оплаты сертификатом
     * @var mixed $reason Причина закрытия чека без оплаты: 1 — гость ушел, 2 — за счёт заведения, 3 — ошибка официанта. Обязательное поле для закрытия чека без оплаты, сумма всех оплат должна быть равна нулю. По умолчанию не передаётся.
     * @var mixed $print_fiscal Печатать фискального чека: 0 — не печатать, 1 — печатать. По умолчанию принимает 0.
     * @var mixed $time Время операции в формате microtime, по умолчанию принимает текущее время
     * ]
     *
     * @return object $response — response from API
     */
    public function closeTransaction($params = array())
    {
        return $this->api->makeApiRequest('transactions.closeTransaction', 'post', $params);
    }

    /**
     * transactions.removeTransaction: Удаление чека
     * @link http://api.joinposter.com/#transactions-removetransaction
     *
     * @param array $params [
     * @var mixed $spot_tablet_id Id терминала
     * @var mixed $transaction_id Id чека
     * @var mixed $user_id Id сотрудника
     * @var mixed $time Время операции в формате microtime, по умолчанию принимает текущее время
     * ]
     *
     * @return object $response — response from API
     */
    public function removeTransaction($params = array())
    {
        return $this->api->makeApiRequest('transactions.removeTransaction', 'post', $params);
    }

}


class IncomingOrdersAPI
{
    private $api;

    public function __construct(PosterApiCore $params)
    {
        $this->api = $params;
    }

    /**
     * incomingOrders.createIncomingOrder: Создание онлайн-заказа
     * @link http://api.joinposter.com/#incomingorders-createincomingorder
     *
     * @param array $params [
     * @var mixed $spot_id Id заведения в которое придет онлайн заказ
     * @var mixed $client_id Id клиента в Poster, по умолчанию не передаётся. Если id не указан, то Poster попробует найти клиента с таким же номером телефона и привяжет его к заказу. Если это новый клиент, то официант выберет для него группу и Poster создаст нового клиента.
     * @var mixed $first_name Имя клиента, по умолчанию не передаётся
     * @var mixed $last_name Фамилия клиента, по умолчанию не передаётся
     * @var mixed $phone Телефон клиента, по умолчанию не передаётся
     * @var mixed $email Эл. почта, по умолчанию не передаётся
     * @var mixed $sex Пол клиента: 0 — не указан, 1 — мужской, 2 — женский. По умолчанию не передаётся.
     * @var mixed $birthday Дата рождения клиента, формат `Y-m-d`. По умолчанию не передаётся.
     * @var mixed $address Адрес клиента, по умолчанию не передаётся
     * @var mixed $comment Комментарий к онлайн-заказу, по умолчанию не передаётся
     * @var mixed $products Список товаров
     * @var mixed $payment Информация об оплате, по умолчанию не передаётся
     * @var mixed $promotion Список акций которые нужно применить к заказу
     * @var mixed $product_id Id товара
     * @var mixed $modificator_id Id модификатора товара
     * @var mixed $count Обязательный параметр, кол-во товара которое нужно добавить а заказ
     * @var mixed $type Признак, что была предварительная оплата: 0 — не была, 1 — была. По умолчанию принимает 0.
     * @var mixed $sum Сумма оплаты в копейках
     * @var mixed $currency ISO код валюты оплаты, должен совпадать с валютой аккаунта, например: UAH — гривна, RUB — рубль, USD — доллар
     * @var mixed $id Обязательный параметр, id товара который нужно добавить в заказ как результат акции
     * @var mixed $involved_products Массив товаров которые учавствую в акции.
     * @var mixed $result_products Массив товаров которые являются результатом акции. Нужно передавать только в бонусных акциях.
     * @var mixed $modification Опциональный параметр, id модификации которую нужно добавить как результат акции
     * ]
     *
     * @return object $response — response from API
     */
    public function createIncomingOrder($params = array())
    {
        return $this->api->makeApiRequest('incomingOrders.createIncomingOrder', 'post', $params);
    }

    /**
     * incomingOrders.getIncomingOrders: Список онлайн-заказов
     * @link http://api.joinposter.com/#incomingorders-getincomingorders
     *
     * @param array $params [
     * @var mixed $status Фильтр по статусу заказа: 0 — новый, 1 — принят, 7 — отменён. По умолчанию не передаётся.
     * @var mixed $date_from Дата и время начала выборки, формат "Y-m-d H:i:s". По умолчанию не передаётся.
     * @var mixed $date_to Дата и время конца выборки, формат "Y-m-d H:i:s". По умолчанию не передаётся.
     * ]
     *
     * @return object $response — response from API
     */
    public function getIncomingOrders($params = array())
    {
        return $this->api->makeApiRequest('incomingOrders.getIncomingOrders', 'get', $params);
    }

    /**
     * incomingOrders.getIncomingOrder: Свойства онлайн-заказа
     * @link http://api.joinposter.com/#incomingorders-getincomingorder
     *
     * @param array $params [
     * @var mixed $incoming_order_id Id онлайн-заказа
     * ]
     *
     * @return object $response — response from API
     */
    public function getIncomingOrder($params = array())
    {
        return $this->api->makeApiRequest('incomingOrders.getIncomingOrder', 'get', $params);
    }

    /**
     * incomingOrders.getOwnIncomingOrders: Список онлайн-заказов со своего приложения
     * @link http://api.joinposter.com/#incomingorders-getownincomingorders
     *
     * @param array $params [
     * @var mixed $status Фильтр по статусу заказа: 0 — новый, 1 — принят, 7 — отменён. По умолчанию не передаётся.
     * @var mixed $date_from Дата и время начала выборки, формат "Y-m-d H:i:s". По умолчанию не передаётся.
     * @var mixed $date_to Дата и время конца выборки, формат "Y-m-d H:i:s". По умолчанию не передаётся.
     * ]
     *
     * @return object $response — response from API
     */
    public function getOwnIncomingOrders($params = array())
    {
        return $this->api->makeApiRequest('incomingOrders.getOwnIncomingOrders', 'get', $params);
    }

    /**
     * incomingOrders.getOwnIncomingOrder: Свойства онлайн-заказа со своего приложения
     * @link http://api.joinposter.com/#incomingorders-getownincomingorder
     *
     * @param array $params [
     * @var mixed $incoming_order_id Id онлайн-заказа
     * ]
     *
     * @return object $response — response from API
     */
    public function getOwnIncomingOrder($params = array())
    {
        return $this->api->makeApiRequest('incomingOrders.getOwnIncomingOrder', 'get', $params);
    }

    /**
     * incomingOrders.createReservation: Создание брони
     * @link http://api.joinposter.com/#incomingorders-createreservation
     *
     * @param array $params [
     * @var mixed $spot_id Обязательный параметр, id заведения в которое придет онлайн-заказ
     * @var mixed $type Тип заказа: 1 — онлайн-заказ, 2 — бронирование
     * @var mixed $table_id Обязательный параметр, id столика который бронируют
     * @var mixed $date_reservation Обязательный параметр, дата начала брони в формате `Y-m-d H:i:s`
     * @var mixed $duration Обязательный параметр, длительность брони в секундах. Должен быть не меньше 1800 секунд (пол часа).
     * @var mixed $client_id Id клиента в Poster, по умолчанию не передаётся. Если id не указан, то Poster попробует найти клиента с таким же номером телефона и привяжет его к заказу. Если это новый клиент, то официант выберет для него группу и Poster создаст нового клиента.
     * @var mixed $phone Телефон клиента, по умолчанию не передаётся
     * @var mixed $first_name Имя клиента, по умолчанию не передаётся
     * @var mixed $last_name Фамилия клиента, по умолчанию не передаётся
     * @var mixed $email Эл. почта, по умолчанию не передаётся
     * @var mixed $sex Пол клиента: 0 — не указан, 1 — мужской, 2 — женский. По умолчанию не передаётся.
     * @var mixed $birthday Дата рождения клиента, формат `Y-m-d`. По умолчанию не передаётся.
     * @var mixed $address Адрес клиента, по умолчанию не передаётся
     * @var mixed $comment Комментарий к брони, по умолчанию не передаётся
     * ]
     *
     * @return object $response — response from API
     */
    public function createReservation($params = array())
    {
        return $this->api->makeApiRequest('incomingOrders.createReservation', 'post', $params);
    }

    /**
     * incomingOrders.getReservations: Список броней
     * @link http://api.joinposter.com/#incomingorders-getreservations
     *
     * @param array $params [
     * @var mixed $status Фильтр по статусу брони: 0 — новый, 1 — принят, 7 — отменён. По умолчанию не передаётся.
     * @var mixed $date_from Дата и время начала выборки, формат `Y-m-d H:i:s`. По умолчанию не передаётся.
     * @var mixed $date_to Дата и время конца выборки, формат `Y-m-d H:i:s`. По умолчанию не передаётся.
     * ]
     *
     * @return object $response — response from API
     */
    public function getReservations($params = array())
    {
        return $this->api->makeApiRequest('incomingOrders.getReservations', 'get', $params);
    }

    /**
     * incomingOrders.getReservation: Свойства брони
     * @link http://api.joinposter.com/#incomingorders-getreservation
     *
     * @param array $params [
     * @var mixed $incoming_order_id Id брони
     * ]
     *
     * @return object $response — response from API
     */
    public function getReservation($params = array())
    {
        return $this->api->makeApiRequest('incomingOrders.getReservation', 'get', $params);
    }

    /**
     * incomingOrders.getOwnReservations: Список броней со своего приложения
     * @link http://api.joinposter.com/#incomingorders-getownreservations
     *
     * @param array $params [
     * @var mixed $status Фильтр по статусу брони: 0 — новый, 1 — принят, 7 — отменён. По умолчанию не передаётся.
     * @var mixed $date_from Дата и время начала выборки, формат `Y-m-d H:i:s`. По умолчанию не передаётся.
     * @var mixed $date_to Дата и время конца выборки, формат `Y-m-d H:i:s`. По умолчанию не передаётся.
     * ]
     *
     * @return object $response — response from API
     */
    public function getOwnReservations($params = array())
    {
        return $this->api->makeApiRequest('incomingOrders.getOwnReservations', 'get', $params);
    }

    /**
     * incomingOrders.getOwnReservation: Свойства брони со своего приложения
     * @link http://api.joinposter.com/#incomingorders-getownreservation
     *
     * @param array $params [
     * @var mixed $incoming_order_id Id брони
     * ]
     *
     * @return object $response — response from API
     */
    public function getOwnReservation($params = array())
    {
        return $this->api->makeApiRequest('incomingOrders.getOwnReservation', 'get', $params);
    }

}


class SpotsAPI
{
    private $api;

    public function __construct(PosterApiCore $params)
    {
        $this->api = $params;
    }

    /**
     * spots.getSpotTablesHalls: Список залов
     * @link http://api.joinposter.com/#spots-getspottableshalls
     *
     * @param array $params [
     * ]
     *
     * @return object $response — response from API
     */
    public function getSpotTablesHalls($params = array())
    {
        return $this->api->makeApiRequest('spots.getSpotTablesHalls', 'get', $params);
    }

    /**
     * spots.getTableHallTables: Список столов
     * @link http://api.joinposter.com/#spots-gettablehalltables
     *
     * @param array $params [
     * @var mixed $spot_id Id заведения, по умолчанию не передаётся
     * @var mixed $hall_id Id зала, по умолчанию не передаётся
     * @var mixed $without_deleted Признак, возвращать ли без удалённых столов: 0 — с удалёнными столами, 1 — без удалённых столов. По умолчанию принимает 0.
     * ]
     *
     * @return object $response — response from API
     */
    public function getTableHallTables($params = array())
    {
        return $this->api->makeApiRequest('spots.getTableHallTables', 'get', $params);
    }

}


class FinanceAPI
{
    private $api;

    public function __construct(PosterApiCore $params)
    {
        $this->api = $params;
    }

    /**
     * finance.getCashShifts: Список кассовых смен
     * @link http://api.joinposter.com/#finance-getcashshifts
     *
     * @param array $params [
     * @var mixed $spot_id Опциональный параметр, Id заведения по которому возвращать статистику
     * @var mixed $dateFrom Опциональный параметр, дата начала выборки в формате `Ymd`, включительно. По умолчанию дата месяц назад.
     * @var mixed $dateTo Опциональный параметр, дата конца выборки в формате `Ymd`, включительно. По умолчанию дата текущего дня.
     * ]
     *
     * @return object $response — response from API
     */
    public function getCashShifts($params = array())
    {
        return $this->api->makeApiRequest('finance.getCashShifts', 'get', $params);
    }

    /**
     * finance.getCashShift: Свойства кассовой смены
     * @link http://api.joinposter.com/#finance-getcashshift
     *
     * @param array $params [
     * @var mixed $cash_shift_id Обязательный параметр, id кассовой смены
     * ]
     *
     * @return object $response — response from API
     */
    public function getCashShift($params = array())
    {
        return $this->api->makeApiRequest('finance.getCashShift', 'get', $params);
    }

    /**
     * finance.openCashShift: Открытие кассовой смены
     * @link http://api.joinposter.com/#finance-opencashshift
     *
     * @param array $params [
     * @var mixed $spot_id Id заведения
     * @var mixed $user_id Id сотрудника
     * @var mixed $amount Сумма в кассе при открытии кассовой смены в гривнах\рублях
     * @var mixed $time Дата и время открытия кассовой смены в минутах в формате `Y-m-d H:i`
     * @var mixed $is_fiscal Признак, что транзакция открытия кассовой смены фискальная: 0 — не фискальная, 1 — фискальная. По умолчанию принимает 0.
     * ]
     *
     * @return object $response — response from API
     */
    public function openCashShift($params = array())
    {
        return $this->api->makeApiRequest('finance.openCashShift', 'post', $params);
    }

    /**
     * finance.closeCashShift: Закрытие кассовой смены
     * @link http://api.joinposter.com/#finance-closecashshift
     *
     * @param array $params [
     * @var mixed $cash_shift_id Id кассовой смены
     * @var mixed $user_id Id сотрудника
     * @var mixed $amount Сумма в кассе при закрытии кассовой смены в гривнах\рублях
     * @var mixed $time Дата и время закрытия кассовой смены с точностью до минут в формате `Y-m-d H:i`
     * @var mixed $is_fiscal Признак, что транзакция закрытия кассовой смены фискальная: 0 — не фискальная, 1 — фискальная. По умолчанию принимает 0.
     * @var mixed $comment Комментарий к кассовой смене. По умолчанию не передаётся.
     * ]
     *
     * @return object $response — response from API
     */
    public function closeCashShift($params = array())
    {
        return $this->api->makeApiRequest('finance.closeCashShift', 'post', $params);
    }

    /**
     * finance.getCashShiftTransactions: Список транзакций кассовой смены
     * @link http://api.joinposter.com/#finance-getcashshifttransactions
     *
     * @param array $params [
     * @var mixed $shift_id Обязательный параметр, id кассовой смены по которой возвращать транзкации
     * ]
     *
     * @return object $response — response from API
     */
    public function getCashShiftTransactions($params = array())
    {
        return $this->api->makeApiRequest('finance.getCashShiftTransactions', 'get', $params);
    }

    /**
     * finance.createCashShiftTransaction: Создание транзакции кассовой смены
     * @link http://api.joinposter.com/#finance-createcashshifttransaction
     *
     * @param array $params [
     * @var mixed $cash_shift_id Id кассовой смены
     * @var mixed $type_id Тип транзакции кассовой смены: 2 — доход, 3 — расход, 4 — инкассация.
     * @var mixed $category_id Id финансовой категории. Обязательное поле, если тип транзакции кассовой смены 2 или 3  и к заведению привязан счёт для наличных.
     * @var mixed $user_id Id сотрудника
     * @var mixed $amount Сумма транзакции кассовой смены
     * @var mixed $time Дата и время транзакции кассовой смены в формате `Y-m-d H:i`
     * @var mixed $is_fiscal Признак, что транзакция кассовой смены фискальная: 0 — не фискальная, 1 — фискальная. По умолчанию принимает 0.
     * @var mixed $comment Комментарий
     * ]
     *
     * @return object $response — response from API
     */
    public function createCashShiftTransaction($params = array())
    {
        return $this->api->makeApiRequest('finance.createCashShiftTransaction', 'post', $params);
    }

    /**
     * finance.updateCashShiftTransaction: Изменение свойств транзакции кассовой смены
     * @link http://api.joinposter.com/#finance-updatecashshifttransaction
     *
     * @param array $params [
     * @var mixed $cash_shift_transaction_id Id транзакции кассовой смены
     * @var mixed $type_id Тип транзакции кассовой смены: 1 — открытие, 2 — доход, 3 — расход, 4 — инкассация, 5 — закрытие. Типы 1 и 5 изменять нельзя. По умолчанию принимает предыдущее значение редактируемой транзакции кассовой смены.
     * @var mixed $category_id Id финансовой категории. Обязательное поле, если тип транзакции кассовой смены 2 или 3 и к заведению привязан счёт для наличных. По умолчанию принимает предыдущее значение редактируемой транзакции кассовой смены.
     * @var mixed $user_id Id сотрудника. По умолчанию принимает предыдущее значение редактируемой транзакции кассовой смены.
     * @var mixed $amount Сумма транзакции кассовой смены. По умолчанию принимает предыдущее значение редактируемой транзакции кассовой смены.
     * @var mixed $time Дата и время транзакции кассовой смены, формат "Y-m-d H:i". По умолчанию принимает предыдущее значение редактируемой транзакции кассовой смены.
     * @var mixed $is_fiscal Признак, что транзакция кассовой смены фискальная: 0 — не фискальная, 1 — фискальная. По умолчанию принимает предыдущее значение редактируемой транзакции кассовой смены.
     * @var mixed $comment Комментарий. По умолчанию принимает предыдущее значение редактируемой транзакции кассовой смены.
     * ]
     *
     * @return object $response — response from API
     */
    public function updateCashShiftTransaction($params = array())
    {
        return $this->api->makeApiRequest('finance.updateCashShiftTransaction', 'post', $params);
    }

    /**
     * finance.removeCashShiftTransaction: Удаление транзакции кассовой смены
     * @link http://api.joinposter.com/#finance-removecashshifttransaction
     *
     * @param array $params [
     * @var mixed $cash_shift_transaction_id Id транзакции кассовой смены
     * ]
     *
     * @return object $response — response from API
     */
    public function removeCashShiftTransaction($params = array())
    {
        return $this->api->makeApiRequest('finance.removeCashShiftTransaction', 'post', $params);
    }

    /**
     * finance.getTransactions: Получить все транзакции
     * @link http://api.joinposter.com/#finance-gettransactions
     *
     * @param array $params [
     * @var mixed $account_id Опциональный параметр, id счета, по умолчанию по всем счетам
     * @var mixed $category_id Опциональный параметр, id категории, по умолчанию по всем категориям
     * @var mixed $dateFrom Опциональный параметр, дата начала выборки в формате `Ymd`, включительно. По умолчанию дата месяц назад.
     * @var mixed $dateTo Опциональный параметр, дата конца выборки в формате `Ymd`, включительно. По умолчанию дата текущего дня.
     * @var mixed $pretty Опциональный параметр, возвращать данные в человекочитаемом формате. Все системные транзакии будут сведены к приходным или расходным транзакциям.
     * ]
     *
     * @return object $response — response from API
     */
    public function getTransactions($params = array())
    {
        return $this->api->makeApiRequest('finance.getTransactions', 'get', $params);
    }

    /**
     * finance.createTransactions: Создание новой транзакции
     * @link http://api.joinposter.com/#finance-createtransactions
     *
     * @param array $params [
     * @var mixed $id Id группы
     * @var mixed $type Тип транзакции: 0 — расход, 1 — доход, 2 — перевод
     * @var mixed $category id категории
     * @var mixed $user_id id пользователя
     * @var mixed $date Дата дата добавления в формате `dmY`
     * ]
     *
     * @return object $response — response from API
     */
    public function createTransactions($params = array())
    {
        return $this->api->makeApiRequest('finance.createTransactions', 'post', $params);
    }

    /**
     * finance.updateTransactions: Изменение транзакции
     * @link http://api.joinposter.com/#finance-updatetransactions
     *
     * @param array $params [
     * @var mixed $transaction_id Id транзакции для обновления
     * @var mixed $type Тип транзакции: 0 — расход, 1 — доход, 2 — перевод
     * @var mixed $category id категории
     * @var mixed $user_id id пользователя
     * @var mixed $date Дата дата добавления в формате `Ymd`
     * ]
     *
     * @return object $response — response from API
     */
    public function updateTransactions($params = array())
    {
        return $this->api->makeApiRequest('finance.updateTransactions', 'post', $params);
    }

    /**
     * finance.getAccounts: Получить счета
     * @link http://api.joinposter.com/#finance-getaccounts
     *
     * @param array $params [
     * @var mixed $type Тип счета: 1 — безналичный, 2 — банковская карта, 3 — наличные. По умолчанию все счета.
     * ]
     *
     * @return object $response — response from API
     */
    public function getAccounts($params = array())
    {
        return $this->api->makeApiRequest('finance.getAccounts', 'get', $params);
    }

    /**
     * finance.createAccount: Создание нового счета
     * @link http://api.joinposter.com/#finance-createaccount
     *
     * @param array $params [
     * @var mixed $account_name Название счета
     * @var mixed $type Тип счета: 1 — безналичный, 2 — банковская карта, 3 — наличные
     * @var mixed $balance_start Остаток денег на счете на момент создания, в гривнах\рублях
     * @var mixed $currency_id Id валюты в Poster: 1 — гривна, 2 — рубль, 3 — доллар, 4 — евро, 5 — тенге, 6 — лари, 7 — бат, 8 — armenia dram
     * ]
     *
     * @return object $response — response from API
     */
    public function createAccount($params = array())
    {
        return $this->api->makeApiRequest('finance.createAccount', 'post', $params);
    }

    /**
     * finance.updateAccount: Изменение счета
     * @link http://api.joinposter.com/#finance-updateaccount
     *
     * @param array $params [
     * @var mixed $account_id id счета
     * @var mixed $account_name Название счета
     * @var mixed $type Тип счета: 1 — безналичный, 2 — банковская карта, 3 — наличные
     * @var mixed $balance_start Остаток денег на счете на момент создания, в гривнах\рублях
     * @var mixed $currency_id Id валюты в Poster: 1 — гривна, 2 — рубль, 3 — доллар, 4 — евро, 5 — тенге, 6 — лари, 7 — бат, 8 — armenia dram
     * ]
     *
     * @return object $response — response from API
     */
    public function updateAccount($params = array())
    {
        return $this->api->makeApiRequest('finance.updateAccount', 'post', $params);
    }

    /**
     * finance.getCategories: Получить список категорий счетов
     * @link http://api.joinposter.com/#finance-getcategories
     *
     * @param array $params [
     * ]
     *
     * @return object $response — response from API
     */
    public function getCategories($params = array())
    {
        return $this->api->makeApiRequest('finance.getCategories', 'get', $params);
    }

    /**
     * finance.createCategory: Создание новой финансовой категории
     * @link http://api.joinposter.com/#finance-createcategory
     *
     * @param array $params [
     * @var mixed $category_name Название категории
     * @var mixed $category_parent id родительской категории, если 0 то текущая категория отобразиться на самом верхнем уровне
     * @var mixed $operations_in Допустимы ли транзакции типа доходы: 1 — допустимы, 0 — нет
     * @var mixed $operations_out Допустимы ли транзакции типа расходы: 1 — допустимы, 0 — нет
     * ]
     *
     * @return object $response — response from API
     */
    public function createCategory($params = array())
    {
        return $this->api->makeApiRequest('finance.createCategory', 'post', $params);
    }

    /**
     * finance.updateCategory: Изменение финансовой категории
     * @link http://api.joinposter.com/#finance-updatecategory
     *
     * @param array $params [
     * @var mixed $category_id Id изменяемой категории
     * @var mixed $category_name Название категории
     * @var mixed $category_parent id родительской категории, если 0 то текущая категория отобразиться на самом верхнем уровне
     * @var mixed $operations_in Допустимы ли транзакции типа доходы: 1 — допустимы, 0 — нет
     * @var mixed $operations_out Допустимы ли транзакции типа расходы: 1 — допустимы, 0 — нет
     * ]
     *
     * @return object $response — response from API
     */
    public function updateCategory($params = array())
    {
        return $this->api->makeApiRequest('finance.updateCategory', 'post', $params);
    }

    /**
     * finance.getReport: Отчет по категориям
     * @link http://api.joinposter.com/#finance-getreport
     *
     * @param array $params [
     * @var mixed $dateFrom Опциональный параметр, дата начала выборки в формате `Ymd`, включительно. По умолчанию дата месяц назад.
     * @var mixed $dateTo Опциональный параметр, дата конца выборки в формате `Ymd`, включительно. По умолчанию дата текущего дня.
     * @var mixed $account_id Опциональный параметр, id счета по которому возвращать отчет. По умолчанию по всем.
     * @var mixed $period Опциональный параметр, период выборки: 1 — годам, 2 — кварталам, 3 — месяцам, 4 — неделям, 5 — дням. По умолчанию 3 — по месяцам.
     * ]
     *
     * @return object $response — response from API
     */
    public function getReport($params = array())
    {
        return $this->api->makeApiRequest('finance.getReport', 'get', $params);
    }

    /**
     * finance.getTaxes: Список налогов
     * @link http://api.joinposter.com/#finance-gettaxes
     *
     * @param array $params [
     * ]
     *
     * @return object $response — response from API
     */
    public function getTaxes($params = array())
    {
        return $this->api->makeApiRequest('finance.getTaxes', 'get', $params);
    }

    /**
     * finance.getTax: Свойства налога
     * @link http://api.joinposter.com/#finance-gettax
     *
     * @param array $params [
     * @var mixed $tax_id Id налога
     * ]
     *
     * @return object $response — response from API
     */
    public function getTax($params = array())
    {
        return $this->api->makeApiRequest('finance.getTax', 'get', $params);
    }

    /**
     * finance.createTax: Создание налога
     * @link http://api.joinposter.com/#finance-createtax
     *
     * @param array $params [
     * @var mixed $name Название налога
     * @var mixed $value Процент налога
     * @var mixed $type Тип налога: 1 — налог с продаж, 2 — налог с оборота, 3 — НДС, 4 — без налога
     * @var mixed $fiscal Фискальность налога: 0 — не фискальный, 1 — фискальный. По умолчанию принимает 0.
     * @var mixed $fiscal_program Номер программы на фискальном регистраторе. По умолчанию принимает 0.
     * ]
     *
     * @return object $response — response from API
     */
    public function createTax($params = array())
    {
        return $this->api->makeApiRequest('finance.createTax', 'post', $params);
    }

    /**
     * finance.updateTax: Изменение свойств налога
     * @link http://api.joinposter.com/#finance-updatetax
     *
     * @param array $params [
     * @var mixed $tax_id Id налога
     * @var mixed $name Название налога
     * @var mixed $value Процент налога
     * @var mixed $type Тип налога: 1 — налог с продаж, 2 — налог с оборота, 3 — НДС, 4 — без налога
     * @var mixed $fiscal Фискальность налога: 0 — не фискальный, 1 — фискальный. По умолчанию принимает 0.
     * @var mixed $fiscal_program Номер программы на фискальном регистраторе. По умолчанию принимает 0.
     * ]
     *
     * @return object $response — response from API
     */
    public function updateTax($params = array())
    {
        return $this->api->makeApiRequest('finance.updateTax', 'post', $params);
    }

    /**
     * finance.removeTax: Удаление налога
     * @link http://api.joinposter.com/#finance-removetax
     *
     * @param array $params [
     * @var mixed $tax_id Id налога
     * ]
     *
     * @return object $response — response from API
     */
    public function removeTax($params = array())
    {
        return $this->api->makeApiRequest('finance.removeTax', 'post', $params);
    }

}


class AccessAPI
{
    private $api;

    public function __construct(PosterApiCore $params)
    {
        $this->api = $params;
    }

    /**
     * access.getEmployees: Список сотрудников
     * @link http://api.joinposter.com/#access-getemployees
     *
     * @param array $params [
     * ]
     *
     * @return object $response — response from API
     */
    public function getEmployees($params = array())
    {
        return $this->api->makeApiRequest('access.getEmployees', 'get', $params);
    }

    /**
     * access.createEmployee: Создание сотрудника
     * @link http://api.joinposter.com/#access-createemployee
     *
     * @param array $params [
     * @var mixed $name Имя и фамилия сотрудника
     * @var mixed $user_type Роль сотрудника: 0 — официант, 2 — маркетолог, 3 — кладовщик, 4 — администратор зала
     * @var mixed $pos_pass Pin-код официанта или администратора заведения для авторизации на терминале
     * @var mixed $login Логин сотрудника для доступа к системе администрирования, нужен только для маркетолога и кладовщика
     * @var mixed $pass Пароль сотрудника для доступа к системе администрирования, нужен только для маркетолога и кладовщика
     * ]
     *
     * @return object $response — response from API
     */
    public function createEmployee($params = array())
    {
        return $this->api->makeApiRequest('access.createEmployee', 'post', $params);
    }

    /**
     * access.updateEmployee: Изменение свойств сотрудника
     * @link http://api.joinposter.com/#access-updateemployee
     *
     * @param array $params [
     * @var mixed $user_id Id сотрудника
     * @var mixed $name Имя и фамилия сотрудника
     * @var mixed $user_type Роль сотрудника: 0 — официант, 2 — маркетолог, 3 — кладовщик, 4 — администратор зала
     * @var mixed $pos_pass Pin-код официанта или администратора заведения для авторизации на терминале
     * @var mixed $login Логин сотрудника для доступа к системе администрирования, нужен только для маркетолога и кладовщика
     * @var mixed $pass Пароль сотрудника для доступа к системе администрирования, нужен только для маркетолога и кладовщика
     * ]
     *
     * @return object $response — response from API
     */
    public function updateEmployee($params = array())
    {
        return $this->api->makeApiRequest('access.updateEmployee', 'post', $params);
    }

    /**
     * access.getTablets: Список терминалов
     * @link http://api.joinposter.com/#access-gettablets
     *
     * @param array $params [
     * ]
     *
     * @return object $response — response from API
     */
    public function getTablets($params = array())
    {
        return $this->api->makeApiRequest('access.getTablets', 'get', $params);
    }

    /**
     * access.createTablet: Создание терминала
     * @link http://api.joinposter.com/#access-createtablet
     *
     * @param array $params [
     * @var mixed $spot_id Id заведения к которому будет относиться терминал
     * @var mixed $spot_tablet_name Название терминала
     * @var mixed $spot_code Пароль терминала
     * ]
     *
     * @return object $response — response from API
     */
    public function createTablet($params = array())
    {
        return $this->api->makeApiRequest('access.createTablet', 'post', $params);
    }

    /**
     * access.updateTablet: Изменение свойств терминала
     * @link http://api.joinposter.com/#access-updatetablet
     *
     * @param array $params [
     * @var mixed $spot_tablet_id Id терминала
     * @var mixed $spot_id Id заведения к которому относится терминал
     * @var mixed $spot_tablet_name Название терминала
     * @var mixed $spot_code Пароль терминала
     * ]
     *
     * @return object $response — response from API
     */
    public function updateTablet($params = array())
    {
        return $this->api->makeApiRequest('access.updateTablet', 'post', $params);
    }

    /**
     * access.getSpots: Список заведений
     * @link http://api.joinposter.com/#access-getspots
     *
     * @param array $params [
     * @var mixed $1c    Позволяет вернуть в ответе id заведения в системе 1С. В качестве значения необходимо передать true. По умолчанию не передаётся.
     * ]
     *
     * @return object $response — response from API
     */
    public function getSpots($params = array())
    {
        return $this->api->makeApiRequest('access.getSpots', 'get', $params);
    }

    /**
     * access.createSpot: Создание заведения
     * @link http://api.joinposter.com/#access-createspot
     *
     * @param array $params [
     * @var mixed $spot_name Название заведения
     * ]
     *
     * @return object $response — response from API
     */
    public function createSpot($params = array())
    {
        return $this->api->makeApiRequest('access.createSpot', 'post', $params);
    }

    /**
     * access.updateSpot: Изменение свойств заведения
     * @link http://api.joinposter.com/#access-updatespot
     *
     * @param array $params [
     * @var mixed $spot_id Id заведения
     * @var mixed $spot_name Название заведения
     * ]
     *
     * @return object $response — response from API
     */
    public function updateSpot($params = array())
    {
        return $this->api->makeApiRequest('access.updateSpot', 'post', $params);
    }

}


class PaymentsAPI
{
    private $api;

    public function __construct(PosterApiCore $params)
    {
        $this->api = $params;
    }

    /**
     * payments.addTransactionPayment: уведомление об оплате клиентского заказа
     * @link http://api.joinposter.com/#payments-addtransactionpayment
     *
     * @param array $params [
     * @var mixed $type Ключевое имя платежной системы, которое отправляет запрос о поступившей оплате. Под систему заводится отдельное приложение в системе Poster, где и указывается данное имя.
     * @var mixed $merchant_id Идентификатор клиента Poster во внутренней базе платежной системы
     * @var mixed $transaction_id id заказа, который был оплачен через платежную систему
     * @var mixed $payed_sum Сумма заказа, которую оплатил посетитель (в гривнах/рублях)
     * @var mixed $credited_sum Сумма, которая была зачислена на р/с клиента Poster (в гривнах/рублях). Это сумма заказа минус комиссия эквайринга.
     * @var mixed $sign Подпись запроса, является md5 хешем от строки, где через двоеточие соединены значения следующих переменных: type, merchant_id, transaction_id, payed_sum, credited_sum, application_secret.
     * ]
     *
     * @return object $response — response from API
     */
    public function addTransactionPayment($params = array())
    {
        return $this->api->makeApiRequest('payments.addTransactionPayment', 'post', $params);
    }

    /**
     * payments.getOpenTransactionsOnTable: список открытых чеков на столике
     * @link http://api.joinposter.com/#payments-getopentransactionsontable
     *
     * @param array $params [
     * @var mixed $type Ключевое имя платежной системы, которое отправляет запрос. Под систему заводится отдельное приложение в системе Poster, где и указывается данное имя.
     * @var mixed $merchant_id Идентификатор клиента Poster во внутренней базе платежной системы
     * @var mixed $table_id Идентификатор столика, для которого нужно получить открытые заказы
     * @var mixed $sign Подпись запроса, является md5 хешем от строки, где через двоеточие соединены значения следующих переменных: type, merchant_id, table_id, application_secret.
     * ]
     *
     * @return object $response — response from API
     */
    public function getOpenTransactionsOnTable($params = array())
    {
        return $this->api->makeApiRequest('payments.getOpenTransactionsOnTable', 'get', $params);
    }

}


class FranchiseAPI
{
    private $api;

    public function __construct(PosterApiCore $params)
    {
        $this->api = $params;
    }

    /**
     * franchise.getTransactionsByClientId: Список транзакций клиента
     * @link http://api.joinposter.com/#franchise-gettransactionsbyclientid
     *
     * @param array $params [
     * @var mixed $client_id Id клиента в мастер-аккаунте.
     * @var mixed $date_from Опциональный параметр. Дата начала выборки (Ymd), включительно. По умолчанию дата месяц назад.
     * @var mixed $date_to Опциональный параметр. Дата конца выборки (Ymd), включительно. По умолчанию дата текущего дня.
     * ]
     *
     * @return object $response — response from API
     */
    public function getTransactionsByClientId($params = array())
    {
        return $this->api->makeApiRequest('franchise.getTransactionsByClientId', 'get', $params);
    }

}


class SettingsAPI
{
    private $api;

    public function __construct(PosterApiCore $params)
    {
        $this->api = $params;
    }

    /**
     * settings.getCurrency: Валюта аккаунта
     * @link http://api.joinposter.com/#settings-getcurrency
     *
     * @param array $params [
     * ]
     *
     * @return object $response — response from API
     */
    public function getCurrency($params = array())
    {
        return $this->api->makeApiRequest('settings.getCurrency', 'get', $params);
    }

    /**
     * settings.getCompanyName: Название аккаунта
     * @link http://api.joinposter.com/#settings-getcompanyname
     *
     * @param array $params [
     * ]
     *
     * @return object $response — response from API
     */
    public function getCompanyName($params = array())
    {
        return $this->api->makeApiRequest('settings.getCompanyName', 'get', $params);
    }

    /**
     * settings.getCompanyType: Тип заведения
     * @link http://api.joinposter.com/#settings-getcompanytype
     *
     * @param array $params [
     * ]
     *
     * @return object $response — response from API
     */
    public function getCompanyType($params = array())
    {
        return $this->api->makeApiRequest('settings.getCompanyType', 'get', $params);
    }

    /**
     * settings.getTimeZones: Часовой пояс аккаунта
     * @link http://api.joinposter.com/#settings-gettimezones
     *
     * @param array $params [
     * ]
     *
     * @return object $response — response from API
     */
    public function getTimeZones($params = array())
    {
        return $this->api->makeApiRequest('settings.getTimeZones', 'get', $params);
    }

    /**
     * settings.getLanguage: Язык аккаунта
     * @link http://api.joinposter.com/#settings-getlanguage
     *
     * @param array $params [
     * ]
     *
     * @return object $response — response from API
     */
    public function getLanguage($params = array())
    {
        return $this->api->makeApiRequest('settings.getLanguage', 'get', $params);
    }

    /**
     * settings.getLogo: Логотип компании
     * @link http://api.joinposter.com/#settings-getlogo
     *
     * @param array $params [
     * ]
     *
     * @return object $response — response from API
     */
    public function getLogo($params = array())
    {
        return $this->api->makeApiRequest('settings.getLogo', 'get', $params);
    }

    /**
     * settings.getAllSettings: Настройки аккаунта
     * @link http://api.joinposter.com/#settings-getallsettings
     *
     * @param array $params [
     * ]
     *
     * @return object $response — response from API
     */
    public function getAllSettings($params = array())
    {
        return $this->api->makeApiRequest('settings.getAllSettings', 'get', $params);
    }

    /**
     * settings.changeSettings: Изменение свойств настроек клиентского аккаунта
     * @link http://api.joinposter.com/#settings-changesettings
     *
     * @param array $params [
     * @var mixed $uses_taxes Признак, использовать ли налоги: 0 — не использовать, 1 — использовать. По умолчанию не передаётся.
     * @var mixed $uses_cash_shifts Признак, использовать ли кассовые смены: 0 — не использовать, 1 — использовать. По умолчанию не передаётся.
     * @var mixed $uses_fiscality Признак, использовать ли фискализацию: 0 — не использовать, 1 — использовать. По умолчанию не передаётся.
     * @var mixed $print_fiscal_by_default Признак, печатать ли фискальный чек по умолчанию: 0 — не печатать, 1 — печатать. По умолчанию не передаётся.
     * @var mixed $timezones Часовой пояс. По умолчанию не передаётся.
     * ]
     *
     * @return object $response — response from API
     */
    public function changeSettings($params = array())
    {
        return $this->api->makeApiRequest('settings.changeSettings', 'post', $params);
    }

}


class ApplicationAPI
{
    private $api;

    public function __construct(PosterApiCore $params)
    {
        $this->api = $params;
    }

    /**
     * application.setEntityExtras: Изменение дополнительных данных сущности
     * @link http://api.joinposter.com/#application-setentityextras
     *
     * @param array $params [
     * @var mixed $entity_type Обязательный параметр, тип сущности в которую записываются параметры. Доступные варианты сущностей описаны ниже.
     * @var mixed $entity_id Обязательный параметр, id сущности в которую будет записан объект `extras`. Например, для метода `access.getTablets` — `tablet_id`.
     * @var mixed $extras Обязательный параметр, объект поля которого будут записаны в сущность
     * ]
     *
     * @return object $response — response from API
     */
    public function setEntityExtras($params = array())
    {
        return $this->api->makeApiRequest('application.setEntityExtras', 'post', $params);
    }

}
