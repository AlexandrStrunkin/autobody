<?include('api_header.php')?>
<div class="api_content">
    <h2>getCatalog</h2>
    <div class="method_desc">
        Возвращает структуру разделов каталога. В результирующем массиве у каждого раздела есть следующие поля: sectionCode - уникальный идентификатор раздела, parentCode - идентификатор родителя данного раздела. 
        Если parentCode пустой, значит данный раздел является разделом первого уровня.  
    </div>
    <h2>URL для запроса</h2>
    <div class="url_ex">
        http://www.autobody.ru/api/getSections/
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
        <code>http://www.autobody.ru/api/getSections/?token=123456789qwertyuiopasdfghjklzxcv</code>
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
            $result = file_get_contents('http://www.autobody.ru/api/getSections/', false, $context);

            print_r(json_decode($result,true));
        </pre>
    </div>

    <h2>Пример ответа</h2>

    <div class="code_example">  
       Из-за большого количества данных, приведена только часть ответа:
       <br>
        <pre>
            Array
            (
            [sections] => Array
                (
                
                    ...
                    
                    [6] => Array
                        (
                            [name] => ГРУЗОВИКИ
                            [sectionCode] => 9404
                            [parentCode] =>
                            [section_XML_ID] => 123 
                         )

                    [7] => Array
                        (
                            [name] => КИТАЙ
                            [sectionCode] => 9405
                            [parentCode] => 
                            [section_XML_ID] => 123 
                        )

                    [8] => Array
                        (
                            [name] => ЕВРОПА
                            [sectionCode] => 9406
                            [parentCode] => 
                            [section_XML_ID] => 123 
                        )
                        
                      ...
                      
                    [10] => Array
                        (
                            [name] => RENAULT
                            [sectionCode] => 9410
                            [parentCode] => 9406
                            [section_XML_ID] => 123 
                        )    
                        
                    [11] => Array
                        (
                            [name] => OPEL
                            [sectionCode] => 9411
                            [parentCode] => 9406
                            [section_XML_ID] => 123 
                        )

                    [12] => Array
                        (
                            [name] => CHEVROLET/GMC
                            [sectionCode] => 9413
                            [parentCode] => 9403
                            [section_XML_ID] => 123 
                        ) 
                                                
                    ...  
                    
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