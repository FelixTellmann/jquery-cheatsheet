{
	appDir: "sources/js",
	baseUrl: '.',
	mainConfigFile : 'sources/js/main.js',
	dir: 'public/js',
	removeCombined: true,
	modules: [
		{
			name: 'main',
			include: ['../../sources/bower_components/almond/almond.js']
		}
	]
}
