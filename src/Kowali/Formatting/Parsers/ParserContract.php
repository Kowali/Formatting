<?php namespace Kowali\Formatting\Parsers;

interface ParserContract {

    /**
     * Convert the provided string to HTML.
     *
     * @param  string $input
     * @return string
     */
    public function parse($input);

}
