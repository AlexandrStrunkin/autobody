<?include('api_header.php')?>
        <div class="api_content">
            <h2>getProductInfo</h2>
            <div class="method_desc">
               Возвращает информацию о товаре по Артикулу/OEM/Номеру производителя. 
            </div>
            <h2>URL для запроса</h2>
            <div class="url_ex">
                http://www.autobody.ru/api/getProductInfo/
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
            		<td>item</td>
            		<td>обязательный</td>
            		<td>AF15592-411</td>
            		<td>Артикул товара/OEM товара/Номер производителя</td>
            	</tr>
            </table>
            
            <div class="important">
                <span>важно</span>
                <span>Параметр item может передаваться с любыми символом,в качестве разделителя.Таким образом,запросы вида 667-1107R-LD-EM и 667-1107R LD_EM идентичны.</span>
            </div>
            
            <h2>Пример запроса методом GET</h2>
            
            <div class="code_example">
                <code>http://www.autobody.ru/api/getProductInfo/?token=123456789qwertyuiopasdfghjklzxcv&item=AF15592-411</code>
            </div>
            
            <h2>Пример запроса методом POST на языке PHP</h2>
            
            <div class="code_example">
                <pre>
    $postdata = http_build_query(
        array(
           'token' => '123456789qwertyuiopasdfghjklzxcv',
            'item' => 'AF15592-411',
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
    $result = file_get_contents('http://www.autobody.ru/api/getProductInfo/', false, $context);
    
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