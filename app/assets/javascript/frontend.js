var baxaCykel = {};

baxaCykel.validate = {
}

baxaCykel.ajax = {
	init: function() {
		// Set the cursor to "waiter" when ajax-call begins
		$( document ).ajaxStart(function() {
			$('html').css('cursor', 'wait');
		});
		// Set the cursor to "auto" (the default one) when ajax-call ends
		$( document ).ajaxComplete(function() {
			$('html').css('cursor', 'auto');
		});

		// Hides the message with a click
		$('.message-area').on('click', baxaCykel.ajax.resetMessage);

		// Login the user
		$('form.login-form').on('submit', baxaCykel.ajax.loginUser);
	},
	resetMessage: function() {
		$('.message-area').hide('fast');
		$('#info').empty();
		$('#error').empty();
		$('#warn').empty();
		$('#success').empty();
	},
	addMessage: function(type, message) {
		baxaCykel.ajax.resetMessage();
		$('.message-area').show('fast');
		switch (type) {
			case 'success':
				var $success = $('#success');
				
				var strHtml = "";
				strHtml += '<div class="alert alert-success">';
					strHtml += '<strong>'+message+'</strong>';
				strHtml += '</div>';

				$success.html(strHtml);
				break;
			case 'error':
				var $error = $('#error');

				var strHtml = "";
				strHtml += '<div class="alert alert-danger">';
					strHtml += '<strong>'+message+'</strong>';
				strHtml += '</div>';

				$error.html(strHtml);
				break;
			case 'info':
				var $info = $('#info');

				var strHtml = "";
				strHtml += '<div class="alert alert-info">';
					strHtml += '<strong>'+message+'</strong>';
				strHtml += '</div>';

				$info.html(strHtml);
				break;
			case 'warning':
				var $warn = $('#warn');

				var strHtml = "";
				strHtml += '<div class="alert alert-warning">';
					strHtml += '<strong>'+message+'</strong>';
				strHtml += '</div>';

				$warn.html(strHtml);
				break;

			default:
				var $info = $('#info');

				var strHtml = "";
				strHtml += '<div class="alert alert-info">';
					strHtml += '<strong>'+message+'</strong>';
				strHtml += '</div>';

				$info.html(strHtml);
				break;
		}
	},
	loginUser: function() {
		// Adds data to the ajax call.
		var form_data = $(this).serializeArray();

		// Saves the employee_date data.
		$.ajax({
			url: $(this).attr('action'),
			type: $(this).attr('method'),
			data: form_data,
			dataType: 'json',
			success: function(data) {
				// If the ajax succeed
				if(data.success) {
					window.location.reload();
				} 
				// If the ajax didn't succeed
				else {
					baxaCykel.ajax.addMessage('error', data.data);
				}
			},
		});

		// Stop the form from submitting.
		return false;
	}
};

baxaCykel.robberies = {
	timeouts: [],

	initTimer: function() {
		$cooldown = $('span#cooldown-value');

		// If the cooldown timer exists
		if( $cooldown.length ) {
			var cooldown = +$cooldown.html();
			// Make the timer update each second
			baxaCykel.robberies.updateCooldownTimer(--cooldown);
		}
	},
	setTimerStatusReady: function() {
		var $cooldownAlert = $('#cooldown-alert');

		$cooldownAlert.removeClass('alert-info');
		$cooldownAlert.addClass('alert-success');

		$cooldownAlert.html('<p>Du är redo att sno nya cyklar...</p>');
	},
	setTimerStatusCooldown: function(cooldown) {
		var $cooldownAlert = $('#cooldown-alert');

		$cooldownAlert.removeClass('alert-success');
		$cooldownAlert.addClass('alert-info');

		$cooldownAlert.html('<p>Cooldown kvar: <span id="cooldown-value">'+cooldown+'</span> sekunder</p>');
	},
	updateCooldownTimer: function(cooldown) {
		// Reset all timeouts existing which are updateing the cooldown timer.
		for (var i = 0; i < baxaCykel.robberies.timeouts.length; i++) {
		    clearTimeout(baxaCykel.robberies.timeouts[i]);
		}
		baxaCykel.robberies.timeouts = [];

		// Check if the cooldown-alert is success then hide the box
		$cooldownAlert = $('#cooldown-alert');
		if( $cooldownAlert.hasClass('alert-success') ){
			baxaCykel.robberies.setTimerStatusCooldown(cooldown);
		}

		// Update the value of the timer
		$('span#cooldown-value').html(cooldown);

		// If cooldown is 0, stop keep update the cooldown.
		if(cooldown > 0) {

			// Update the cooldown timer every second.
			// And push it to the array of timeouts updating the cooldown timer.
			baxaCykel.robberies.timeouts.push(setTimeout(function() {
				baxaCykel.robberies.updateCooldownTimer(--cooldown)
			}, 1000));
		} else {
			baxaCykel.robberies.setTimerStatusReady();
		}
	}
};

