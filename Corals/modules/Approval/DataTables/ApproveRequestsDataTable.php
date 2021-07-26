<?php

namespace Corals\Modules\Approval\DataTables;

use Corals\Foundation\DataTables\BaseDataTable;
use Corals\Modules\Approval\Models\ApproveRequest;
use Corals\Modules\Approval\Transformers\ApproveRequestTransformer;
use Yajra\DataTables\EloquentDataTable;

class ApproveRequestsDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('approval.models.approveRequest.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new ApproveRequestTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param ApproveRequest $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(ApproveRequest $model)
    {
       // return $model->newQuery();
        return $model->orderByRaw( "FIELD(status, 'pending', 'review', 'rejected', 'accepted')")->newQuery();
       // return $model->where('status','pending')->newQuery();

        
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
            'product_id' => ['title' => trans('Marketplace::attributes.product.name')],
            'status'=> ['title' => trans('Corals::attributes.status')],
            'note'=> ['title' => trans('Approval::attributes.note')],
           
            'created_at' => ['title' => trans('Corals::attributes.created_at')],
            'updated_at' => ['title' => trans('Corals::attributes.updated_at')],
        ];
    }

  public function getFilters()
    {
        $filters = [
            'status' => ['title' => trans('status'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ['pending'=>'pending','review'=>'review','accepted'=>'accepted','rejected'=>'rejected'], 'active' => true],
            'product.name' => ['title' => trans('Marketplace::attributes.product.title_name'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'note' => ['title' => trans('Note'), 'class' => 'col-md-3', 'type' => 'text', 'condition' => 'like', 'active' => true],
            //'status' => ['title' => trans('Marketplace::attributes.product.status_product'), 'class' => 'col-md-2', 'checked_value' => 'active', 'type' => 'boolean', 'active' => true],
        ];
    //  $filters = \Store::getStoreFilters($filters);
        return $filters;
    }


    
}
