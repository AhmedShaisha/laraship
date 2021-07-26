<?php

namespace Corals\Modules\Quality\DataTables;

use Corals\Foundation\DataTables\BaseDataTable;
use Corals\Modules\Quality\Models\QualityTest;
use Corals\Modules\Quality\Transformers\QualityTestTransformer;
use Yajra\DataTables\EloquentDataTable;

class QualityTestsDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('quality.models.qualityTest.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new QualityTestTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param QualityTest $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(QualityTest $model)
    {
        return $model->newQuery();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id' => ['visible' => false],
            //add columns
            'code'=> ['title' => trans('Quality::attributes.code')],
           // 'order_number' => ['title' => trans('Marketplace::attributes.order.order_number')],
            'product_id' => ['title' => trans('Quality::attributes.product_name')],
            //'note'=> ['title' => trans('Quality::attributes.note')],
            'status'=> ['title' => trans('Corals::attributes.status')],
            //'shipping' => ['title' => trans('Quality::attributes.shipping')],
            'user_id' => ['title' =>trans('Quality::attributes.responsible')],

            'created_at' => ['title' => trans('Corals::attributes.created_at')],
            'updated_at' => ['title' => trans('Corals::attributes.updated_at')],
        ];
    }
}
