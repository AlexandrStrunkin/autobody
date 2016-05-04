function PopUp(obj,trig){
	var html = obj.html();
	obj.remove();
	var body = $('body')[0];
				
	var HTML="<div id='popup'><span id='cancel'></span>"+html+"</div>";
	var win = $('<div id="win">'+HTML+'</div>');
	win.appendTo(body);
	
	function showWin(){
		$('#win').css({display: 'block'});
		$('#popup').css({
			display:'block', 
			opacity:0, 
			top: $(window).height()/2-$('#popup').height()/2+'px', 
			left: $(window).width()/2-$('#popup').width()/2+'px'
		});
		$('#popup').css('opacity', 1);			
	}
		
	if($(trig)){
		$(trig).click(function(){
			showWin();
		});
	}
		
	if($('#cancel')){
		$('#cancel').click(function(){
			$('#win').css('display', 'none');
		});
	}
	
}