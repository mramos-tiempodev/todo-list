var dataTableTask = {

    settings: {
        $table: $('#example')
    },

    init: function() {
        s = this.settings;
        this.initDataTable();
    },

    initDataTable: function() {
        s.$table.DataTable({
            "bLengthChange": false,
            "bFilter": false,
            "aaData": taskRows,
            "columnDefs": [ {
                "targets": 3,
                "orderable": false
            } ],
            "aoColumns": [
                {"mData": 'id'},
                {"mData": 'name'},
                {
                    "mData": 'status',
                    "mRender": function(status){
                        var statusText = 'Incomplete';
                        if(status == 1)
                            statusText = 'Complete';

                        return statusText;
                    }
                },
                {
                    "mData": 'action',
                    "mRender": function(o){
                         return '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
                    }
                }
            ]
        });
    }

};
