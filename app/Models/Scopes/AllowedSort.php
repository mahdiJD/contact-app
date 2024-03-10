<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait AllowedSort{

    public function parsSortDirection(){
        return strpos(request()->query('sort_by'),"-") === 0 ? 'desc' : 'asc';
    }

    public function parsSortColumn($column = null){
        return ltrim(request()->query('sort_by'),"-");
    }
    public function scopeAllowedSorts(Builder $query , array $columns)
    {   $column = $this->parsSortColumn();
        if (in_array($column,$columns)){
            return $query->orderBy($column,$this->parsSortDirection());
        }
        return $query;
    }
}
