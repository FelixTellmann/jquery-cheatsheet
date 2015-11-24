"use strict";

let path    = require("path"),
    webpack = require("webpack"),
    bower   = require("bower-webpack-plugin");

module.exports = {
    context: __dirname + '/source/js',
    entry: {
        main: './main.js'
    },
    output: {
        path: __dirname + '/build/js',
        publicPath: '/js/',
        filename: 'main.js'
    },
    module: {
        loaders: [
            {
                test: /\.css$/,
                loader: "style!css"
            }
        ]
    },
    plugins: [
        new bower()
    ]
};
