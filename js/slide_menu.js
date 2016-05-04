
		$(document).ready(function(){
			$("#hide_banners").click(function(){			
					$("#hide_banners").css('display','none');
					$("#show_banners").css('display','block');
					$("#header").animate({height: "186px"}, 500);
					$("#banners").hide(500);
			});
			$("#show_banners").click(function(){			
					$("#hide_banners").css('display','block');
					$("#show_banners").css('display','none');
					$("#header").animate({height: "326px"}, 500);
					$("#banners").show(500);
			});
		});