var dataTableTask = {

    settings: {
        $table: $('#example')
    },

    init: function() {
        s = this.settings;
        this.initDataTable();
    },

    initDataTable: function() {
        console.log(taskRows);
        var x = [{id:15, name:'adasd', status: '1'}];
        s.$table.DataTable({
            "bLengthChange": false,
            "bFilter": false,
            "aaData": taskRows,
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
                }
            ]
        });
    }

};
