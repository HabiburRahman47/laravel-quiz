<?php

namespace App\DataTables\Card;

use App\Models\V1\Card\Card;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CardDataTable extends DataTable
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
            ->editColumn('created_at', function (Card $card) {
                return $card->created_at->format(config('common.date_time.format.output.normal'));
            })
            ->editColumn('cardable_type', function (Card $card) {
                return '<span  class="badge badge-success">Student</span>';
            })
             ->editColumn('cardable_id', function (Card $card) {
                return '<a href="'. route('web.admin.students.show',$card->cardable->id) .'"><span  class="badge badge-info">'.$card->cardable->prefix.$card->cardable->roll_number .'</span></a>';
            })
            ->addColumn('action', function ($card) {
                $id = $card->id;
                $editUrl = null;
                $showUrl = null;
                $deleteUrl = route('web.admin.cards.destroy', $id);
                $restoreUrl = null;
                $trashUrl = null;
                if ($card->trashed()) {
                    $restoreUrl = route('web.admin.cards.restore', $id);
                } else {
                    $trashUrl = route('web.admin.cards.trash', $id);
                    $editUrl = route('web.admin.cards.edit', $id);
                    $showUrl = route('web.admin.cards.show', $id);
                }

                $action = view('core.dashboard.layout.partials.datatables.action', compact('id', 'showUrl', 'editUrl', 'deleteUrl', 'trashUrl', 'restoreUrl'));
                return $action;
            })
            ->rawColumns(['action','cardable_type','cardable_id'])
            ->whitelist(['name']);
    }

    // https://github.com/yajra/cms-core/blob/4.0/src/DataTables/ArticlesDataTable.php

    /**
     * Get query source of dataTable.
     *
     * @param Card $model
     * @return Builder
     */
    public function query(Card $model)
    {
        $model = Card::query();

        // $user_id = $this->request('id');
        // if ($user_id)
        // {
        //     $model->where('user_id', auth()->user()->id)->get();
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
            ->setTableId('Card-table')
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
            Column::make('card_number'),
            Column::make('cardable_type'),
            Column::make('cardable_id'),
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
        return 'Cards_' . date('YmdHis');
    }
}
