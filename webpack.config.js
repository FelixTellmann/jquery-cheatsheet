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
        filename: '[name].js'
    },
    plugins: [
        new bower({
            excludes: /\.css$/
        })
    ]
};
