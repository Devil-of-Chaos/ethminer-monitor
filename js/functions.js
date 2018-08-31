;(function($, window, document, undefined) {
	var $win = $(window);
	var $doc = $(document);
	
	$win.load(function() {
		
	});
	
	
  $doc.on('mouseup', function() {
  	$win.unbind('mousemove');
  });
  
	$doc.ready(function() {
		
		$('.toggle_gpu').click(function(event){
			event.preventDefault();
			var $toggle = $(this).attr('data-toggle');
			var check;
			if ($toggle == 'deactivate'){
				check = confirm('Do you really want to deactivate GPU?');
			} else {
				check = confirm('Do you really want to activate GPU?');
			}
			if (check == true) {
				
				var $content = 'toggle';
				var $id = $('#id').val();
				var $gpuID = $(this).attr('data-id');
				
				var $url = '/lib/functions.php?content='+$content;
				if ($id) $url = $url+'&id='+$id;
				if ($gpuID) $url = $url+'&gpuID='+$gpuID;
				if ($toggle) $url = $url+'&toggle='+$toggle;
	    	
				$.get($url);
				
				if ($toggle == 'deactivate'){
					$(this).attr('data-toggle', 'activate');
					$(this).html('activate');
				} else {
					$(this).attr('data-toggle', 'deactivate');
					$(this).html('deactivate');
				}
			}
		});
		
		$('.open-nav').click(function(event){
			event.preventDefault();
			$(this).find('i').toggleClass('close');
			$('.mobile-nav').toggleClass('active');
		});
		
		$('.mobile-nav a').click(function(event){
			$('.open-nav').find('i').removeClass('close');
			$('.mobile-nav').removeClass('active');
		});
		
		$('nav a, .footer-nav a').click(function(event){
			if (this.hash){
				event.preventDefault();
				var $link = this.hash.substr(1);
				
		    var dest = 0;
		    if ($('#'+$link).offset().top > $(document).height() - $(window).height()) dest = $(document).height() - $(window).height();
		    else dest = $('#'+$link).offset().top - $('.content').offset().top + $('.header').height() -46;
		    $('html,body').animate({
		        scrollTop: dest
		    }, 2000, 'swing');
		  }
		});
    
		if ($win.width() > 1024) {
			
			if ($win.scrollTop() > 95){
				$('.header').addClass('sticky');
				$('.main-nav').addClass('sticky');
			} else {
				$('.header').removeClass('sticky');
				$('.main-nav').removeClass('sticky');
			}
					
			$win.on('scroll', function(e){
				if ($win.scrollTop() > 95){
					$('.header').addClass('sticky');
					$('.main-nav').addClass('sticky');
				} else {
					$('.header').removeClass('sticky');
					$('.main-nav').removeClass('sticky');
				}
			});
		}
		
		var interval;
    var seconds = 5;
    interval = setInterval (getCurrentData, seconds*1000);
		
    function getCurrentData() {
    	var $content = $('#content').val();
    	var $id = $('#id').val();
    	
    	var $url = '/lib/functions.php?content='+$content;
    	if ($id) $url = $url+'&id='+$id;
    	
			$.get($url , function(data) {
				data = $.parseJSON(data);
				$.each(data, function(i, arr_value) {
					$.each(data[i], function(config_key, config_value) {
						if (config_key == 'STATS'){
							$.each(data[i][config_key], function(key, value) {
								if ($('#'+i+'_'+config_key+'_'+key)) $('#'+i+'_'+config_key+'_'+key).html(value);
							});
						}
						if (config_key == 'GPU'){
							$.each(data[i][config_key], function(gpu_key, gpu_value) {
								$.each(data[i][config_key][gpu_key], function(key, value) {
									if ($('#'+i+'_'+config_key+'_'+gpu_key+'_'+key)) $('#'+i+'_'+config_key+'_'+gpu_key+'_'+key).html(value);
									if (key == 'ISPAUSED' && value == 1) {
										$('#'+i+'_'+config_key+'_'+gpu_key+'_GPUBOX').removeClass('error').removeClass('online').addClass('paused');
									} else if (key == 'MATH_HASHRATE' && value == 0){
										$('#'+i+'_'+config_key+'_'+gpu_key+'_GPUBOX').removeClass('paused').removeClass('online').addClass('error');
									} else if ((key == 'ISPAUSED' && value == 0) OR (key == 'MATH_HASHRATE' && value != 0)){
										$('#'+i+'_'+config_key+'_'+gpu_key+'_GPUBOX').removeClass('error').removeClass('paused').addClass('online');
									}
								});
							});
						}
					});
				});
			});
    }
		
	});
	
})(jQuery, window, document);

(function(d){
    //quick dookie checker
    function C(k){return(d.cookie.match('(^|; )'+k+'=([^;]*)')||0)[2];}
 
    var ua = navigator.userAgent, //get the user agent string
        ismobile = / mobile/i.test(ua), //android and firefox mobile both use android in their UA, and both remove it from the UA in their "pretend desktop mode"
        mgecko = !!( / gecko/i.test(ua) && / firefox\//i.test(ua)), //test for firefox
        wasmobile = C('wasmobile') === "was", //save the fact that the browser once claimed to be mobile
        desktopvp = 'user-scalable=yes, maximum-scale=2',
        el;
 
    if(ismobile && !wasmobile){
        d.cookie = "wasmobile=was"; //if the browser claims to be mobile and doesn't yet have a session cookie saying so, set it
    }
    else if (!ismobile && wasmobile){
        //if the browser once claimed to be mobile but has stopped doing so, change the viewport tag to allow scaling and then to max out at whatever makes sense for your site (could use an ideal max-width if there is one)
        if (mgecko) {
            el = d.createElement('meta');
            el.setAttribute('content',desktopvp);
            el.setAttribute('name','viewport');
            d.getElementsByTagName('head')[0].appendChild( el );
        }else{
            d.getElementsByName('viewport')[0].setAttribute('content',desktopvp); //if not Gecko, we can just update the value directly
        }
    }
}(document));
