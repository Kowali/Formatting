<?php namespace Kowali\Formatting;

use Illuminate\Support\ServiceProvider;

use Kowali\Formatting\Parser;
use Kowali\Formatting\Parsers\MarkdownParser;

class FormattingServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the service provider
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     *
     * @return void
     */
    public function register (){


        $this->app->bind('kowali.parsers.markdown', "\Kowali\Formatting\Parsers\MarkdownParser");

        $this->app->bind('kowali.parser', function($app){
            return new Parser([
                'markdown' => 'kowali.parsers.markdown',
            ], $app);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['kowali.parse'];
    }
}


