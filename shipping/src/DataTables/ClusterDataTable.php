<?php

namespace Bsdev\Shipping\DataTables;

use Bsdev\Shipping\Models\Cluster;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ClusterDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('action', function (Cluster $cluster) {
                return '<a class="" href=' . route('clusters.edit', $cluster->id) . '><i class="fa fa-edit"></i></a><form method="POST" style="display:inline; margin-left:10px" action="' . route('clusters.destroy', $cluster->id) . '"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="' . csrf_token() . '"><a class="delete-class" data-href=' . route('clusters.destroy', $cluster->id) . '><i class="fa fa-trash" style="color:red;"></i></a></form>';
            })
            ->editColumn('status', function (Cluster $cluster) {
                return $cluster->status ? '<span style="color:white;background-color:green; padding:5px; border-radius:10px;">Published</span>' : '<span style="color:white;background-color:red; padding:5px; border-radius:10px;">Unpublished</span>';
            })
            ->editColumn('areas', function (Cluster $cluster) {
                $data = '
                <div class="text-center"><a data-toggle="collapse" href="#collapseExample' . $cluster->id . '" role="button" aria-expanded="false" aria-controls="collapseExample' . $cluster->id . '" class="btn btn-success" style="font-size:smaller;">
                View Areas</a></div><div class="collapse" id="collapseExample' . $cluster->id . '"> <div style="display:flex; flex-wrap:wrap; text-align:center;">';
                foreach ($cluster->areas as $key => $area) {
                    if ($key % 2 == 1) {

                        $data .= '<span style="background-color:green;flex: 1 0 21%;color:white;padding:5px; border-radius:10px;margin:10px; font-size:smaller;">' . $area->name . '</span><br>';
                    } else {
                        $data .= '<span style="background-color:green;flex: 1 0 21%;color:white;padding:5px; border-radius:10px;margin:10px; font-size:smaller;">' . $area->name . '</span>';

                    }
                }
                $data .= '<div></div>';
                return $data;

            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Cluster $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Cluster $model)
    {
        return $model->with('areas')->orderBy('updated_at', 'DESC')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('cluster-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('areas')
                ->data('areas')
                ->name('areas.name'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Cluster_' . date('YmdHis');
    }
}
