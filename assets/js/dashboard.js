$(document).ready(function () {
    $('#table').DataTable({
        dom: 'Bfrtip',
        lengthMenu: [
            [50, 70, 100, -1],
            [50, 70, 100, 'All'],
        ],
        buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    {
                        extend: 'print',
                        text: 'Print all',
                        exportOptions: {
                            modifier: {
                                selected: null
                            },
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        text: 'Print selected',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },

                ]
            },
            {
                extend: 'colvis',
                postfixButtons: ['colvisRestore']
            },
            'pageLength'

        ],
        columnDefs: [{
            visible: false
        }],
        autoWidth: false,
        select: true,
        fixedHeader: true,
        autoWidth: false,
        paging: true,
        scrollY: 400,
        scrollCollapse: true,
        scroller: true,
        pageLength: 50,
        scrollX: true,
    });
    $('#table1').DataTable({
        dom: 'Bfrtip',
        lengthMenu: [
            [50, 70, 100, -1],
            [50, 70, 100, 'All'],
        ],
        buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    {
                        extend: 'print',
                        text: 'Print all',
                        exportOptions: {
                            modifier: {
                                selected: null
                            },
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        text: 'Print selected',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },

                ]
            },
            {
                extend: 'colvis',
                postfixButtons: ['colvisRestore']
            },
            'pageLength'

        ],
        columnDefs: [{
            visible: false
        }],
        autoWidth: false,
        select: true,
        fixedHeader: true,
        autoWidth: false,
        paging: true,
        scrollY: 400,
        scrollCollapse: true,
        scroller: true,
        pageLength: 50,
        scrollX: true,
    });
});


const flashDataSts = $('.flash-data-sts').data('flashdata');
const flashDataSuccess = $('.flash-data-success').data('flashdata');
const flashDataWarning = $('.flash-data-warning').data('flashdata');
const flashDataDanger = $('.flash-data-danger').data('flashdata');
if (flashDataSuccess) {
    Swal.fire({
        icon: "success",
        title: flashDataSuccess,
        showConfirmButton: true,
        timer: 6000
    })
}
if (flashDataWarning) {
    Swal.fire({
        icon: 'warning',
        title: flashDataWarning,
        showConfirmButton: true,
        timer: 6000
    })
}
if (flashDataDanger) {
    Swall.fire({
        icon: 'warning',
        title: flashDataDanger,
        showConfirmButton: true,
        timer: 6000
    })
}
