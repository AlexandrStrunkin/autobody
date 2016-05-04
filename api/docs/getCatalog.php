<?include('api_header.php')?>
        <div class="api_content">
            <h2>getCatalog</h2>
            <div class="method_desc">
               Возвращает актуальный каталог товаров сайта autobody.ru,если передан параметр section_code,то возвратятся товары,принадлежащие к соответствующему разделу. 
            </div>
             <h2>URL для запроса</h2>
            <div class="url_ex">
                http://www.autobody.ru/api/getCatalog/
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
                    <td>section_code</td>
                    <td>необязательный</td>
                    <td>1</td>
                    <td>ID секции каталога</td>
                </tr>
            </table>
            
            <h2>Пример запроса методом GET</h2>
            
            <div class="code_example">
                <code>http://www.autobody.ru/api/getCatalog/?token=123456789qwertyuiopasdfghjklzxcv&sеction_code=1</code>
            </div>
            
            <h2>Пример запроса методом POST на языке PHP</h2>
            
            <div class="code_example">
            <pre>
    $postdata = http_build_query(
        array(
           'token' => '123456789qwertyuiopasdfghjklzxcv',
            'section_code' => '1',
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
    $result = file_get_contents('http://www.autobody.ru/api/getCatalog/', false, $context);
    
    print_r(json_decode($result,true));
            </pre>
            </div>
            
            <h2>Пример ответа</h2>
            
             <div class="code_example">
                <pre>
Array
(
    [elements] => Array
        (
            [0] => Array
                (
                    [xml_id] => 24714
                    [name] => УНИВЕРСАЛЬНЫЕ {DRL} ФОНАРЬ ГАБАРИТНЫЙ Л+П (КОМПЛЕКТ) ПЕРЕД , ТЮНИНГ , ДИОД , С ПРОВОДК , КНОПКОЙ (SONAR) ВНУТРИ ХРОМ
                    [code] => UNVER00-790H-N
                    [section] => ФАРЫ И ФОНАРИ
                    [section_XML_ID] => 8482
                    [image] => http://autobody.ru/upload/images/UNVER00-790H-N.jpg
                    [properties] => Array
                        (
                            [oem] => SK3100-01F
                            [firm] => SONAR
                            [country] => 
                            [year] => 
                            [manufacturer_number] => SK3100-01F
                        )

                    [amount] => Array
                        (
                            [0] => Array
                                (
                                    [id] => 1
                                    [name] => Москва-Печатники
                                    [quantity] => 1
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
                                    [price] => 102.00
                                    [currency] => USD
                                )

                            [1] => Array
                                (
                                    [id] => 2
                                    [name] => Розничная
                                    [price] => 153.00
                                    [currency] => USD
                                )

                        )

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