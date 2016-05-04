   <!-- </td>
</tr>
</table>-->

<script>
$(function(){
   print(); 
})
</script>


<? if(file_exists($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/footer.php')) require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/footer.php'); ?>
</body>
</html>
<?if ($APPLICATION->GetTitle()) $APPLICATION->AddChainItem($APPLICATION->GetTitle())?>