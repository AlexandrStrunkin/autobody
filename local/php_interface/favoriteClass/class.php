<?

/**
 *
 *  Parent class for 'add to favorite handlers'
 *  
 * */
 
abstract class AddItemToFavorite{
    
    // --- favorite iblock id
    protected $iblockID = 117;
    protected $href;
    protected $name;
    
    public function __construct($id,$type){
        $this->name = $this->getName($id);
        $this->href = $this->getHref($id);
        $this->addItem($id, $type);
    }
    
    abstract protected function getName($id);
    abstract protected function getHref($id);
    
    /**
     * 
     * @param int $id
     * @param int $type
     * @return string
     * 
     * */
    
    protected function addItem($id,$type){
        global $USER;
        $new_elem = new CIBlockElement;
        if($this->href && $this->name){
            $PROP=array(
                'USER_ID'=>$USER->GetID(),
                'ELEMENT_ID'=>$id,
                'TYPE_ID'=>$type,
                'ELEM_HREF'=>$this->href
            );
            $arLoadArray = array(
                "IBLOCK_ID"=>$this->iblockID,
                "PROPERTY_VALUES"=>$PROP,
                "NAME"=>$this->name,
                "ACTIVE"=>"Y"
            );
            if($newEl = $new_elem->Add($arLoadArray)){
                echo $newEl;  
            }
        } else {
            echo "Элемент с таким ID не может бть добавлен,т.к. он не существует";
        }
    }
}

class AddProductToFavorite extends AddItemToFavorite{
    
    /**
     * 
     * @param int $id
     * @return string $itemName
     * 
     * */
        
    protected function getName($id){
        $itemName = '';
        $res = CIBlockElement::GetByID($id);
        if($ar_res = $res->GetNext()){
            $itemName = $ar_res['NAME'];
        }
        return $itemName; 
    }
    
    /**
     * 
     * @param int $id
     * @return string $itemHref
     * 
     * */
    
    protected function getHref($id){
        $itemHref = '';
        $res = CIBlockElement::GetByID($id);
        if($ar_res = $res->GetNext()){
            $itemHref = $ar_res['DETAIL_PAGE_URL'];
        }
        return $itemHref; 
    }
}

class AddSectionToFavorite extends AddItemToFavorite{
    
    /**
     * 
     * @param int $id
     * @return string $itemName
     * 
     * */
        
    protected function getName($id){
        $itemName = '';
        $res = CIBlockSection::GetByID($id);
        if($ar_res = $res->GetNext()){
            $itemName = $ar_res['NAME'];
        }
        return $itemName; 
    }
    
    /**
     * 
     * @param int $id
     * @return string $itemHref
     * 
     * */
    
    protected function getHref($id){
        $itemHref = '';
        $res = CIBlockSection::GetByID($id);
        if($ar_res = $res->GetNext()){
            $itemHref = $ar_res['SECTION_PAGE_URL'];
        }
        return $itemHref; 
    }
}
?>