<?include('api_header.php')?>
        <div class="api_content">
            <h2>getOrderInfo</h2>
            <div class="method_desc">
               Возвращает информацию о заказе,либо статус заказа,если передан параметр onlyStatus. 
            </div>
             <h2>URL для запроса</h2>
            <div class="url_ex">
                http://www.autobody.ru/api/getOrderInfo/
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
                    <td>id</td>
                    <td>обязательный</td>
                    <td>1</td>
                    <td>ID заказа</td>
                </tr>
                <tr>
                    <td>onlyStatus</td>
                    <td>необязательный</td>
                    <td>Y</td>
                    <td>Вернуть только статус заказа</td>
                </tr>
            </table>
            
            <h2>Пример запроса методом GET</h2>
            
            <div class="code_example">
                <code>http://www.autobody.ru/api/getOrderInfo/?token=123456789qwertyuiopasdfghjklzxcv&id=1&onlyStatus=Y</code>
            </div>
            
            <h2>Пример запроса методом POST на языке PHP</h2>
            
            <div class="code_example">
            <pre>
    $postdata = http_build_query(
        array(
           'token' => '123456789qwertyuiopasdfghjklzxcv',
            'id' => '1',
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
    $result = file_get_contents('http://www.autobody.ru/api/getOrderInfo/', false, $context);
    
    print_r(json_decode($result,true));
            </pre>
            </div>
            
            <h2>Пример ответа</h2>
            
             <div class="code_example">
                <pre>
Array
(
    [order_id] => 1
    [payed] => N
    [canceled] => N
    [price] => 10503.42
    [currency] => RUR
    [price_delivery] => 0.00
    [create_date] => 30.10.2014 18:04:04
    [user_comment] => comment
    [tracking_number] => 
    [delivery_type] => Самовывоз
    [payment_system] => Наличные
    [items_in_order] => Array
        (
            [0] => Array
                (
                    [item_id] => 211029
                    [item_name] => A 155 ФАРА ЛЕВ П/КОРРЕКТОР
                    [price] => 49.30
                    [currency] => USD
                    [quantity] => 4.00
                )

            [1] => Array
                (
                    [item_id] => 211624
                    [item_name] => E28 РЕШЕТКА РАДИАТОРА ЦЕНТРАЛ С ХРОМ
                    [price] => 12.70
                    [currency] => USD
                    [quantity] => 3.00
                )

            [2] => Array
                (
                    [item_id] => 211628
                    [item_name] => E28 КРЫЛО ПЕРЕДН ПРАВ С ОТВ П/ПОВТОРИТЕЛЬ
                    [price] => 45.54
                    [currency] => USD
                    [quantity] => 1.00
                )

        )

)
                </pre>
             </div>
             
             <h2>Пример ответа с флагом onlyStatus=Y</h2>
             
             <div class="code_example">
                <pre>
Array
(
    [orderStatus] => Заказ поступил в обработку
)
                </pre>
             </div>
            
        </div>

<?include('api_footer.php')?>