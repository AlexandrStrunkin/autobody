<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?if ($_GET["order_id"]):?>



    <table class="info">
        <tr>
            <td colspan="3">���������� � ������
                <div class="tail"></div>
            </td>
        </tr>
        <tr>
            <td rowspan="5">
                <div class="sum">�����: 5656789,99 <font class="rouble">i</font></div>
                <div class="pay"><font color="#717171">������:</font>����������� ����</div>
                <div class="warning">������ � ���������</div>
            </td>
        </tr>

        <tr>
            <td><font color="#717171">C����:</font></td>
            <td>������-���������</td>
        </tr>

        <tr>
            <td><font color="#717171">����� �������:</font></td>
            <td>4532572572562546524</td>
        </tr>
        <tr>
            <td><font color="#717171">����� ���������:</font></td>
            <td>343565487</td>
        </tr>
        <tr>
            <td><font color="#717171">��������:</font></td>
            <td>�������� � ����,���,���</td>
        </tr>
    </table>

    <table class="order-list order-basket-table">
        <tr>
            <td colspan="5">������ ������
                <div class="tail"></div>
            </td>
        </tr>
        <tr>
            <th>����</td>
            <th>������������ (�������, OEM, ���)</td>
            <th>����, <font class="rouble">i</font></td>
            <th>���-��, ��</td>
            <th>�����, <font class="rouble">i</font></td>
        </tr>
        <tr>
            <td>
                <a href="#" class="fancybox" title="CHARADE ����� � 2 ��� �/������">
                    <div class="forward_catalog_new_foto" title="��������, ����� ���������� ����">
                    </div>
                </a>
            </td>
            <td>
                <a class="url-basket"> A 155 ���� ���� �/���������<br></a>
                <span class="oem-basket">(AF15592-000-R, 0301085302/301085302, 92-96)</span>
            </td>
            <td><span>513775,55</span></td>
            <td>700</td>
            <td>7773775,55</td>
        </tr>
        <tr>
            <td>
                <a href="#" class="fancybox" title="CHARADE ����� � 2 ��� �/������">
                    <div class="forward_catalog_new_foto" title="��������, ����� ���������� ����">
                    </div>
                </a>
            </td>
            <td>
                <a class="url-basket"> A 155 ���� ���� �/���������<br></a>
                <span class="oem-basket">(AF15592-000-R, 0301085302/301085302, 92-96)</span>
            </td>
            <td><span>513775,55</span></td>
            <td>700</td>
            <td>7773775,55</td>
        </tr>
        <tr>
            <td>
                <a href="#" class="fancybox" title="CHARADE ����� � 2 ��� �/������">
                    <div class="forward_catalog_new_foto" title="��������, ����� ���������� ����">
                    </div>
                </a>
            </td>
            <td>
                <a class="url-basket"> A 155 ���� ���� �/���������<br></a>
                <span class="oem-basket">(AF15592-000-R, 0301085302/301085302, 92-96)</span>
            </td>
            <td><span>513775,55</span></td>
            <td>700</td>
            <td>7773775,55</td>
        </tr>
        <tr>
            <td>
                <a href="#" class="fancybox" title="CHARADE ����� � 2 ��� �/������">
                    <div class="forward_catalog_new_foto" title="��������, ����� ���������� ����">
                    </div>
                </a>
            </td>
            <td>
                <a class="url-basket"> A 155 ���� ���� �/���������<br></a>
                <span class="oem-basket">(AF15592-000-R, 0301085302/301085302, 92-96)</span>
            </td>
            <td><span>513775,55</span></td>
            <td>700</td>
            <td>7773775,55</td>
        </tr>
        <tr>
            <td>
                <a href="#" class="fancybox" title="CHARADE ����� � 2 ��� �/������">
                    <div class="forward_catalog_new_foto" title="��������, ����� ���������� ����">
                    </div>
                </a>
            </td>
            <td>
                <a class="url-basket"> A 155 ���� ���� �/���������<br></a>
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
                ����������� � ������
                <div class="tail"></div>
            </td>
        </tr>
        <tr>
            <td>
                ����� ��������� ������, �� ������ ��������� �� ���� �� �������� +7 923 782 65 55 ��� �� �����, <br>
                ��� ��������� ������� � ����� ��������.
            </td>
        </tr>
    </table>




    <?else:

        header("location: /personal/cabinet/");

        endif;?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>