<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Forms\Fields\Browser;
use A17\Twill\Services\Listings\Columns\Text;
use A17\Twill\Services\Listings\Columns\Browser as BrowserColumn;
use A17\Twill\Services\Listings\TableColumns;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Http\Controllers\Admin\ModuleController as BaseModuleController;
use App\Models\Driver;
use App\Models\Vehicle;

class DriverController extends BaseModuleController
{
    protected $moduleName = 'drivers';
    protected $titleFormKey = 'title';
    protected $titleColumnKey = 'user.name';
    protected $titleColumnLabel = 'Name';

    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected function setUpController(): void
    {
        $this->enableSkipCreateModal();
        $this->disablePermalink();
        $this->disablePublish();
    }

    /**
     * See the table builder docs for more information. If you remove this method you can use the blade files.
     * When using twill:module:make you can specify --bladeForm to use a blade form instead.
     */
    public function getForm(TwillModelContract $model): Form
    {
        $form = parent::getForm($model);

        $form->add(
            Input::make()
                ->name('description')
                ->label('Description')
        );

        $form->add(
            Browser::make()
                ->name('vehicle')
                ->label('Vehicle(s)')
                ->modules([Vehicle::class])
                ->max(10)
            ->wide()
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
            BrowserColumn::make()
                ->browser('vehicle')
                ->field('title')
                ->title('Vehicle(s)')
        );

        return $table;
    }
}
