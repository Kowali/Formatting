<?php namespace Kowali\Formatting\Parsers;

use ParsedownExtra;

class MarkdownParser implements ParserContract {


    /**
     * A parsedown extra parser
     *
     * @var ParsedownExtra
     */
    protected $parser;

    /**
     * Initialize the instance.
     *
     * @param  ParsedownExtra $parser
     * @return void
     */
    public function __construct(ParsedownExtra $parser)
    {
        $this->parser = $parser;
    }

    /**
     * Convert the provided markdown string to HTML.
     *
     * @param  string $input
     * @return string
     */
    public function parse($input)
    {
        return $this->parser->text($input);
    }
}

