<script>
    $(".loader").hide()
    document.getElementById('UpdateCostCenterBtn').disabled = true;

    var page_number = 1;
    variable_id_for_edit = '';
    var updated_ids_array = [];
    // data_table_pagination_CS()

    function data_table_pagination_CS() {
        $(function() {
            var table = $('#table_cost_center_name').DataTable({
                drawCallback: function() {
                    $('.paginate_button', this.api().table().container()).on('click', function(data) {
                        // console.log(data.currentTarget.innerText);
                        page_number = data.currentTarget.innerText;
                    });
                },

            })
            table.page(page_number - 1).draw('page');
        })
    }

    function showUpdated_CostCenterName() {
        $('#CostCenterNameModal').modal('show')
        $.ajax({
            url: '/CostCenterName_1',
            type: 'get',
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                console.log(data)
                if (data) {
                    $('.loader').hide()
                    var tr = ``;
                    data.forEach((el) => {

                        tr += `
                    <tr>
                                        <td>${el.CostCenterName}</td>

                                        <td>
                                            <span style="cursor: pointer;" id="id_${el.id}" onclick="getValueForEdit_CS('${el.id}',this.id)">
                                                <i class="fa fa-fw fa-edit"></i> Edit
                                            </span>

                                            <span style="cursor: pointer;" onclick="confirmToDelete('${el.id}')">
                                                <i class="fa fa-fw fa-eraser"></i> Delete
                                            </span>

                                        </td>
                                    </tr>
            
            `;

                    })

                    document.getElementById('here_show_table_content_CS').innerHTML = '';

                    var table = `
                            <table id="table_cost_center_name" class="table">
                                <thead>
                                <tr>
                                        <th scope="col">Cost Center Name</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody id="abc_CS">


                                </tbody>
                            </table>
    `;


                    document.getElementById('here_show_table_content_CS').innerHTML = table;

                    data_table_pagination_CS()

                    document.getElementById('abc_CS').innerHTML = tr;

                    for (var a = 0; a < updated_ids_array.length; a++) {
                        document.getElementById(updated_ids_array[a]).style = "color:red;cursor:pointer";
                    }
                }


            }
        })
    }


    window.onload = (event) => {
        document.getElementById('CostCenterName').focus()
        document.getElementById('CostCenterName').select();
    };


    function insertCostCenterName() {

        var CostCenterName = document.getElementById('CostCenterName').value;
        var token = '{{csrf_token()}}';
        $.ajax({
            url: '/insertCostCenterName',
            type: 'post',
            data: {
                CostCenterName: CostCenterName,
                _token: token

            },
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                // console.log(data)
                if (data == 'inserted') {
                    $('.loader').hide()

                    document.getElementById('CostCenterName').value = '';
                    // showUpdated_CostCenterName();

                    var output = `
                    <div class="alert alert-success">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Saved Successfuly
                    </div>    
                            `;
                    document.getElementById(
                        "cost_center_name_insert_status"
                    ).innerHTML = output;


                }
            }
        })

        document.getElementById('CostCenterName').focus()
        document.getElementById('CostCenterName').select();
    }



    function confirmToDelete(id) {
        var status = confirm('Want to delete ?');
        if (status) {
            // location.href = value;
            $.ajax({
                url: '/CostCenterNameDelete',
                type: 'get',
                data: {
                    id: id
                },
                beforeSend: function() {
                    $('.loader').show()
                },
                success: function(data) {
                    // console.log(data)
                    if (data == 'deleted') {
                        $('.loader').hide()
                        showUpdated_CostCenterName()
                        var index = updated_ids_array.indexOf('id_' + id);
                        if (index != -1) {
                            updated_ids_array.splice(index, 1);
                        }

                        var output = `
                    <div class="alert alert-danger">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Deleted Successfuly
                    </div>    
                            `;
                        document.getElementById(
                            "cost_center_name_delet_status"
                        ).innerHTML = output;

                        // showUpdated_CostCenterName()
                    }
                }
            })
        }

    }

    function updateCostCenterName() {

        var CostCenterName = document.getElementById('CostCenterName').value;
        var CostCenterName_id = document.getElementById('CostCenterName_id').value;
        var token = '{{csrf_token()}}';
        $.ajax({
            url: '/updateCostCenterName',
            type: 'post',
            data: {
                CostCenterName: CostCenterName,
                id: CostCenterName_id,
                _token: token

            },
            beforeSend : function(){
                $('.loader').show()
            },
            success: function(data) {
                console.log(data)
                if (data == 'updated') {
                    $('.loader').hide()
                    document.getElementById('UpdateCostCenterBtn').disabled = true;
                    document.getElementById('InsertCostCenterBtn').disabled = false;

                    document.getElementById('CostCenterName').value = '';
                    updated_ids_array.push(variable_id_for_edit)

                    var output = `
                    <div class="alert alert-success">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Updated Successfuly
                    </div>    
                            `;
                    document.getElementById(
                        "cost_center_name_insert_status"
                    ).innerHTML = output;

                } else {
                    $('#exampleModal').modal('hide');

                }
            }
        })
    }

    function getValueForEdit_CS(id, id_for_edit) {
        document.getElementById('UpdateCostCenterBtn').disabled = false;
        document.getElementById('InsertCostCenterBtn').disabled = true;
        // document.getElementById('CostCenterName_id').value = id;
        variable_id_for_edit = id_for_edit;

        $.ajax({
            url: '/CostCenterNameEdit',
            type: 'get',
            data: {
                id: id
            },
            beforeSend: function() {
                $(".loader").show();
            },

            success: function(data) {
                console.log(data)
                if (data != '') {
                    document.getElementById('CostCenterName_id').value = data.CostCenterName;
                    document.getElementById('CostCenterName').value = data.CostCenterName;
                    $(".loader").hide();
                } else {
                    $(".loader").show();
                }
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        $('#CostCenterNameModal').modal('hide');
    }
</script>