baxaCykel.market = {
	init: function() {
		$('td.amount-market').on('click', function() {
			$(this).siblings('.market-form').find('.amount-input').val($(this).text());
		});
	},
}

baxaCykel.baxaMessage = {
	init: function() {
		var $messageTable = $('table.user-messages');
		$messageTable.find('tbody tr').on('click', function() {
			$(this).next().toggleClass('visible');

			if( $(this).next().hasClass('visible') && $(this).hasClass('unread') ) {
				$(this).removeClass('unread');
				var data = {
					message: $(this).data('message')
				};

				$.ajax({
					type: 'put',
					url: '/last-meddelanden',
					data: data,
					dataType: 'json',
				});
			}
		});

		$messageTable.find('a.btn-answer').on('click', function() {
			// Smooth scroll to compose message div
			var target = $('div#compose-new-message');
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html,body').animate({
					scrollTop: target.offset().top
				}, 1000);
			};


			var reciever = $(this).closest('tr').prev().find('td:eq(1)').first().html().trim();
			var title = $(this).closest('tr').prev().find('td:eq(2)').html().trim();
			var message = $(this).siblings('p').text();

			$('input[name="reciever"]').val(reciever);
			$('input[name="title"]').val('RE: '+title);
			$('textarea[name="content"]').val("\n\nSvarat på: \n"+message);

			return false;
		});
	}
}

baxaCykel.storage = {
	init: function() {
		$('td.amount-storage').on('click', function() {
			$(this).siblings('.storage-form').find('.amount-input').val($(this).text());
		});
	},
}

baxaCykel.bot = {
	init: function() {
	},
}

baxaCykel.chat = {
	init: function() {
		var $hideButton = $('#hide-chat'),
			$showButton = $('#show-chat');

		$hideButton.on('click', baxaCykel.chat.hideChat);
		$showButton.on('click', baxaCykel.chat.showChat);

	},
	showChat: function() {
		$(this).hide();
		$('#hide-chat').show();
		$('div.chat-container', 'div.chat').slideDown();

		$('span.new-message').hide();

		$.ajax({
			url: '/chatt-last',
			type: 'put',
			complete: function(){},
		})
	},
	hideChat: function() {
		$(this).hide();
		$('#show-chat').show();
		$('div.chat-container', 'div.chat').slideUp();
	}
}

baxaCykel.chooseTown = {
	init: function() {
		$('button.choose-town').on('click', baxaCykel.chooseTown.choose)
	}, 
	choose: function() {
		var $buttons = $('button.choose-town');

		$buttons.each(function() {
			$(this).removeClass('active');
		});

		$(this).addClass('active');

		$('form#choose-town-form input[name="town_id"]').val($(this).data('town'));
	}
}

baxaCykel.general = {
	initCooldownFixed: function() {
		var checkIfCooldownShouldBeFixed = function() {
			var isNpc = ($('.npcs').length > 0) ? true : false;
			var cooldownShouldBeFixed = false;
			if(isNpc) {
				cooldownShouldBeFixed = ((window.pageYOffset + 100) >= $('.npcs').offset().top);
			} else {
				cooldownShouldBeFixed = ((window.pageYOffset + 100) >= $('.courses').offset().top);
			}

			if(cooldownShouldBeFixed) {
				$('div.cooldown').addClass('cooldown-fixed');
			} else {
				$('div.cooldown').removeClass('cooldown-fixed');
			}
		}
		
		checkIfCooldownShouldBeFixed();

		$(window).on('scroll', function() {
			checkIfCooldownShouldBeFixed();
		});
	},

	initTabLinks: function() {
		url = document.location.href.split('#');
        if(url[1] != undefined) {
            $('.nav-tabs a[href="#' + url[1] + '"]').tab('show');
        }
	}
}




var strTemp = document.location.pathname,
	isMobileOrTablet = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));
	rob = 'baxa',
	course = 'skolan',
	market = 'marknad',
	message = 'meddelanden',
	quarter = 'mitt-kvarter',
	chat = 'chatt',
	chooseTown = 'valj-stad',
	isRobbing = strTemp.search(rob) != -1,
	isCourse = strTemp.search(course) != -1,
	isMarket = strTemp.search(market) != -1,
	isMessage = strTemp.search(message) != -1,
	isQuarter = strTemp.search(quarter) != -1,
	isChat = strTemp.search(chat) != -1,
	isChooseTown = strTemp.search(chooseTown) != -1;

$(function() {
	baxaCykel.ajax.init();
	baxaCykel.chat.init();

	baxaCykel.general.initTabLinks();

	if(isChat) {
	}
	
	if(isRobbing || isCourse) {
		baxaCykel.general.initCooldownFixed();
		baxaCykel.robberies.initTimer();
	}

	if(isMarket) {
		baxaCykel.market.init();
	}

	if(isMessage) {
		baxaCykel.baxaMessage.init();
	}

	if(isQuarter) {
		baxaCykel.storage.init();
	}

	if(isChooseTown) {
		baxaCykel.chooseTown.init();
	}

	if(isRobbing) {
		baxaCykel.bot.init();
	}
});