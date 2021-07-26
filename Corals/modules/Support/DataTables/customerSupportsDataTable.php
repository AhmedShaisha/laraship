<?php

namespace Corals\Modules\Support\DataTables;

use Corals\Foundation\DataTables\BaseDataTable;
use Corals\Modules\Support\Models\CustomerSupport;
use Corals\Modules\Support\Transformers\CustomerSupportTransformer;
use Yajra\DataTables\EloquentDataTable;

class CustomerSupportsDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('support.models.customerSupport.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new CustomerSupportTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param CustomerSupport $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(CustomerSupport $model)
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
            'title'=> ['title' => trans('Support::attributes.title')],
            'customer_type'=> ['title' => trans('Support::attributes.customer_type')],
            'status'=> ['title' => trans('Corals::attributes.status')],
            'user_id' => ['title' =>trans('Support::attributes.responsible')],
            'created_at' => ['title' => trans('Corals::attributes.created_at')],
            'updated_at' => ['title' => trans('Corals::attributes.updated_at')],
        ];
    }
}
