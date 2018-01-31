<?php

namespace Module;

class Temp
{
    const DEFAULT_DELIMITERS = [
        'open' => '{{',
        'close' => '}}'
    ];
    
    public static function output(string $template, array $table, array $delimiters = self::DEFAULT_DELIMITERS)
    {
        $delim_open = $delimiters['open'];
        $delim_close = $delimiters['close'];
        $rpc_table = [];
        foreach ($table as $key => $value) {
            $src = $delim_open.$key.$delim_close;
            $rpc_table[$src] = $value;
        }

        return str_replace(array_keys($rpc_table), $table, $template);
    }
        
}
