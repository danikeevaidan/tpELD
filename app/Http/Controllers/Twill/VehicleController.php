<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;

use A17\Twill\Models\RelatedItem;
use A17\Twill\Services\Forms\Fields\Browser;
use A17\Twill\Services\Forms\Fields\Select;
use A17\Twill\Services\Forms\Fields\Wysiwyg;
use A17\Twill\Services\Listings\Columns\Browser as BrowserColumn;
use A17\Twill\Services\Listings\Columns\Image;
use A17\Twill\Services\Listings\Columns\Relation;
use A17\Twill\Services\Listings\Columns\Text;
use A17\Twill\Services\Listings\TableColumns;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Fields\Medias;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Http\Controllers\Admin\ModuleController as BaseModuleController;
use App\Models\Driver;
use App\Models\Vehicle;

class VehicleController extends BaseModuleController
{
    protected $moduleName = 'vehicles';
    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected function setUpController(): void
    {
        $this->disablePermalink();
        $this->disablePublish();
    }


    protected function getIndexTableColumns(): TableColumns
    {
        $table = parent::getIndexTableColumns();
        $table->prepend(
            Image::make()
                ->field('cover')
                ->title('Image')
                ->customRender(function ($product) {
                    return $product->medias()->get()->isNotEmpty()
                        ? "/storage/uploads/" . $product->medias()->first()['uuid']
                        : "/default.png";
                })
        );
        return $table;
    }

    /**
     * See the table builder docs for more information. If you remove this method you can use the blade files.
     * When using twill:module:make you can specify --bladeForm to use a blade form instead.
     */
    public function getForm(TwillModelContract $model): Form
    {
        $form = parent::getForm($model);

        $form->add(
            Wysiwyg::make()->name('description')->label('Description')
        );

        $form->add(
            Medias::make()
                ->name('cover')
                ->label('Images')
        );

        return $form;
    }

    /**
     * This is an example and can be removed if no modifications are needed to the table.
     */
    protected function additionalIndexTableColumns(): TableColumns
    {
        $table = parent::additionalIndexTableColumns();
        $table->add(
            Text::make()
                ->field('driver')
                ->customRender(function ($vehicle) {
                    return $vehicle->drivers->first()->user->name;
            })
                ->linkCell(fn ($vehicle) => route('twill.drivers.show', ['driver' => $vehicle->drivers->first()])),
        );

        return $table;
    }
}
