$(document).ready(function () {

    $('#example').DataTable();

    //var ajax = {
    //    type: "POST",
    //    url: "",
    //    data: {},
    //    dataType: "json",
    //    contentType: "application/json",
    //    success: {},
    //    error: {}
    //};
    //
    //function insert(data) {
    //    ajax.url = 'http://api.elartedelpapaloteo.com/taskInsert';
    //    ajax.success = function()
    //    {
    //        console.log('Task inserted');
    //    };
    //    ajax.error = function()
    //    {
    //        console.log('Something goes wrong');
    //    };
    //
    //    ajax.data = JSON.stringify(data);
    //    $.ajax(ajax);
    //}
    //
    //function get() {
    //    function style(json)
    //    {
    //        json = $.parseJSON(json);
    //        for(var obj in json) {
    //
    //            var $task = $('<div>').addClass('task');
    //
    //            for(var prop in json[obj]) {
    //                $('<span>').text(prop).appendTo($task);
    //            }
    //        }
    //    }
    //
    //    ajax.url = 'http://api.elartedelpapaloteo.com/taskGet';
    //    ajax.success = function(data)
    //    {
    //        data = data.task;
    //        $('body').append(style(data));
    //    }
    //}
    //
    //function update(){
    //
    //}
    //return {
    //    insert: insert,
    //    get: get,
    //    update: update
    //};
});