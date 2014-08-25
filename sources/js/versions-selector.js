define([
	'jquery',
	'selectize',
], function ($) {
	var currentVersion;

	return {
		init: function ($selector, $links) {
			$selector.selectize();

			$selector.change(function () {
				var value = $selector.val();
				var activate = false;
				currentVersion = value;

				$links.removeClass('old-version removed');

				$.each($selector.data('selectize').options, function (key, option) {
					if (option.value == value) {
						activate = true;
					}

					var selector = '.v' + option.value.replace(/\./g, '-');

					if (!activate) {
						$links.filter(selector).addClass('old-version removed');
					} else {
						$links.filter(selector + '-d').addClass('old-version'); //Deprecated
						$links.filter(selector + '-r').addClass('removed'); //Removed
					}
				});
			});

			$selector.change();
		},

		getCurrent: function () {
			return currentVersion;
		}
	}
});
