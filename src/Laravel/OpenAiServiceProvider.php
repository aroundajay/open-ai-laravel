<?php

namespace Orhanerday\OpenAi\Laravel;

use Illuminate\Support\ServiceProvider;

use Orhanerday\OpenAi\OpenAi;

use Error;

class OpenAiServiceProvider extends ServiceProvider {
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // merge default config
        $this->mergeConfigFrom(
            __DIR__.'/config.php',
            'openai'
        );

        $this->app->singleton('OpenAi', function($app) {
            $config = $this->getOpenAiConfig($app);

            if (empty($config)) {
                throw new Error('OpenAi configuration not exists.');
            }

            return new OpenAi(
              $config['api_key']
            );
        });

        $this->app->alias('OpenAi', 'Orhanerday\OpenAi\OpenAi');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
          __DIR__.'/config.php' => config_path('openai.php')
        ]);
    }

    /**
     * Return dashx configuration as array
     *
     * @param  Application $app
     * @return array
     */
    private function getOpenAiConfig($app)
    {
        $config = $app['config']->get('openai');

        if (is_null($config)) {
            return [];
        }

        return $config;
    }
}
