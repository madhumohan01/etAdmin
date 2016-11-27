<?php

namespace App\DataTables;

use App\Models\Keyword;
use Form;
use Yajra\Datatables\Services\DataTable;

class KeywordDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'keywords.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $keywords = Keyword::query();

        return $this->applyScopes($keywords);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->addAction(['width' => '10%'])
            ->ajax('')
            ->parameters([
                'dom' => 'Bfrtip',
                'scrollX' => false,
                'buttons' => [
                    'print',
                    'reset',
                    'reload',
                    [
                         'extend'  => 'collection',
                         'text'    => '<i class="fa fa-download"></i> Export',
                         'buttons' => [
                             'csv',
                             'excel',
                             'pdf',
                         ],
                    ],
                    'colvis'
                ]
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            'tech_name' => ['name' => 'tech_name', 'data' => 'tech_name'],
            'tech_type' => ['name' => 'tech_type', 'data' => 'tech_type'],
            'tech_text_1' => ['name' => 'tech_text_1', 'data' => 'tech_text_1'],
            'tech_text_2' => ['name' => 'tech_text_2', 'data' => 'tech_text_2'],
            'tech_text_3' => ['name' => 'tech_text_3', 'data' => 'tech_text_3'],
            'tech_text_4' => ['name' => 'tech_text_4', 'data' => 'tech_text_4'],
            'tech_text_5' => ['name' => 'tech_text_5', 'data' => 'tech_text_5'],
            'seq_no' => ['name' => 'seq_no', 'data' => 'seq_no'],
            'status' => ['name' => 'status', 'data' => 'status']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'keywords';
    }
}
