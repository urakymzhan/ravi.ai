$(document).ready(function() {
    $("#example").DataTable({
        aaSorting: [],
        responsive: true,

        columnDefs: [{
                responsivePriority: 1,
                targets: 0
            },
            {
                responsivePriority: 2,
                targets: -1
            },
            {
                responsivePriority: 3,
                targets: -1
            }
        ]
    });

    $('.getUserDetails').click(function(){
        // $('#userModal').modal('show');
        const id = $(this).data('userid');
       $.ajax({
           url:"server/get_user_details.php",
           type:"POST",
           data:{
               id:id
           },
           success:function(res){
                $('.userDetailsModal .modal-body').html(res);
                $('#userModal').modal('show');

           }
       })
    });
});