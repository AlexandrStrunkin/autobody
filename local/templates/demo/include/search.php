<form action="/search.php" method="GET">
	<fieldset>
	  <legend>Поиск по сайту</legend>
    <dl>
	<dt><strong>ПОИСК </strong></dt>
<dd><a href="/catalog/search.php<?if($sect = $_REQUEST['section_id']):?>?section_id=<?=htmlspecialcharsbx($sect)?><?endif;?>">поиск по каталогу</a></dd>		
<dt><strong>       </strong></dt>

<dd>
			<input type="text" name="query" class="textbox" value="Поиск не в каталоге" onfocus="if(this.value=='Поиск не в каталоге'){this.value='';this.style.color='#959595';}" onblur="if(this.value==''){this.value='Поиск не в каталоге';this.style.color='#959595';}" />
			<input type="submit" value="искать" class="button" />
		</dd>
		
	</dl>			  
	</fieldset>
</form>