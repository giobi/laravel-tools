<?php

namespace Giobi\Lib;

use App\Models\User;
use Firebase\JWT\JWT as fjwt;

class jwt {
    protected $head;
    protected $payload;
    protected $secret;
    protected $jwt;

    public function __construct(fjwt $j) {
        $this->jwt = $j;
        $this->head = config('jwt.head');
        $this->secret = config('jwt.secret');
        $this->alg = config('jwt.head.alg');
    }

    public function createjwt(fjwt $j) {
        return $this->jwt = $j;
    }

    public function encode($payload) {
        return $this->jwt->encode($payload, $this->secret);
    }

    public function decode($token) {
        return $r = $this->jwt->decode($token, $this->secret, [$this->alg]);
    }

    public function jwtforuser($id) {
        $logged = User::find($id);

        $expire = time() + config('jwt.ttl');

        $data = [
            'id' => $logged['id'], 'email' => $logged['email'], 'name' => $logged['name'],
            'iss' => config('app.name').'-auth',
            'expire' => $expire
        ];
        return $jwt = $this->jwt->encode($data);
    }

}
