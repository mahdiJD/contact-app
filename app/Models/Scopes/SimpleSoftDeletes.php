<?php
namespace App\Models\Scopes;
trait SimpleSoftDeletes{

    public static function bootSimpleSoftDeletes():void
    {
        static::addGlobalScope(new SimpleSoftDeleteScope());
    }
}
