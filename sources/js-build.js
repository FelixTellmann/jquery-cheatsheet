{
	baseUrl: 'js',
	mainConfigFile : 'js/main.js',
	dir: '../public/js',
	removeCombined: true,
	modules: [
		{
			name: 'main',
			include: ['../../sources/components/requirejs/require.js']
		}
	]
}
