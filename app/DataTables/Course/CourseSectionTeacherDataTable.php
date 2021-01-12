<?php

namespace App\DataTables\Course;

use App\Models\V1\Course\Course;
use App\Models\V1\Course\CourseSection;
use App\Models\V1\Course\CourseSectionTeacher;
use App\Models\V1\Section\Section;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CourseSectionTeacherDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        $courseSections=CourseSection::get();
        $courses=Course::get();
        $sections=Section::get();
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('course_section', function ($courseSectionTeacher) use($courseSections,$courses,$sections) {
                $a='';
                $b='';
                $c='+';
                foreach ($courseSections as $courseSection) {
                    if($courseSectionTeacher->course_section_id==$courseSection->id){
                        foreach ($courses as $course) {
                            if($courseSection->course_id==$course->id){
                                $a= $course->name;
                            }
                        }
                    }
                }
                foreach ($courseSections as $courseSection) {
                    if($courseSectionTeacher->course_section_id==$courseSection->id){
                        foreach ($sections as $section) {
                            if($courseSection->section_id==$section->id){
                                $b= $section->name;
                            }
                        }    
                    }
                }
                return '<a href="#">'.$a.$c.$b.'</a>';
            })
            ->editColumn('created_at', function ($courseSectionTeacher) {
                return $courseSectionTeacher->created_at->format(config('common.date_time.format.output.normal'));
            })
            ->addColumn('action', function ($courseSectionTeacher) {
                $id = $courseSectionTeacher->id;
                $editUrl = null;
                $showUrl = null;
                $deleteUrl = route('web.admin.course-section-teachers.destroy', $id);
                $restoreUrl = null;
                $trashUrl = null;
                if ($courseSectionTeacher->trashed()) {
                    $restoreUrl = route('web.admin.course-section-teachers.restore', $id);
                } else {
                    $trashUrl = route('web.admin.course-section-teachers.trash', $id);
                    $editUrl = route('web.admin.course-section-teachers.edit', $id);
                    $showUrl = route('web.admin.course-section-teachers.show', $id);
                }

                $action = view('core.dashboard.layout.partials.datatables.action', compact('id', 'showUrl', 'editUrl', 'deleteUrl', 'trashUrl', 'restoreUrl'));
                return $action;
            })
            ->rawColumns(['action','course_section'])
            ->whitelist(['name']);
    }

    // https://github.com/yajra/cms-core/blob/4.0/src/DataTables/ArticlesDataTable.php

    /**
     * Get query source of dataTable.
     *
     * @param Course $model
     * @return Builder
     */
    public function query(CourseSectionTeacher $model)
    {
        $model = CourseSectionTeacher::query('courseSection');

        $teacher_id = $this->request('id');
        if ($teacher_id)
        {
            $model->where('teacher_id', auth()->user()->id)->get();
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
            ->setTableId('coursesectionteacher-table')
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
            Column::make('course_section'),
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
        return 'CourseSectionTeachers_' . date('YmdHis');
    }
}
