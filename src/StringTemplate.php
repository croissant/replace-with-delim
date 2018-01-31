<?php

namespace Module;

use RuntimeException;

class StringTemplate
{
    const DEFAULT_DELIMITERS = [
        'open' => '{{',
        'close' => '}}'
    ];
    
    public static function output(string $template, array $table, $delimiters = self::DEFAULT_DELIMITERS)
    {
        if (is_string($delimiters)) {
            $delim = $delimiters;
            $delimiters = ['open' => $delim, 'close' => $delim];
        }
        $delim_open = isset($delimiters['open']) ? $delimiters['open'] : null;
        $delim_close = isset($delimiters['close']) ? $delimiters['close'] : null;

        if (is_null($delim_open) || is_null($delim_close)) {
            throw new RuntimeException('invalid delimiter');
        }
        
        $rpc_table = [];
        foreach ($table as $key => $value) {
            $src = $delim_open.$key.$delim_close;
            $rpc_table[$src] = $value;
        }

        return str_replace(array_keys($rpc_table), $table, $template);
    }
        
}
