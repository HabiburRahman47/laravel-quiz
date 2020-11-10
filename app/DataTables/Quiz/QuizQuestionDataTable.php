<?php

namespace App\DataTables\Quiz;

use App\Models\V1\Course\CourseSection;
use App\Models\V1\Question\Question_Quiz;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class QuizQuestionDataTable extends DataTable
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
            ->addColumn('updated_at', '{{ \Carbon\Carbon::parse($updated_at)->toDayDateTimeString() }}')
            ->addColumn('question', function ($quizQuestion) {
                return '<a href="' . route('web.admin.questions.show', $quizQuestion->question_id) . '">' . $quizQuestion->question->name . '</a>';
            })
            ->addColumn('quiz', function ($quizQuestion) {
                return '<a href="' . route('web.admin.quizzes.show', $quizQuestion->quiz_id) . '">' . $quizQuestion->quiz->name . '</a>';
            })
           
             ->addColumn('action', function ($quizQuestion) {
                $id = $quizQuestion->id;
                $editUrl = null;
                $showUrl = null;
                $deleteUrl = route('web.admin.quiz-questions.destroy', $id);
                $restoreUrl = null;
                $trashUrl = null;
                if ($quizQuestion->trashed()) {
                    $restoreUrl = route('web.admin.quiz-questions.restore', $id);
                } else {
                    $trashUrl = route('web.admin.quiz-questions.trash', $id);
                    $editUrl = route('web.admin.quiz-questions.edit', $id);
                    $showUrl = route('web.admin.quiz-questions.show', $id);
                }

                $action = view('core.dashboard.layout.partials.datatables.action', compact('id', 'showUrl', 'editUrl', 'deleteUrl', 'trashUrl', 'restoreUrl'));
                return $action;
            })
            ->rawColumns(['action', 'question', 'quiz']);
            // ->whitelist(['name']);
    }

    // https://github.com/yajra/cms-core/blob/4.0/src/DataTables/ArticlesDataTable.php

    /**
     * Get query source of dataTable.
     *
     * @param Student $model
     * @return Builder
     */
    public function query(Question_Quiz $model)
    {
        $model = Question_Quiz::query()->with('question','quiz');

        if ($question_id = request('question_id')) {
            $model->where('question_id', $question_id);
        }

        if ($quiz_id = request('quiz_id')) {
            $model->where('quiz_id', $quiz_id);
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
            ->setTableId('questionchoice-table')
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
            Column::make('quiz')->searchable(true),  
            Column::make('question'),          
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
        return 'Question_Quiz_' . date('YmdHis');
    }
}
