// Call the dataTables jQuery plugin
$(document).ready(function() {
    if ($("#dataTable").length ) {
        $('#dataTable').DataTable({
            "columnDefs": [ {
                "targets": 'no-sort',
                "orderable": false
            }],
            'order': [ 1, 'desc' ]
        });
    }
});
