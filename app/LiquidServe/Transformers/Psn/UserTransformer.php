<?php namespace LiquidServe\Transformers\Psn;

use LiquidServe\Transformers\Transformer;

class UserTransformer extends Transformer
{

    public function transform($user)
    {
        return [
            'username' => $user['username'],
            'level'    => $user['level'],
            'trophies' => [
                'bronze'   => $user['bronze'],
                'silver'   => $user['silver'],
                'gold'     => $user['gold'],
                'platinum' => $user['platinum'],
                'total'    => $user['trophies'],
            ]
        ];
    }
}