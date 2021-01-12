<?php

namespace App\DataTables\Section;

use App\Models\V1\Section\Section;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SectionDataTable extends DataTable
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
            ->editColumn('created_at', function (Section $section) {
                return $section->created_at->format(config('common.date_time.format.output.normal'));
            })
            ->editColumn('department', function ($section) {
                return '<a href="'. route('web.admin.departments.show',$section->department_id) .'">' . $section->department->name . '</a>';
            }) 
            ->addColumn('action', function ($section) {
                $id = $section->id;
                $editUrl = null;
                $showUrl = null;
                $deleteUrl = route('web.admin.sections.destroy', $id);
                $restoreUrl = null;
                $trashUrl = null;
                if ($section->trashed()) {
                    $restoreUrl = route('web.admin.sections.restore', $id);
                } else {
                    $trashUrl = route('web.admin.sections.trash', $id);
                    $editUrl = route('web.admin.sections.edit', $id);
                    $showUrl = route('web.admin.sections.show', $id);
                }

                $action = view('core.dashboard.layout.partials.datatables.action', compact('id', 'showUrl', 'editUrl', 'deleteUrl', 'trashUrl', 'restoreUrl'));
                return $action;
            })
            ->rawColumns(['action','department'])
            ->whitelist(['name']);
    }

    // https://github.com/yajra/cms-core/blob/4.0/src/DataTables/ArticlesDataTable.php

    /**
     * Get query source of dataTable.
     *
     * @param Section $model
     * @return Builder
     */
    public function query(Section $model)
    {
        $model = Section::query();

        $created_by_id = $this->request('id');
        if ($created_by_id)
        {
            $model->where('created_by_id', auth()->user()->id)->get();
        }
        if($department_id=request('department_id')){
            $model->where('department_id',$department_id);
        }
        $trashed = request('trashed');
        if ($trashed) {
            $model->onlyTrashed();
        }

        $from_date = request('from_date');
        $to_date = request('to_date');

        if(!empty($from_date))
        {
            $model->where('created_at', ">=" ,$from_date);
        }
        

        if (!empty($to_date)){
            $to_date = "$to_date 23:59:59";
        }

       if(!empty($to_date))
        {
            $model->where('created_at', "<=" ,$to_date);
        }
        
        return $this->applyScopes($model);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $script = "var formData = $(\".filterable\").serializeArray(); $.each(formData, function(i, o){data[o.name] = o.value;});";

        return $this->builder()
            ->setTableId('section-table')
            ->columns($this->getColumns())
            ->minifiedAjax('', $script)
            ->parameters($this->getBuilderParameters())
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('csv'),
                Button::make('excel')
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
            Column::make('department'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(true)
                ->printable(true)
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
        return 'Sections_' . date('YmdHis');
    }
}
