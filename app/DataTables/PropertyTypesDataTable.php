<?php

namespace App\DataTables;

use App\Models\V1\Property\PropertyType;
use App\Models\V1\User\User;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PropertyTypesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('status', function ($propertyType) {
                $status = "";
                if ($propertyType->suggested == true) {
                    $status .= '<span  class="badge badge-pill badge-success">Suggested</span>';
                }
                return $status;
            })
            ->editColumn('created_at', function (PropertyType $propertyType) {
                return $propertyType->created_at->format(config('common.date_time.format.output.normal'));
            })
            ->addColumn('action', function ($propertyType) {
                $id = $propertyType->id;
                $editUrl = route('web.admin.property-types.edit', $id);
                $showUrl = route('web.admin.property-types.show', $id);
                return view('core.dashboard.layout.partials.datatable.action', compact('id', 'showUrl', 'editUrl'));;
            })
            ->rawColumns(['status'])
            ->whitelist(['name']);
    }

    // https://github.com/yajra/cms-core/blob/4.0/src/DataTables/ArticlesDataTable.php

    /**
     * Get query source of dataTable.
     *
     * @param PropertyType $model
     * @return Builder
     */
    public function query(PropertyType $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableAttribute(["width" => "100%"])
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

            Column::make('DT_RowIndex')->title('No.'),
            Column::make('name'),
            Column::make('status'),
            Column::make('created_at')->orderable(false),
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
        return 'PropertyTypes_' . date('YmdHis');
    }
}
