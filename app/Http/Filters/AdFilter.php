<?php

namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class AdFilter extends AbstractFilter
{
    public const BRAND_ID = 'brand_id';
    public const MODEL = 'model';
    public const GENERATION = 'generation';
    public const YEAR = 'year';

    protected function getCallbacks(): array
    {
        return [
            self::BRAND_ID => [$this, 'brand_id'],
            self::MODEL => [$this, 'model'],
            self::GENERATION => [$this, 'generation'],
            self::YEAR => [$this, 'year'],
        ];
    }

    public function brand_id(Builder $builder, $value)
    {
        $builder->where('brand_id', $value);
    }

    public function model(Builder $builder, $value)
    {
        $builder->where('model', 'like', "%{$value}%");
    }

    public function generation(Builder $builder, $value)
    {
        $builder->where('generation', 'like', "%{$value}%");
    }

    public function year(Builder $builder, $value)
    {
        $builder->where('year', $value);
    }
}
