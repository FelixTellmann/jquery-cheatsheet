require.config({
	shim: {
		"magnific-popup": ["jquery"]
	},
	urlArgs: "bust=" +  (new Date()).getTime(),
	paths: {
		"jquery": "../components/jquery/dist/jquery",
		"sifter": "../components/sifter/sifter",
		"microplugin": "../components/microplugin/src/microplugin",
		"magnific-popup": "../components/magnific-popup/dist/jquery.magnific-popup",
		"selectize": "../components/selectize/dist/js/selectize"
	}
});

require([
	'jquery',
	'versions-selector',
	'api-search',
	'modal',
	'settings'
], function ($, versions, search, modal, settings) {
	var $links = $('.content a');

	versions.init($('#version'), $links);
	search.init($('#search'), $links);
	modal.init($('#modal'), $links);
	settings.init($('#about-link'));
});
