<?php

namespace Croissant;

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

        $open_pattern = preg_quote($delim_open);
        $close_pattern = preg_quote($delim_close);
        $not_close_pattern = '[^'.preg_quote($delim_close).']*';
        
        $rpc_table = [];
        foreach ($table as $key => $value) {
            $src = '/'.$open_pattern.$not_close_pattern.preg_quote($key).$not_close_pattern.$close_pattern.'/';
            $rpc_table[$src] = $value;
        }

        return preg_replace(array_keys($rpc_table), $table, $template);
    }
        
}
