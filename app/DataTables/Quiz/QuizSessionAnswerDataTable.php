<?php

namespace App\DataTables\Quiz;

use App\Models\V1\Quiz\QuizSession;
use App\Models\V1\Quiz\QuizSessionAnswer;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class QuizSessionAnswerDataTable extends DataTable
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
            ->editColumn('created_at', function ($quizSessionAns) {
                return $quizSessionAns->created_at->format(config('common.date_time.format.output.normal'));
            })
            // ->editColumn('status', function ($quizSessionAns) {
            //     if ($quizSessionAns->status) {
            //         return '<span  class="badge badge-success">Complete</span>';
            //     } else {
            //         return '<span  class="badge badge-warning">Incomplete</span>';
            //     }
            // })

            // ->editColumn('quiz_id', function ($quizSessionAns) {
            //     return '<a href="#">' . $quizSessionAns->quiz->name . '</a>';
            // })           
             ->addColumn('action', function ($quizSessionAns) {
                $id = $quizSessionAns->id;
                $editUrl = null;
                $showUrl = null;
                $deleteUrl = route('web.admin.quiz-session-answers.destroy', $id);
                $restoreUrl = null;
                $trashUrl = null;
                if ($quizSessionAns->trashed()) {
                    $restoreUrl = route('web.admin.quiz-session-answers.restore', $id);
                } else {
                    $trashUrl = route('web.admin.quiz-session-answers.trash', $id);
                    $editUrl = route('web.admin.quiz-session-answers.edit', $id);
                    $showUrl = route('web.admin.quiz-session-answers.show', $id);
                }

                $action = view('core.dashboard.layout.partials.datatables.action', compact('id', 'showUrl', 'editUrl', 'deleteUrl', 'trashUrl', 'restoreUrl'));
                return $action;
            })
            ->rawColumns(['action','status','quiz_id']);
            // ->whitelist(['name']);
    }

    // https://github.com/yajra/cms-core/blob/4.0/src/DataTables/ArticlesDataTable.php

    /**
     * Get query source of dataTable.
     *
     * @param Student $model
     * @return Builder
     */
    public function query(QuizSessionAnswer $model)
    {
        $model = QuizSessionAnswer::query();

        // $created_by_id = $this->request('id');
        // if ($created_by_id)
        // {
        //     $model->where('created_by_id', auth()->user()->id)->get();
        // }

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
            ->setTableId('quizsessionans-table')
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
            Column::make('session_id')->searchable(true),           
            Column::make('question_id'),                 
            Column::make('selected_choice_id'),                 
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
        return 'QuizSessionAnswers_' . date('YmdHis');
    }
}
