const mix = require('laravel-mix')
const webpack = require('webpack')
const path = require('path')

class NovaExtension {
    name() {
        return 'nova-extension'
    }

    register(name) {
        this.name = name
    }

    webpackPlugins() {
        return new webpack.ProvidePlugin({
            Errors: 'form-backend-validation',
        })
    }

    webpackConfig(webpackConfig) {
        webpackConfig.externals = {
            vue: 'Vue',
        }

        webpackConfig.resolve.alias = {
            ...(webpackConfig.resolve.alias || {}),
            '@': path.resolve(__dirname, './vendor/laravel/nova/resources/js/'),
            'laravel-nova': path.join(__dirname, 'vendor/laravel/nova/resources/js/mixins/packages.js'),
        }

        webpackConfig.output = {
            uniqueName: this.name,
        }
    }
}

mix.extend('nova', new NovaExtension())

// let mix = require('laravel-mix')
// let path = require('path')
//
// mix
//     .js('resources/js/field.js', 'js')
//     .vue({version: 3})
//     .sourceMaps()
//     .extract()
//     .setPublicPath('dist')
//     .alias({'@': path.join(__dirname, './vendor/laravel/nova/resources/js/')})
