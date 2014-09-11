{
	baseUrl: 'js',
	mainConfigFile : 'js/main.js',
	dir: '../public/js',
	removeCombined: true,
	modules: [
		{
			name: 'main',
			include: ['../../sources/bower_components/requirejs/require.js']
		}
	]
}
