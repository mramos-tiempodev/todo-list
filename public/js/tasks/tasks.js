tasks = {
    settings: {
        $sendButton: $("#send-task"),
        $taskForm: $("#taskForm"),
        ajax: {
            type: "POST",
            url: "",
            data: {},
            dataType: "json",
            async: true,
            contentType: "application/json; charset=utf-8",
            success: {},
            error: {}
        }
    },

    init: function() {
        s = this.settings;
        this.bindUIActions();
    },

    bindUIActions: function() {
        s.$sendButton.on("click", function(e) {
            e.preventDefault();
            tasks.save();
        });
    },

    save: function() {
        s.ajax.data = s.$taskForm.serialize();
        s.ajax.url = 'http://wizeline.webchallange.com/task/taskclient/insert';
        s.ajax.success = function(data)
        {
            $('#example').DataTable({
                "data": data.data,
                "columns": [
                    { "title": "Name" },
                    { "title": "Status" },
                    { "title": "Action" }
                ]
            });
        };
        s.ajax.error = function()
        {
            console.log('Something goes wrong');
        };
        $.ajax(s.ajax);
    },

    update: function() {
        s.ajax.data = s.$taskForm.serialize();
        s.ajax.url = 'http://wizeline.webchallange.com/task/taskclient/update';
        s.ajax.success = function(data)
        {
            $('#example').DataTable({
                "data": data.data,
                "columns": [
                    { "title": "Name" },
                    { "title": "Status" },
                    { "title": "Action" }
                ]
            });
        };
        s.ajax.error = function()
        {
            console.log('Something goes wrong');
        };
        $.ajax(s.ajax);
    }

};

