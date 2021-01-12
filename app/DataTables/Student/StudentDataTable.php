<?php

namespace App\DataTables\Student;

use App\Models\V1\Student\Student;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class StudentDataTable extends DataTable
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
            ->editColumn('created_at', function (Student $student) {
                return $student->created_at->format(config('common.date_time.format.output.normal'));
            })
             ->editColumn('section', function ($student) {
                return '<a href="#">' . $student->section->name . '</a>';
            }) 
            ->editColumn('property', function ($student) {
                return '<a href="#">' . $student->property->name . '</a>';
            }) 
            ->addColumn('action', function ($student) {
                $id = $student->id;
                $editUrl = null;
                $showUrl = null;
                $deleteUrl = route('web.admin.students.destroy', $id);
                $restoreUrl = null;
                $trashUrl = null;
                if ($student->trashed()) {
                    $restoreUrl = route('web.admin.students.restore', $id);
                } else {
                    $trashUrl = route('web.admin.students.trash', $id);
                    $editUrl = route('web.admin.students.edit', $id);
                    $showUrl = route('web.admin.students.show', $id);
                }

                $action = view('core.dashboard.layout.partials.datatables.action', compact('id', 'showUrl', 'editUrl', 'deleteUrl', 'trashUrl', 'restoreUrl'));
                return $action;
            })
            ->rawColumns(['action','property','section'])
            ->whitelist(['name']);
    }

    // https://github.com/yajra/cms-core/blob/4.0/src/DataTables/ArticlesDataTable.php

    /**
     * Get query source of dataTable.
     *
     * @param Student $model
     * @return Builder
     */
    public function query(Student $model)
    {
        $model = Student::query();

        $user_id = $this->request('id');
        if ($user_id)
        {
            $model->where('user_id', auth()->user()->id)->get();
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
            ->setTableId('student-table')
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
            Column::make('prefix'),
            Column::make('roll_number'),
            Column::make('section'),
            Column::make('property'),
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
        return 'Students_' . date('YmdHis');
    }
}
