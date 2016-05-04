<?include('api_header.php')?>
        <div class="api_content">
            <h2>filterItemsByName</h2>
            <div class="method_desc">
               Возвращает информацию о товарах,в названии которых встречается поисковый запрос,переданный от пользователя. 
            </div>
            <h2>URL для запроса</h2>
            <div class="url_ex">
                http://www.autobody.ru/api/filterItemsByName/
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
                    <td>name</td>
                    <td>обязательный</td>
                    <td>audi</td>
                    <td>поисковый запрос</td>
                </tr>
                <tr>
                    <td>quantity</td>
                    <td>обязательный</td>
                    <td>all</td>
                    <td>Количество записей,возвращаемых сервисом</td>
                </tr>
                <tr>
                    <td>ord_param</td>
                    <td>необязательный</td>
                    <td>name</td>
                    <td>Параметр,по которому будет осуществляться сортировка</td>
                </tr>
                <tr>
                    <td>dir</td>
                    <td>необязательный</td>
                    <td>asc</td>
                    <td>Направление сортировки</td>
                </tr>
            </table>

            <h2>Возможные значения параметра quantity</h2>

            <table class="descr_table">
                <colspan>
                    <col width="200">
                    <col width="500">
                </colspan>
                <tr>
                    <th>Значение</th>
                    <th>Описание</th>
                </tr>
                <tr>
                    <td>all</td>
                    <td>Возвращает все записи,которые совпадают с введенным запросом.</td>
                </tr>
                <tr>
                    <td>число</td>
                    <td>Возвращает заданное число записей</td>
                </tr>
            </table>

            <h2>Возможные значения параметра ord_param</h2>

            <table class="descr_table">
                <colspan>
                    <col width="200">
                    <col width="500">
                </colspan>
                <tr>
                    <th>Значение</th>
                    <th>Описание</th>
                </tr>
                <tr>
                    <td>name</td>
                    <td>Сортировать по имени</td>
                </tr>
                <tr>
                    <td>code</td>
                    <td>Сортировать по артикулу</td>
                </tr>
                <tr>
                    <td>oem</td>
                    <td>Сортировать по OEM</td>
                </tr>
                <tr>
                    <td>firm</td>
                    <td>Сортировать по производителю</td>
                </tr>
                <tr>
                    <td>price</td>
                    <td>Сортировать по цене</td>
                </tr>
            </table>

            <h2>Возможные значения параметра dir</h2>

            <table class="descr_table">
                <colspan>
                    <col width="200">
                    <col width="500">
                </colspan>
                <tr>
                    <th>Значение</th>
                    <th>Описание</th>
                </tr>
                <tr>
                    <td>asc</td>
                    <td>Сортировать по возрастанию</td>
                </tr>
                <tr>
                    <td>desc</td>
                    <td>Сортировать по убыванию</td>
                </tr>
            </table>
            
            <h2>Пример запроса методом GET</h2>
            
            <div class="code_example">
                <code>http://www.autobody.ru/api/filterItemsByName/?token=123456789qwertyuiopasdfghjklzxcv&name=DEDRA&quantity=all</code>
            </div>
            
            <h2>Пример запроса методом POST на языке PHP</h2>
            
            <div class="code_example">
                <pre>
    $postdata = http_build_query(
        array(
           'token' => '123456789qwertyuiopasdfghjklzxcv',
            'name' => 'DEDRA',
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
    $result = file_get_contents('http://www.autobody.ru/api/filterItemsByName/', false, $context);
    
    print_r(json_decode($result,true));
    </pre>
            </div>
            
            <h2>Пример ответа</h2>
            
            <div class="code_example">
                <pre>
Array
(
    [xml_id] => 1065
    [name] => A 155 {DEDRA} БАЛКА СУППОРТА РАДИАТ НИЖН ВНУТРЕН
    [code] => AF15592-411
    [section] => УНИВЕРСАЛЬНЫЕ
    [image] => http://autobody.ru/upload/images/AF15592-411.jpg
    [properties] => Array
        (
            [oem] => 0060584051
            [firm] => EMBO
            [country] => 
            [year] => 92-96
            [manufacturer_number] => 
        )

    [amount] => Array
        (
            [0] => Array
                (
                    [id] => 1
                    [name] => Москва-Печатники
                    [quantity] => 0
                )

            [1] => Array
                (
                    [id] => 2
                    [name] => Москва-Дмитровка
                    [quantity] => 0
                )

            [2] => Array
                (
                    [id] => 3
                    [name] => Москва-Капотня
                    [quantity] => 0
                )

            [3] => Array
                (
                    [id] => 4
                    [name] => Омск
                    [quantity] => 0
                )

        )

    [prices] => Array
        (
            [0] => Array
                (
                    [id] => 1
                    [name] => Оптовая
                    [price] => 27.30
                    [currency] => USD
                )

            [1] => Array 
                (
                    [id] => 2
                    [name] => Розничная
                    [price] => 41.00
                    [currency] => USD
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