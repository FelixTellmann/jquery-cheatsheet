"use strict";

const path    = require("path"),
      webpack = require("webpack"),
      bower   = require("bower-webpack-plugin");

module.exports = {
    context: path.join(__dirname, 'source/js'),
    entry: {
        main: './main.js'
    },
    output: {
        path: path.join(__dirname, '/build/js'),
        filename: '[name].js'
    },
    plugins: [
        new bower({
            excludes: /\.css$/
        })
    ]
};
