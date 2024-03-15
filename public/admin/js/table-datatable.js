$(function () {
    "use strict";

    $(document).ready(function () {
        $('#example').DataTable();
    });

    // Appointments Table
    $(document).ready(function () {
        var appointment_table = $('#appointment').DataTable({
            lengthChange: false,
            language: { search: "", searchPlaceholder: "Search Here" },
            order: [[4, 'desc']],
            buttons: ['copy', 'excel', 'pdf', 'print']
        });

        appointment_table.buttons().container()
            .appendTo('#appointment_wrapper .col-md-6:eq(0)');

        var nurse_table = $('#nurse').DataTable({
            lengthChange: false,
            language: { search: "", searchPlaceholder: "Search Here" },
            buttons: ['copy', 'excel', 'pdf', 'print'],
            order: [[6, 'desc']],
        });

        nurse_table.buttons().container()
            .appendTo('#nurse_wrapper .col-md-6:eq(0)');


        var client_table = $('#client').DataTable({
            lengthChange: false,
            language: { search: "", searchPlaceholder: "Search Here" },
            order: [[6, 'desc']],
            buttons: ['copy', 'excel', 'pdf', 'print']
        });

        client_table.buttons().container()
            .appendTo('#client_wrapper .col-md-6:eq(0)');


        var admin_table = $('#admintable').DataTable({
            lengthChange: false,
            language: { search: "", searchPlaceholder: "Search Here" },
            buttons: ['copy', 'excel', 'pdf', 'print']
        });

        admin_table.buttons().container()
            .appendTo('#admintable_wrapper .col-md-6:eq(0)');

        var categories_table = $('#categories').DataTable({
            lengthChange: false,
            language: { search: "", searchPlaceholder: "Search Here" },
            buttons: ['copy', 'excel', 'pdf', 'print']
        });

        categories_table.buttons().container()
            .appendTo('#categories_wrapper .col-md-6:eq(0)');

        //Assigning Nurse Table
        $('#nurse_assign').DataTable({
            lengthChange: false,
            language: { search: "", searchPlaceholder: "Search Here" }
        });

        $('#nurse_assign_wrapper .col-md-6:eq(0)').append('<h6>' + document.getElementById('title').innerHTML + '</h6>');


    });


});
