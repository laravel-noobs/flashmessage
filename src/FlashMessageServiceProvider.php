<?php namespace KouTsuneka\FlashMessage;

use Illuminate\Support\ServiceProvider;

class FlashMessageServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    public function register()
    {
        $this->registerFlashBuilder();

        $this->app->alias('flash', '\KouTsuneka\FlashMessage\FlashMessageBuilder');
    }

    /**
     * Register the HTML builder instance.
     *
     * @return void
     */
    protected function registerFlashBuilder()
    {
        $this->app->singleton('flash', function($app)
        {
            $flash = new FlashMessageBuilder();
            return $flash->set_session_store($app['session.store']);
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
