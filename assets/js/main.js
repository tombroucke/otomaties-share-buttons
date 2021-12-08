import '../scss/main.scss';

const buttons = document.querySelectorAll('.js-share-buttons__popup');
console.log(buttons)
for (let index = 0; index < buttons.length; index++) {
	console.log(otomaties_share_buttons_vars.popup_width);
	console.log(otomaties_share_buttons_vars.popup_height);
	const element = buttons[index];
	element.addEventListener('click', function(e){
		const link = this.getAttribute('href');
		const title = this.getAttribute('data-popup-title');
		window.open(link, title, 'width=' + otomaties_share_buttons_vars.popup_width + ',height=' + otomaties_share_buttons_vars.popup_height );
		e.preventDefault();
	});
}
