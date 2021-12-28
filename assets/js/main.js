import '../scss/main.scss';

const buttons = document.querySelectorAll('.js-share-buttons__popup');
for (let index = 0; index < buttons.length; index++) {
	const element = buttons[index];
	element.addEventListener('click', function(e){
		const link = this.getAttribute('href');
		const title = this.getAttribute('data-popup-title');
		window.open(link, title, 'width=' + otomaties_share_buttons_vars.popup_width + ',height=' + otomaties_share_buttons_vars.popup_height );
		e.preventDefault();
	});
}

const copyButton = document.querySelector('.share-buttons__button-copy_link');
if (copyButton) {
	copyButton.addEventListener('click', function(e) {

		const link = e.target.closest('a').getAttribute('href');
		copyTextToClipboard(link);
		e.preventDefault();
	});
}

function copyNotice(success = true) {
	const event = new CustomEvent('otomaties_share_button_copied', {
		detail: {
			copied: success
		},
	})
	window.dispatchEvent(event);
	if(otomaties_share_buttons_vars.display_copy_alert) {
		if (success) {
			alert(otomaties_share_buttons_vars.strings.copied_link)
		} else {
			alert(otomaties_share_buttons_vars.strings.copy_link_error)
		}
	}
}

function fallbackCopyTextToClipboard(text) {
	var textArea = document.createElement("textarea");
	textArea.value = text;
	
	// Avoid scrolling to bottom
	textArea.style.top = "0";
	textArea.style.left = "0";
	textArea.style.position = "fixed";
  
	document.body.appendChild(textArea);
	textArea.focus();
	textArea.select();
  
	try {
	  var successful = document.execCommand('copy');
	  var msg = successful ? 'successful' : 'unsuccessful';
	  copyNotice()
	} catch (err) {
		copyNotice(false)
	}
  
	document.body.removeChild(textArea);
  }
  
  function copyTextToClipboard(text) {
	if (!navigator.clipboard) {
	  fallbackCopyTextToClipboard(text);
	  return;
	}
	navigator.clipboard.writeText(text).then(function() {
		copyNotice()
	}, function(err) {
		copyNotice(false)
	});
  }
