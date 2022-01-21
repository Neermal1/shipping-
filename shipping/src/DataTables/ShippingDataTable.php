<?php

namespace Bsdev\Shipping\DataTables;

use Bsdev\Shipping\Models\Shipping;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ShippingDataTable extends DataTable
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
            ->editColumn('action', function (Shipping $shipping) {
                return '<a class="" href=' . route('shippings.edit', $shipping->id) . '><i class="fa fa-edit"></i></a><form method="POST" style="display:inline; margin-left:10px" action="' . route('shippings.destroy', $shipping->id) . '"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="' . csrf_token() . '"><a class="delete-class" data-href=' . route('shippings.destroy', $shipping->id) . '><i class="fa fa-trash" style="color:red;"></i></a></form>';
            })
            ->editColumn('shipping_param', function (Shipping $shipping) {
                $html = '';
                $html .= '<span>' . $shipping->shipping_param . ' min:' . $shipping->shipping_param_min . 'kg  ,max:' . $shipping->shipping_param_max . 'kg</span>';
                return $html;
            })
            ->editColumn('time_param', function (Shipping $shipping) {
                $html = '';
                $html .= '<span>' . $shipping->time_param . ' min:' . $shipping->time_param_min . ',max:' . $shipping->time_param_max . '</span>';
                return $html;
            })
            ->editColumn('shipping_method', function (Shipping $shipping) {
                return $shipping->shipping_method->name ?? '';
            })
            ->editColumn('status', function (Shipping $shipping) {
                return $shipping->status ? '<span style="color:white;background-color:green; padding:5px; border-radius:10px;">Published</span>' : '<span style="color:white;background-color:red; padding:5px; border-radius:10px;">Unpublished</span>';
            })
            ->editColumn('clusters', function (Shipping $shipping) {
                $data = '
                <div class="text-center"><a data-toggle="collapse" href="#collapseExample' . $shipping->id . '" role="button" aria-expanded="false" aria-controls="collapseExample' . $shipping->id . '" class="btn btn-success" style="font-size:smaller;">
                View Clusters</a></div><div class="collapse" id="collapseExample' . $shipping->id . '"> <div style="display:flex; flex-wrap:wrap; text-align:center;">';
                foreach ($shipping->clusters as $key => $cluster) {
                    if ($key % 2 == 1) {

                        $data .= '<span style="background-color:green;flex: 1 0 21%;color:white;padding:5px; border-radius:10px;margin:10px; font-size:smaller;">' . $cluster->name . '</span><br>';
                    } else {
                        $data .= '<span style="background-color:green;flex: 1 0 21%;color:white;padding:5px; border-radius:10px;margin:10px; font-size:smaller;">' . $cluster->name . '</span>';

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
     * @param \App\Models\Shipping $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Shipping $model)
    {
        return $model->with('clusters', 'shipping_method')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('shipping-table')
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
            Column::make('shipping_param'),
            Column::make('time_param'),
            Column::make('cost'),
            Column::make('shipping_method')
                ->data('shipping_method')
                ->name('shipping_method.name'),
            Column::make('clusters')
                ->data('clusters')
                ->name('clusters.name'),
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
        return 'Shipping_' . date('YmdHis');
    }
}
