<?include('api_header.php')?>
<div class="api_content">
    <h2>getOrdersList</h2>
    <div class="method_desc">
        Возвращает список заказов для пользователя с переданным token. 
    </div>
    <h2>URL для запроса</h2>
    <div class="url_ex">
        http://www.autobody.ru/api/getOrdersList/
    </div>
    <h2>Формат ответа</h2>
    <div class="resp_ex">
        JSON
    </div>
    <h2>Параметры</h2>
    <table class="params_table">
                <tr>
                    <th>Название</th>
                    <th></th>
                    <th>Пример значения</th>
                    <th>Описание</th>
                </tr>
                <tr>
                    <td>token</td>
                    <td>обязательный</td>
                    <td>123456789qwertyuiopasdfghjklzxcv</td>
                    <td>Уникальный 32-х значный ключ-идентификатор для доступа к API</td>
                </tr>
                <tr>
                    <td>count</td>
                    <td>необязательный</td>
                    <td>1</td>
                    <td>Количество заказов,которое будет возвращено.Если данный параметр не передан,то будет возвращен только последний заказ.</td>
                </tr>
            </table>
    <h2>Пример запроса методом GET</h2>
    <div class="code_example">
        <code>http://www.autobody.ru/api/getOrdersList/?token=123456789qwertyuiopasdfghjklzxcv&count=9</code>
    </div>
    <h2>Пример запроса методом POST на языке PHP</h2>
                <div class="code_example">
            <pre>
    $postdata = http_build_query(
        array(
           'token' => '123456789qwertyuiopasdfghjklzxcv',
            'count' => '9',
       )
    );

    $opts = array('http' =>
       array(
           'method'  => 'POST',
           'header'  => 'Content-type: application/x-www-form-urlencoded',
           'content' => $postdata
      )
    );
    
    $context  = stream_context_create($opts);
    $result = file_get_contents('http://www.autobody.ru/api/getOrdersList/', false, $context);
    
    print_r(json_decode($result,true));
            </pre>
            </div>
            <h2>Пример ответа</h2>
              <div class="code_example">
                <pre>
{
    "order_id":"1",
    "payed":"N",
    "canceled":"N",
    "price":"5531.46",
    "currency":"RUR",
    "price_delivery":"0.00",
    "create_date":"30.10.2014 13:22:46",
    "user_comment":"test comment",
    "tracking_number":null,
    "delivery_type":"По Москве (заказ до 30000 руб.)",
    "payment_system":"Наличные",
    "items_in_order":[
        {
            "item_id":"211029",
            "item_name":"A 155 ФАРА ЛЕВ П/КОРРЕКТОР",
            "price":"49.30",
            "currency":"USD",
            "quantity":"3.00"
        }
    ]
}
                </pre>
              </div>
</div>
<?include('api_footer.php')?>