<?php

namespace App\DataTables;

use App\Models\APosts;
use Form;
use Yajra\Datatables\Services\DataTable;

class APostsDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'a_posts.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $aPosts = APosts::query();

        return $this->applyScopes($aPosts);
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
            'place_id' => ['name' => 'place_id', 'data' => 'place_id'],
            'section_id' => ['name' => 'section_id', 'data' => 'section_id'],
            'post_id' => ['name' => 'post_id', 'data' => 'post_id'],
            'post_date' => ['name' => 'post_date', 'data' => 'post_date'],
            'heading' => ['name' => 'heading', 'data' => 'heading'],
            'description' => ['name' => 'description', 'data' => 'description'],
            'job_link' => ['name' => 'job_link', 'data' => 'job_link'],
            'ignore_flg' => ['name' => 'ignore_flg', 'data' => 'ignore_flg'],
            'email_addr' => ['name' => 'email_addr', 'data' => 'email_addr'],
            'email_id' => ['name' => 'email_id', 'data' => 'email_id'],
            'resp_received' => ['name' => 'resp_received', 'data' => 'resp_received'],
            'bad_action' => ['name' => 'bad_action', 'data' => 'bad_action'],
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
        return 'aPosts';
    }
}
