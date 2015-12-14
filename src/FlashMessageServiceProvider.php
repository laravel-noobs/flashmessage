<?php namespace KouTsuneka\FlashMessage;

use Illuminate\Support\ServiceProvider;

class FlashMessageServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerHtmlBuilder();

        $this->app->alias('flash', 'KouTsuneka\FlashMessage\FlashMessageBuilder');
    }

    /**
     * Register the HTML builder instance.
     *
     * @return void
     */
    protected function registerHtmlBuilder()
    {
        $this->app->bindShared('flash', function($app)
        {
            return new FlashMessageBuilder($app['session']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('flash', 'KouTsuneka\FlashMessage\FlashMessageBuilder');
    }

}
