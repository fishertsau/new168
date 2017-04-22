'use strict'

const path  = require('path')

module.exports = {
    module: {
        loaders: [
            {
                test: /\.js$/,
                include: path.join(__dirname, 'resources/assets'),
                exclude: /node_modules/,
                loader: 'babel',
            },
            {
                test: /\.vue$/,
                loader: 'vue',
            },
            {
                test: /\.css$/,
                loader: 'style!css'
            },
        ]
    },
}