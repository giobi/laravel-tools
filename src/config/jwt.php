<?php

return [
    'head' => ['alg' => 'HS256', 'typ' => 'JWT'],
    'secret' => 'putyoursecrethere',
    'ttl' => 60*60*12 #12h
];