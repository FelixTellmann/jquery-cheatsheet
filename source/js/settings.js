define([
	'jquery',
	'magnific-popup',
], function ($) {
	var settings = {
		open_links: 'modal-window'
	};

	return {
		init: function ($link) {
			$link.magnificPopup({
				type:'inline',
				mainClass: 'modal-about'
			});

			var $settings = $($link.attr('href'));

			$settings.find(':radio').click(function () {
				var $this = $(this);

				settings[$this.attr('name')] = $this.val();

				localStorage.setItem('settings', JSON.stringify(settings));
			});

			var savedSettings = localStorage.getItem('settings');

			if (savedSettings) {
				$.extend(settings, JSON.parse(savedSettings));
			}

			$settings.find(':radio[name="open_links"][value="' + settings.open_links + '"]').prop('checked', true);
		},

		getValue: function (name) {
			return settings[name];
		}
	}
});
