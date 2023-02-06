<script>
    $(".loader").hide()
    document.getElementById('UpdateStoreBtn').disabled = true;

    var page_number = 1;
    variable_id_for_edit = '';
    var updated_ids_array = [];
    // data_table_pagination_Store()

    function data_table_pagination_Store() {
        $(function() {
            var table = $('#table_Store').DataTable({
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

    function ShowStores() {
        $('#StoreModal').modal('show')
        $.ajax({
            url: '/Store_1',
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
                                        <td>${el.StoreName}</td>

                                        <td>
                                            <span style="cursor: pointer;" id="id_${el.id}" onclick="getValueForEdit_Store('${el.id}',this.id)">
                                                <i class="fa fa-fw fa-edit"></i> Edit
                                            </span>

                                            <span style="cursor: pointer;" onclick="confirmToDelete_Store('${el.id}')">
                                                <i class="fa fa-fw fa-eraser"></i> Delete
                                            </span>

                                        </td>
                                    </tr>
            
            `;

                    })

                    document.getElementById('here_show_table_content_Store').innerHTML = '';

                    var table = `
                            <table id="table_Store" class="table">
                                <thead>
                                <tr>
                                        <th scope="col">Store Name</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody id="abc_Store">


                                </tbody>
                            </table>
    `;


                    document.getElementById('here_show_table_content_Store').innerHTML = table;

                    data_table_pagination_Store()

                    document.getElementById('abc_Store').innerHTML = tr;

                    for (var a = 0; a < updated_ids_array.length; a++) {
                        document.getElementById(updated_ids_array[a]).style = "color:red;cursor:pointer";
                    }
                }


            }
        })
    }


    function insertStore() {

        var StoreName = document.getElementById('StoreName').value;
        var token = '{{csrf_token()}}';
        $.ajax({
            url: '/insertStore',
            type: 'post',
            data: {
                StoreName: StoreName,
                AccountId : sessionStorage.getItem('Selected_Head'),
                _token: token

            },
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                console.log(data)
                if (data == 'inserted') {
                    $('.loader').hide()

                    document.getElementById('StoreName').value = '';
                    // ShowStores();

                    var output = `
                    <div class="alert alert-success">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Saved Successfuly
                    </div>    
                            `;
                    document.getElementById(
                        "store_insert_status"
                    ).innerHTML = output;


                }
            }
        })

     
    }



    function confirmToDelete_Store(id) {
        var status = confirm('Want to delete ?');
        if (status) {
            // location.href = value;
            $.ajax({
                url: '/StoreDelete',
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
                        ShowStores()
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
                            "store_delete_status"
                        ).innerHTML = output;

                        ShowStores()
                    }
                }
            })
        }

    }

    function UpdateStore() {

        var StoreName = document.getElementById('StoreName').value;
        var store_id = document.getElementById('store_id').value;
        var token = '{{csrf_token()}}';
        $.ajax({
            url: '/updateStore',
            type: 'post',
            data: {
                StoreName: StoreName,
                id: store_id,
                _token: token

            },
            beforeSend : function(){
                $('.loader').show()
            },
            success: function(data) {
                console.log(data)
                if (data == 'updated') {
                    $('.loader').hide()
                    document.getElementById('UpdateStoreBtn').disabled = true;
                    document.getElementById('InsertStoreBtn').disabled = false;

                    document.getElementById('StoreName').value = '';
                    updated_ids_array.push(variable_id_for_edit)

                    var output = `
                    <div class="alert alert-success">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Updated Successfuly
                    </div>    
                            `;
                    document.getElementById(
                        "store_insert_status"
                    ).innerHTML = output;

                } else {
                    $('#exampleModal').modal('hide');

                }
            }
        })
    }

    function getValueForEdit_Store(id, id_for_edit) {
        document.getElementById('UpdateStoreBtn').disabled = false;
        document.getElementById('InsertStoreBtn').disabled = true;
        // document.getElementById('StoreName_id').value = id;
        variable_id_for_edit = id_for_edit;

        $.ajax({
            url: '/StoreEdit',
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
                    document.getElementById('store_id').value = data.StoreId;
                    document.getElementById('StoreName').value = data.StoreName;
                    $(".loader").hide();
                } else {
                    $(".loader").show();
                }
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        $('#StoreModal').modal('hide');
    }
</script>