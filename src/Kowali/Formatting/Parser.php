<?php namespace Kowali\Formatting;

use Illuminate\Foundation\Application;

class Parser {

    /**
     * A list of parsers used to convert text
     *
     * @var array
     */
    protected $parsers = [];

    /**
     * A binding to a Laravel App
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Initialize the instance.
     *
     * @param  array $parsers
     * @return void
     */
    public function __construct(array $parsers = null, Application $app = null)
    {
        $this->app = $app ?: \App::make('app');

        if( ! is_null($parsers))
        {
            $this->addParsers($parsers);
        }
    }

    /**
     * Add parsers.
     *
     * @param  array $parsers
     * @return void
     */
    public function addParsers($parsers)
    {
        foreach($parsers as $name => $class)
        {
            $this->addParser($name, $class);
        }
    }

    /**
     * Add a parser.
     *
     * @param  string $name
     * @param  string $class
     * @return void
     */
    public function addParser($name, $class)
    {
        $this->parsers[$name] = $class;
    }

    /**
     * Return a parser instance from its name.
     *
     * @param  string $name
     * @return \Kowali\Formatting\Parsers\ParserContract
     */
    public function getParserInstance($name)
    {
        if( ! array_key_exists($name, $this->parsers))
        {
            throw new Exceptions\FormatterNotFoundException("No formater found for {$name}");
        }

        $parser = $this->parsers[$name];
        if( is_string($parser))
        {
            $parser = $this->app->make($parser);
        }

        return $parser;
    }

    /**
     *
     */
    public function __call($key, $args)
    {
        $parser = $this->getParserInstance($key);

        return $parser->parse($args[0]);
    }
}
