<?include('api_header.php')?>
<div class="api_content">
    <div class="important">
                <span>важно</span>
                <span>Все ошибки возвращаются в формате JSON</span>
            </div>
    
    <h2>Элемент не найден</h2>
    <div class="method_desc">
        Ошибка будет возвращена в случае,если по вашему запросу не будет найдено ни одного совпавшего элемента. 
    </div>
    <h2>Пример ошибочного запроса</h2>
    <div class="code_example">
        <code>http://www.autobody.ru/api/getProductInfo/?token=123456789qwertyuiopasdfghjklzxcv&code=AF15592</code>
    </div>
    <h2>Текст ошибки</h2>
    <div class="code_example error_field">
            <pre>
{
    "error":"Элемент не найден"
}</pre>
    </div>
    <div class="method_desc">
        В данном примере был передан несуществующий артикул товара,в результате чего мы получили ошибку. 
    </div>
    
    <div class="error_sep"></div>
    
    <h2>Недостаточно параметров для поиска!</h2>
    <div class="method_desc">
        Ошибка будет возвращена в случае,если не были переданы параметры,помеченные как обязательные. 
    </div>
    <h2>Пример ошибочного запроса</h2>
    <div class="code_example">
        <code>http://www.autobody.ru/api/getProductInfo/?token=123456789qwertyuiopasdfghjklzxcv</code>
    </div>
    <h2>Текст ошибки</h2>
    <div class="code_example error_field">
            <pre>
{
    "error":"Недостаточно параметров для поиска!"
}</pre>
    </div>
    <div class="method_desc">
        В данном примере был передан только ключ доступа к сервису,для поиска по элементам необходимо передать еще хотя бы один параметр,помеченный как обязательный. 
    </div>
    <div class="error_sep"></div>
    
    <h2>Неверный ключ доступа к сервису.</h2>
    <div class="method_desc">
        Ошибка будет возвращена в случае,если переданный token не соответсвует ни одному пользователю. 
    </div>
    <h2>Пример ошибочного запроса</h2>
    <div class="code_example">
        <code>http://www.autobody.ru/api/getProductInfo/?token=1234&code=AF15592</code>
    </div>
    <h2>Текст ошибки</h2>
    <div class="code_example error_field">
            <pre>
{
    "error":"Неверный ключ доступа к сервису."
}</pre>
    </div>
    <div class="method_desc">
        В данном примере был передан неверный ключ доступа,не соответсвующий ни одному пользователю. 
    </div>
     <div class="error_sep"></div>
     <h2>Передан неверный параметр для функции.</h2>
     <div class="method_desc">
        Ошибка будет возвращена в случае,если тип переданных в параметр данных не соответствует ожидаемому. 
    </div>
    <h2>Пример ошибочного запроса</h2>
    <div class="code_example">
        <code>http://www.autobody.ru/api/getOrderInfo/?token=123456789qwertyuiopasdfghjklzxcv&id=error</code>
    </div>
    <h2>Текст ошибки</h2>
    <div class="code_example error_field">
            <pre>
{
    "error":"Передан неверный параметр для функции."
}</pre>
    </div>
    <div class="method_desc">
        В данном примере методу getOrderInfo в качестве значения параметра id была передана строка,так как метод ожидает на вход числовое значение,то данный пример привел к ошибке. 
    </div>
    <div class="error_sep"></div>
<div class="important">
                <span>важно</span>
                <span>Следующие ошибки относятся только к методу putOrder</span>
            </div>
            <h2>Недостаточно товара __ на выбранном вами складе. (Вами было заказано __ , доступно на данный момент __.</h2>
            <div class="method_desc">
        Ошибка будет возвращена в случае,если количество товара,которое вы пытаетесь заказать превышает количество на выбранном складе. 
    </div>
     <h2>Пример ошибочного запроса</h2>
    <div class="code_example">
        <code>http://www.autobody.ru/api/putOrder/?token=123456789qwertyuiopasdfghjklzxcv&order={"items":{"AF15592-000-R":20},"warehouse":1,"comments":"test comment"}</code>
    </div>
    <h2>Текст ошибки</h2>
    <div class="code_example error_field">
            <pre>
{
    "error":"Недостаточно товара A 155 ФАРА ПРАВ П/КОРРЕКТОР на выбранном вами складе. 
    (Вами было заказано 20 , доступно на данный момент 2 )"
}</pre>
    </div>
    <div class="method_desc">
        В данном примере количество товара,переданного методу putOrder превысило количество,доступное на складе. 
    </div>
    <div class="error_sep"></div>
    <h2>Элемента с кодом __ не существует.</h2>
    <div class="method_desc">
        Ошибка будет возвращена в случае,если товара с данным артикулом не существует. 
    </div>
    <h2>Пример ошибочного запроса</h2>
     <div class="code_example">
        <code>http://www.autobody.ru/api/putOrder/?token=123456789qwertyuiopasdfghjklzxcv&order={"items":{"AF15592-00-R":20},"warehouse":1,"comments":"test comment"}</code>
    </div>
    <h2>Текст ошибки</h2>
    <div class="code_example error_field">
            <pre>
{
    "error":"Элемента с кодом AF15592-00-R не существует."
}</pre>
    </div>
    <div class="method_desc">
        В данном примере был передан товар с несуществующим артикулом. 
    </div>
    <div class="error_sep"></div>
    <h2>Склада с ID=__ не существует.</h2>
    <div class="method_desc">
        Ошибка будет возвращена в случае,если склада с данным ID не существует. 
    </div>
    <h2>Пример ошибочного запроса</h2>
    <div class="code_example">
        <code>http://www.autobody.ru/api/putOrder/?token=123456789qwertyuiopasdfghjklzxcv&order={"items":{"AF15592-000-R":1},"warehouse":12,"comments":"test comment"}</code>
    </div>
    <h2>Текст ошибки</h2>
    <div class="code_example error_field">
            <pre>
{
    "error":"Склада с ID=12 не существует."
}</pre>
    </div>
    <div class="method_desc">
        В данном примере был передан склад с несуществующим ID. 
    </div>
</div>
<?include('api_footer.php')?>