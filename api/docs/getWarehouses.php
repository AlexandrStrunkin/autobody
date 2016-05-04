<?include('api_header.php')?>
<div class="api_content">
    <h2>getWarehouses</h2>
    <div class="method_desc">
        Возвращает список доступных складов. 
    </div>
    <h2>URL для запроса</h2>
    <div class="url_ex">
        http://www.autobody.ru/api/getWarehouses/
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
    </table>
    <h2>Пример запроса методом GET</h2>
    <div class="code_example">
        <code>http://www.autobody.ru/api/getWarehouses/?token=123456789qwertyuiopasdfghjklzxcv</code>
    </div>
    <h2>Пример запроса методом POST на языке PHP</h2>
    <div class="code_example">
            <pre>
    $postdata = http_build_query(
        array(
           'token' => '123456789qwertyuiopasdfghjklzxcv',
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
    $result = file_get_contents('http://www.autobody.ru/api/getWarehouses/', false, $context);
    
    print_r(json_decode($result,true));
            </pre>
    </div>
    <h2>Пример ответа</h2>
    <div class="code_example">
                <pre>
Array
(
    [warehouses] => Array
        (
            [0] => Array
                (
                    [ID] => 1
                    [~ID] => 1
                    [TITLE] => Москва-Печатники
                    [~TITLE] => Москва-Печатники
                )

            [1] => Array
                (
                    [ID] => 2
                    [~ID] => 2
                    [TITLE] => Москва-Дмитровка
                    [~TITLE] => Москва-Дмитровка
                )

            [2] => Array
                (
                    [ID] => 3
                    [~ID] => 3
                    [TITLE] => Москва-Капотня
                    [~TITLE] => Москва-Капотня
                )

            [3] => Array
                (
                    [ID] => 4
                    [~ID] => 4
                    [TITLE] => Омск
                    [~TITLE] => Омск
                )

        )

)
                </pre>
    </div>
    <div class="important">
                <span>важно</span>
                <span>Обратите внимание,что ответ от метода приходит в формате JSON,но ответ в примере, для лучшего восприятия,приведен в виде ассоциативного массива.</span>
            </div>
</div>
<?include('api_footer.php')?>