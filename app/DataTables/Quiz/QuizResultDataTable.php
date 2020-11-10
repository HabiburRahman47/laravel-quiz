<?php

namespace App\DataTables\Quiz;

use App\Models\V1\Quiz\QuizResult;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class QuizResultDataTable extends DataTable
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
            ->editColumn('created_at', function ($quizResult) {
                return $quizResult->created_at->format(config('common.date_time.format.output.normal'));
            })

            ->editColumn('session_id', function ($quizResult) {
                return '<a href="#">' . $quizResult->quizSession->quiz_name . '</a>';
            })
            // ->addColumn('quiz', function ($quizResult) {
            //     return '<a href="' . route('web.admin.quizzes.show', $quizResult->quiz_id) . '">' . $quizResult->quiz->name . '</a>';
            // })
           
             ->addColumn('action', function ($quizResult) {
                $id = $quizResult->id;
                $editUrl = null;
                $showUrl = null;
                $deleteUrl = route('web.admin.quiz-results.destroy', $id);
                $restoreUrl = null;
                $trashUrl = null;
                if ($quizResult->trashed()) {
                    $restoreUrl = route('web.admin.quiz-results.restore', $id);
                } else {
                    $trashUrl = route('web.admin.quiz-results.trash', $id);
                    $editUrl = route('web.admin.quiz-results.edit', $id);
                    $showUrl = route('web.admin.quiz-results.show', $id);
                }

                $action = view('core.dashboard.layout.partials.datatables.action', compact('id', 'showUrl', 'editUrl', 'deleteUrl', 'trashUrl', 'restoreUrl'));
                return $action;
            })
            ->rawColumns(['action','session_id']);
            // ->whitelist(['name']);
    }

    // https://github.com/yajra/cms-core/blob/4.0/src/DataTables/ArticlesDataTable.php

    /**
     * Get query source of dataTable.
     *
     * @param Student $model
     * @return Builder
     */
    public function query(QuizResult $model)
    {
        $model = QuizResult::query();

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
            ->setTableId('quizresult-table')
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
            Column::make('total_question'),          
            Column::make('total_right_ans'),          
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
        return 'QuizResults_' . date('YmdHis');
    }
}
