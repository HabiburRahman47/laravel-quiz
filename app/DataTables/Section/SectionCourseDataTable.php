<?php

namespace App\DataTables\Section;

use App\Models\V1\Course\CourseSection;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SectionCourseDataTable extends DataTable
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
            // ->editColumn('created_at', function ($question) {
            //     return $question->created_at->format(config('common.date_time.format.output.normal'));
            // })
            ->addColumn('updated_at', '{{ \Carbon\Carbon::parse($updated_at)->toDayDateTimeString() }}')
            ->addColumn('section', function ($sectionCourse) {
                return '<a href="' . route('web.admin.sections.show', $sectionCourse->section_id) . '">' . $sectionCourse->section->name . '</a>';
            })
            ->addColumn('course', function ($sectionCourse) {
                return '<a href="' . route('web.admin.courses.show', $sectionCourse->course_id) . '">' . $sectionCourse->course->name . '</a>';
            })
           
             ->addColumn('action', function ($sectionCourse) {
                $id = $sectionCourse->id;
                $editUrl = null;
                $showUrl = null;
                $deleteUrl = route('web.admin.section-courses.destroy', $id);
                $restoreUrl = null;
                $trashUrl = null;
                if ($sectionCourse->trashed()) {
                    $restoreUrl = route('web.admin.section-courses.restore', $id);
                } else {
                    $trashUrl = route('web.admin.section-courses.trash', $id);
                    $editUrl = route('web.admin.section-courses.edit', $id);
                    $showUrl = route('web.admin.section-courses.show', $id);
                }

                $action = view('core.dashboard.layout.partials.datatables.action', compact('id', 'showUrl', 'editUrl', 'deleteUrl', 'trashUrl', 'restoreUrl'));
                return $action;
            })
            ->rawColumns(['action', 'section', 'course']);
            // ->whitelist(['name']);
    }

    // https://github.com/yajra/cms-core/blob/4.0/src/DataTables/ArticlesDataTable.php

    /**
     * Get query source of dataTable.
     *
     * @param Student $model
     * @return Builder
     */
    public function query(CourseSection $model)
    {
        $model = CourseSection::query()->with('section','course');

        if ($section_id = request('section_id')) {
            $model->where('section_id', $section_id);
        }

        if ($course_id = request('course_id')) {
            $model->where('course_id', $course_id);
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
            ->setTableId('sectioncourse-table')
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

            Column::make('DT_RowIndex')->title('No.')
               ->searchable(false)
               ->orderable(false),
            Column::make('section'),
            Column::make('course')->searchable(true),            
            Column::make('updated_at'),
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
        return 'CourseSection_' . date('YmdHis');
    }
}
