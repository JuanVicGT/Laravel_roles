<?php

namespace Modules\Core\Http\Controllers\Demo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utils\Enums\AlertTypeEnum;

class DemoController extends Controller
{
    #region Vistas
    public function index()
    {
        $this->checkPermission('admin', '');

        $this->addAlert('Notificaciones');
        $this->addAlert(':element saved successfully', ['element' => __('TEST')], AlertTypeEnum::DEFAULT);
        $this->addAlert(':element saved successfully', ['element' => __('TEST')], AlertTypeEnum::SUCCESS);
        $this->addAlert(':element saved successfully', ['element' => __('TEST')], AlertTypeEnum::WARNING);
        $this->addAlert(':element saved successfully', ['element' => __('TEST')], AlertTypeEnum::ERROR);
        $this->addAlert(':element saved successfully', ['element' => __('TEST')], AlertTypeEnum::INFO);

        return view('module::Demo.DemoIndex');
    }

    public function view($id) {}

    public function edit($id) {}
    #endregion
}
