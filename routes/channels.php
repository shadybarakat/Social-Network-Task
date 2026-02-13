<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('public-user.{id}', function () {
    return true; 
});
