
var txratingcounted = 0;

$(document).ready(function() {
	
	$('.tx-content-rating-mouse-sep').click(function() {
		$.ajax({
			async: 'true',
			url: 'index.php',
			type: 'POST',
			data: {
				eID: "contentratingajax",
				'rate': parseInt($(this).attr('data-rate')),
				'url': tx_content_rating_url,
				'urlhash': tx_content_rating_urlhash
			},
			success: function(perc) {
				$('.tx-content-rating-rate-value').css('width', perc + '%');
				$('.tx-content-rating-percspan').text(perc);
				if (txratingcounted == 0) {
					txratingcounted = 1;
					$('.tx-content-rating-countspan').text(parseInt($('.tx-content-rating-countspan').text()) + 1);
				}
			}
		});
	}).hover(function() {
		$('.tx-content-rating-mouse-hint').css('left', ((parseInt($(this).attr('data-rate')) - 1) * 20) + '%').stop(true,false).animate({ 'opacity':1 }, 200);
	}, function() {
		$('.tx-content-rating-mouse-hint').stop(true,false).animate({ 'opacity':0 }, 200);
	});
	
});