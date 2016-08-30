module.exports = {
    entry:  __dirname + "/src/public/jsx/main.js",
    output: {
      path: __dirname + "/src/public/js/",
      filename: "main.js"
    },
    module: {
        loaders: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                loader: 'babel',//在webpack的module部分的loaders里进行配置即可
                query: {
                    presets: ['es2015', 'react']
                }
            },
        ]
    }
};
