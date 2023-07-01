<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Spatie\NovaTranslatable\Translatable;

class Badge extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Badge>
     */
    public static $model = \App\Models\Badge::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title', 'description',
    ];

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (!auth()->user()->hasPermissionTo('view secret badges')) {
            return $query->where('secret', false);
        }

        return $query;
    }

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
                Text::make(__('Title'), 'title')->sortable()->required(),
                Textarea::make(__('Description'), 'description')->required(),
            ]),
            Boolean::make(__('Is secret'), 'secret')->default(false),
            Image::make(__('Badge image'), 'image_path')->disk('public')
                ->path('badges/'),
            BelongsToMany::make(__('Users'), 'users', User::class)->hideFromIndex(),
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
