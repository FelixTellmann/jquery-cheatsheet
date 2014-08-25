define([
	'jquery',
	'selectize',
], function ($) {
	
	return {
		init: function ($selector, $links) {
			$selector.selectize({
				sortField: 'sort',
				render: {
					option: function (data, escape) {
						var regex = /\./g;
						var className = 'option v' + data.from.replace(regex, '-');

						if (data.deprecated) {
							className += ' v' + data.deprecated.replace(regex, '-') + '-d';
						}

						if (data.removed) {
							className += ' v' + data.removed.replace(regex, '-') + '-r';
						}

						return '<div class="' + className + '">' + data.text + '</div>';
					}
				}
			});

			$selector.change(function () {
				var value = $selector.val();

				if (value) {
					$links.filter('.' + value).first().click();
				}
			});
		}
	}
});
