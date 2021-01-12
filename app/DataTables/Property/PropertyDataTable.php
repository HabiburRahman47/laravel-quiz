<?php

namespace App\DataTables\Property;


use App\Models\V1\Property\Property;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PropertyDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('name', '{{$name}} ({{$private_name}})')
            ->editColumn('visibility', function($property){
                            if ($property->visibility == 'private'){
                            return '<span  class="badge badge-success">Private</span>';
                            }else{
                            return '<span  class="badge badge-info">Public </span>';
                            } })
            ->addColumn('updated_at','{{ \Carbon\Carbon::parse($updated_at)->toDayDateTimeString() }}')
            // ->addColumn('property_type',function($property){
            //             return '<a href="'. route('web.admin.property-types.show',$property->property_type_id) .'">'. $property->propertyType->name .'</a>';})
            ->addColumn('action', function ($property) {
                $id = $property->id;
                $editUrl = null;
                $showUrl = null;
                $deleteUrl = route('web.admin.properties.destroy', $id);
                $restoreUrl = null;
                $trashUrl = null;
                if ($property->trashed()) {
                    $restoreUrl = route('web.admin.properties.restore', $id);
                } else {
                    $trashUrl = route('web.admin.properties.trash', $id);
                    $editUrl = route('web.admin.properties.edit', $id);
                    $showUrl = route('web.admin.properties.show', $id);
                }

                $action = view('core.dashboard.layout.partials.datatables.action', compact('id', 'showUrl', 'editUrl', 'deleteUrl', 'trashUrl', 'restoreUrl'));
                return $action;
            })
            ->rawColumns(['action','suggested','visibility','property_type'])
            ->whitelist(['name']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param PropertyDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PropertyDataTable $model)
    {
        $model = Property::query();

        $created_by_id = $this->request('id');
        if ($created_by_id)
        {
            $model->where('created_by_id', auth()->user()->id)->get();
        }

        if ($visibility = request('visibility')) {
            $model->where('visibility',$visibility == "public" ? 1:0 );
        }

        if ($type_id = request('property_type_id')) {
            $model->where('property_type_id',$type_id);
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
                    ->setTableId('property-table')
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
            Column::make('property_type')->searchable(true),
            Column::make('visibility')->searchable(true),
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
        return 'Property_' . date('YmdHis');
    }
}
