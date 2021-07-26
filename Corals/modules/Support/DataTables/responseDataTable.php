<?php

namespace Corals\Modules\Support\DataTables;

use Corals\Foundation\DataTables\BaseDataTable;
use Corals\Modules\Support\Models\Response;
use Corals\Modules\Support\Transformers\ResponseTransformer;
use Yajra\DataTables\EloquentDataTable;

class ResponsesDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('support.models.response.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new ResponseTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Response $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Response $model)
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
            'response'=> ['title' => trans('Support::attributes.response')],
            
            
            
            'created_at' => ['title' => trans('Corals::attributes.created_at')],
            'updated_at' => ['title' => trans('Corals::attributes.updated_at')],
        ];
    }
}
