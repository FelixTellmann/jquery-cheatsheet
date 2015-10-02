var bs = require('browser-sync').create();
var path = require('path');
var host = process.argv[2] || 'http://127.0.0.1:8000';

bs.watch(['source/**/*', 'public/**/*'], function (event, file) {
    if (event !== 'change') {
        return;
    }

    var ext = path.extname(file);

    switch (ext) {
        case '.yml':
        case '.php':
            bs.reload('*.html');
            return;

        default:
            bs.reload('*' + ext);
            return;
    }
});

bs.init({
    proxy: host
});