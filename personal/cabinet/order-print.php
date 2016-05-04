<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?if ($_GET["order_id"]):?>



    <table class="info">
        <tr>
            <td colspan="3">Информация о заказе
                <div class="tail"></div>
            </td>
        </tr>
        <tr>
            <td rowspan="5">
                <div class="sum">Сумма: 5656789,99 <font class="rouble">i</font></div>
                <div class="pay"><font color="#717171">Оплата:</font>Безналичный счет</div>
                <div class="warning">Принят в обработку</div>
            </td>
        </tr>

        <tr>
            <td><font color="#717171">Cклад:</font></td>
            <td>Москва-Дмитровка</td>
        </tr>

        <tr>
            <td><font color="#717171">Номер резерва:</font></td>
            <td>4532572572562546524</td>
        </tr>
        <tr>
            <td><font color="#717171">Номер накладной:</font></td>
            <td>343565487</td>
        </tr>
        <tr>
            <td><font color="#717171">Доставка:</font></td>
            <td>Экспресс в ювао,вао,юао</td>
        </tr>
    </table>

    <table class="order-list order-basket-table">
        <tr>
            <td colspan="5">Состав заказа
                <div class="tail"></div>
            </td>
        </tr>
        <tr>
            <th>Фото</td>
            <th>Наименование (артикул, OEM, год)</td>
            <th>Цена, <font class="rouble">i</font></td>
            <th>Кол-во, шт</td>
            <th>Сумма, <font class="rouble">i</font></td>
        </tr>
        <tr>
            <td>
                <a href="#" class="fancybox" title="CHARADE КАПОТ С 2 ОТВ П/ОМЫВАТ">
                    <div class="forward_catalog_new_foto" title="Кликните, чтобы посмотреть фото">
                    </div>
                </a>
            </td>
            <td>
                <a class="url-basket"> A 155 ФАРА ПРАВ П/Корректор<br></a>
                <span class="oem-basket">(AF15592-000-R, 0301085302/301085302, 92-96)</span>
            </td>
            <td><span>513775,55</span></td>
            <td>700</td>
            <td>7773775,55</td>
        </tr>
        <tr>
            <td>
                <a href="#" class="fancybox" title="CHARADE КАПОТ С 2 ОТВ П/ОМЫВАТ">
                    <div class="forward_catalog_new_foto" title="Кликните, чтобы посмотреть фото">
                    </div>
                </a>
            </td>
            <td>
                <a class="url-basket"> A 155 ФАРА ПРАВ П/Корректор<br></a>
                <span class="oem-basket">(AF15592-000-R, 0301085302/301085302, 92-96)</span>
            </td>
            <td><span>513775,55</span></td>
            <td>700</td>
            <td>7773775,55</td>
        </tr>
        <tr>
            <td>
                <a href="#" class="fancybox" title="CHARADE КАПОТ С 2 ОТВ П/ОМЫВАТ">
                    <div class="forward_catalog_new_foto" title="Кликните, чтобы посмотреть фото">
                    </div>
                </a>
            </td>
            <td>
                <a class="url-basket"> A 155 ФАРА ПРАВ П/Корректор<br></a>
                <span class="oem-basket">(AF15592-000-R, 0301085302/301085302, 92-96)</span>
            </td>
            <td><span>513775,55</span></td>
            <td>700</td>
            <td>7773775,55</td>
        </tr>
        <tr>
            <td>
                <a href="#" class="fancybox" title="CHARADE КАПОТ С 2 ОТВ П/ОМЫВАТ">
                    <div class="forward_catalog_new_foto" title="Кликните, чтобы посмотреть фото">
                    </div>
                </a>
            </td>
            <td>
                <a class="url-basket"> A 155 ФАРА ПРАВ П/Корректор<br></a>
                <span class="oem-basket">(AF15592-000-R, 0301085302/301085302, 92-96)</span>
            </td>
            <td><span>513775,55</span></td>
            <td>700</td>
            <td>7773775,55</td>
        </tr>
        <tr>
            <td>
                <a href="#" class="fancybox" title="CHARADE КАПОТ С 2 ОТВ П/ОМЫВАТ">
                    <div class="forward_catalog_new_foto" title="Кликните, чтобы посмотреть фото">
                    </div>
                </a>
            </td>
            <td>
                <a class="url-basket"> A 155 ФАРА ПРАВ П/Корректор<br></a>
                <span class="oem-basket">(AF15592-000-R, 0301085302/301085302, 92-96)</span>
            </td>
            <td><span>513775,55</span></td>
            <td>700</td>
            <td>7773775,55</td>
        </tr>
    </table>

    <table class="order-comment">
        <tr>
            <td>
                Комментарий к заказу
                <div class="tail"></div>
            </td>
        </tr>
        <tr>
            <td>
                Перед отправкой заказа, Вы должны связаться со мной по телефону +7 923 782 65 55 или по почте, <br>
                для уточнения времени и места доставки.
            </td>
        </tr>
    </table>




    <?else:

        header("location: /personal/cabinet/");

        endif;?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>