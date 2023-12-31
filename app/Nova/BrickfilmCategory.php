<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Spatie\NovaTranslatable\Translatable;

class BrickfilmCategory extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\BrickfilmCategory>
     */
    public static $model = \App\Models\BrickfilmCategory::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Translatable::make([
                Text::make('Name', 'name'),
                Text::make(__('Description'), 'description'),
            ]),
            Number::make(__('Position'), 'position')->nullable(),
            Boolean::make(__('Locked'), 'locked')->default(false),
            Boolean::make(__('Visible'), 'visible')->default(true),
            Boolean::make(__('Assignable'), 'assignable')->default(true),
            Boolean::make(__('Main Category'), 'main_category')->default(true),
            BelongsTo::make(__('Badge'), 'badge', Badge::class)->nullable()->hideFromIndex(),
            Image::make('image')->disk('public')->path('categories/'.now('Europe/Vienna')->year.'/'.now('Europe/Vienna')->month)->nullable(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
