<?php

namespace App\DataTables\Question;

use App\Models\V1\Choice\ChoiceQuestion;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class QuestionChoiceDataTable extends DataTable
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
            ->addColumn('question', function ($questionChoice) {
                return '<a href="' . route('web.admin.questions.show', $questionChoice->question_id) . '">' . $questionChoice->questions->name . '</a>';
            })
            ->addColumn('choice', function ($questionChoice) {
                return '<a href="' . route('web.admin.choices.show', $questionChoice->choice_id) . '">' . $questionChoice->choices->name . '</a>';
            })
           
             ->addColumn('action', function ($questionChoice) {
                $id = $questionChoice->id;
                $editUrl = null;
                $showUrl = null;
                $deleteUrl = route('web.admin.question-choices.destroy', $id);
                $restoreUrl = null;
                $trashUrl = null;
                if ($questionChoice->trashed()) {
                    $restoreUrl = route('web.admin.question-choices.restore', $id);
                } else {
                    $trashUrl = route('web.admin.question-choices.trash', $id);
                    $editUrl = route('web.admin.question-choices.edit', $id);
                    $showUrl = route('web.admin.question-choices.show', $id);
                }

                $action = view('core.dashboard.layout.partials.datatables.action', compact('id', 'showUrl', 'editUrl', 'deleteUrl', 'trashUrl', 'restoreUrl'));
                return $action;
            })
            ->rawColumns(['action', 'question', 'choice']);
            // ->whitelist(['name']);
    }

    // https://github.com/yajra/cms-core/blob/4.0/src/DataTables/ArticlesDataTable.php

    /**
     * Get query source of dataTable.
     *
     * @param Student $model
     * @return Builder
     */
    public function query(ChoiceQuestion $model)
    {
        $model = ChoiceQuestion::query()->with('questions','choices');

        if ($question_id = request('question_id')) {
            $model->where('question_id', $question_id);
        }

        if ($choice_id = request('choice_id')) {
            $model->where('choice_id', $choice_id);
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
            Column::make('question'),
            Column::make('choice')->searchable(true),            
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
        return 'ChoiceQuestion_' . date('YmdHis');
    }
}
