<?
require_once ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
?>

<style>
    #item_sub_wrapper{
        margin:500px 500px;
        position:relative;
    }
    
    #item_sub_wrapper > div{
        display:inline-block;
    }
    
    #item_sub_wrapper input{
        outline: none;
    }
    
    #item_sub_wrapper input[type="email"], #item_sub_wrapper input[type="number"]{
        padding: 0 15px;
        border: 1px solid #cdcbc9;
        margin: 10px 0 20px;
        width: 200px;
        height: 30px;
        line-height: 30px;
        color: black;
    }
    
    #item_sub_wrapper input[type="number"]{
        padding: 0 0 0 15px;
    }
    
    #item_sub_form_container{
        padding: 10px 20px;
        -webkit-filter: drop-shadow(rgba(0,0,0,0.3) 0 0px 2px);
        -moz-filter: drop-shadow(rgba(0,0,0,0.3) 0 0px 2px);
        -ms-filter: drop-shadow(rgba(0,0,0,0.3) 0 0px 2px);
        filter: drop-shadow(rgba(0,0,0,0.3) 0 0px 2px);
        position: absolute;
        top: -205px;
        left: -260px;
        background: white;
        opacity:0;
        visibility:hidden;
        transition: all 500ms cubic-bezier(0.250, 0.250, 0.365, 1.340);
    }
    
    #item_sub_form_container:after{
        border: 10px solid;
        border-color: white transparent transparent;
        content: "";
        right: -20px;
        margin-left: -10px;
        position: absolute;
        top: 39%;
        transform: rotate(-90deg);
        display: block;
    }
    
    #item_sub_button{
        background-color: #1AA1C8;
        width: 120px;
        height: 40px;
        border: none;
        color: white;
        font-size: 12px;
        font-family: 'clear_sansbold';
        cursor: pointer;
        line-height: 40px;
        text-align: center;
        text-transform: uppercase;
    }
    
    #item_sub_wrapper input[type="submit"]{
        background-color: #1AA1C8;
        width: 200px;
        height: 30px;
        border: none;
        color: white;
        font-size: 12px;
        font-family: 'clear_sansbold';
        cursor: pointer;
        line-height: 30px;
        text-align: center;
        text-transform: uppercase;
        margin:0 auto;
    }
    
    .active_sub_form{
        opacity:1 !important;
        visibility:visible !important;
        top: -75px !important;
    }
    
    input::-webkit-calendar-picker-indicator {
      display: none;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#item_sub_button").click(function(){
            $("#item_sub_form_container").toggleClass("active_sub_form");
        })
    })    
</script>

<div id="item_sub_wrapper">
	<div id="item_sub_form_container">
	   <form action="">
	       <label for="">
	           Email Address<br>
	           <input required type="email" list="subs_email"/>
	           <datalist id="subs_email">
                    <option>test@mail.ru</option>
                    <option>webgk@gmail.ru</option>
                    <option>autobody@yahoo.ru</option>
               </datalist> 
	       </label><br>
	       <label for="">
               Report on: <br>
               <input required type="number" min="1"/>
           </label><br>
	       <input type="submit" value="Subscribe" />
	   </form>    
	</div>
	<div id="item_sub_button">
	    Subscribe
	</div>
</div>
