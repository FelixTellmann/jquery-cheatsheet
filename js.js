{
	appDir: "source/js",
	baseUrl: '.',
	mainConfigFile : 'source/js/main.js',
	dir: 'public/js',
	removeCombined: true,
	modules: [
		{
			name: 'main',
			include: ['../../bower_components/almond/almond.js']
		}
	]
}
