<?include('api_header.php')?>
        <div class="api_content">
            <h2>putOrder</h2>
            <div class="method_desc">
               Создает заказ для пользователя с переданным token и возвращает ID заказа в случае успеха. 
            </div>
             <h2>URL для запроса</h2>
            <div class="url_ex">
                http://www.autobody.ru/api/putOrder/
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
                    <td>order</td>
                    <td>обязательный</td>
                    <td>{"items":{"AF15592-000-R":1},"warehouse":1,"comments":"test comment"}</td>
                    <td>Заказ в формате JSON</td>
                </tr>
            </table>
            
            <h2>Параметры поля order</h2>
            
            <table class="params_table">
                <tr>
                    <th>Название</th>
                    <th></th>
                    <th>Пример значения</th>
                    <th>Описание</th>
                </tr>
                <tr>
                    <td>items</td>
                    <td>обязательный</td>
                    <td>{"AF15592-000-R":1}</td>
                    <td>Ассоциативный массив вида "Артикул товара для заказа" : количество</td>
                </tr>
                <tr>
                    <td>warehouse</td>
                    <td>обязательный</td>
                    <td>1</td>
                    <td>ID склада</td>
                </tr>
                <tr>
                    <td>comments</td>
                    <td>обязательный</td>
                    <td>test comment</td>
                    <td>Комментарии покупателя к заказу</td>
                </tr>
            </table>
            
            <h2>Пример запроса методом GET</h2>
            
            <div class="code_example">
                <code>http://www.autobody.ru/api/putOrder/?token=123456789qwertyuiopasdfghjklzxcv&order={"items":{"AF15592-000-R":1},"warehouse":1,"comments":"test comment"}</code>
            </div>
            
            <h2>Пример запроса методом POST на языке PHP</h2>
            
            <div class="code_example">
            <pre>
    $postdata = http_build_query(
        array(
           'token' => '123456789qwertyuiopasdfghjklzxcv',
           'order' => {"items":{"AF15592-000-R":1},"warehouse":1,"comments":"test comment"},
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
    $result = file_get_contents('http://www.autobody.ru/api/putOrder/', false, $context);
    
    print_r(json_decode($result,true));
            </pre>
            </div>
            
            <h2>Пример ответа</h2>
            
             <div class="code_example">
                <pre>
Array
(
    [OrderID] => 1
        
)
                </pre>
             </div>
                 <div class="important">
                <span>важно</span>
                <span>Обратите внимание,что ответ от метода приходит в формате JSON,но ответ в примере, для лучшего восприятия,приведен в виде ассоциативного массива.</span>
            </div>
            
        </div>

<?include('api_footer.php')?>