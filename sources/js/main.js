require.config({
	shim: {
		"magnific-popup": ["jquery"]
	},
	urlArgs: "bust=" +  (new Date()).getTime(),
	paths: {
		"jquery": "../bower_components/jquery/dist/jquery",
		"sifter": "../bower_components/sifter/sifter",
		"microplugin": "../bower_components/microplugin/src/microplugin",
		"magnific-popup": "../bower_components/magnific-popup/dist/jquery.magnific-popup",
		"selectize": "../bower_components/selectize/dist/js/selectize"
	}
});

require([
	'jquery',
	'versions-selector',
	'api-search',
	'modal',
	'settings'
], function ($, versions, search, modal, settings) {
	var $links = $('.main-content a');

	versions.init($('#version'), $links);
	search.init($('#search'), $links);
	modal.init($('#modal'), $links);
	settings.init($('#about-link'));

	//ad tracking
	$('.ads a').click(function () {
		_gaq.push(['_trackEvent', 'ad', 'click', $(this).attr('href')]);
	});
});
