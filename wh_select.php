<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog.php");?>
<div class="warehouse">
    <select id="warehouse" class="warehouseselect" name="mywarehouse" onChange="set_url(this.value); ">
        <?if(intval($_GET["mywarehouse"])){
                GKCommon::SaveWarehouse();
            }
            $wh = GKCommon::GetWarehouses();
            if(count($wh)){
                $nowWH = GKCommon::GetSavedWarehouse();
                foreach($wh as $w){
                ?><option value="<?=$w["ID"]?>"<? if($nowWH && ($w["ID"] == $nowWH)) echo "selected"; ?>><?=$w["TITLE"]?></option><?
                }
        }?>
    </select>
    </div>