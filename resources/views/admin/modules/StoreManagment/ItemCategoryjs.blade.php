<script>
    $(".loader").hide()
    document.getElementById('UpdateItemCategoryBtn').disabled = true;

    var page_number = 1;
    variable_id_for_edit = '';
    var updated_ids_array = [];
    // data_table_pagination_ItemCategory()

    function data_table_pagination_ItemCategory() {
        $(function() {
            var table = $('#table_ItemCategory').DataTable({
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

    function ShowItemCategory() {
        $('#ItemCategoryModal').modal('show')
        $.ajax({
            url: '/ItemCategory_1',
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
                                        <td>${el.ItemCategory}</td>

                                        <td>
                                            <span style="cursor: pointer;" id="id_${el.id}" onclick="getValueForEdit_ItemCategory('${el.id}',this.id)">
                                                <i class="fa fa-fw fa-edit"></i> Edit
                                            </span>

                                            <span style="cursor: pointer;" onclick="confirmToDelete_ItemCategory('${el.id}')">
                                                <i class="fa fa-fw fa-eraser"></i> Delete
                                            </span>

                                        </td>
                                    </tr>
            
            `;

                    })

                    document.getElementById('here_show_table_content_ItemCategory').innerHTML = '';

                    var table = `
                            <table id="table_ItemCategory" class="table">
                                <thead>
                                <tr>
                                        <th scope="col">Store Name</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody id="abc_ItemCategory">


                                </tbody>
                            </table>
    `;


                    document.getElementById('here_show_table_content_ItemCategory').innerHTML = table;

                    data_table_pagination_ItemCategory()

                    document.getElementById('abc_ItemCategory').innerHTML = tr;

                    for (var a = 0; a < updated_ids_array.length; a++) {
                        document.getElementById(updated_ids_array[a]).style = "color:red;cursor:pointer";
                    }
                }


            }
        })
    }



    function insertItemCategory() {

        var ItemCategory = document.getElementById('ItemCategory').value;
        var token = '{{csrf_token()}}';
        $.ajax({
            url: '/insertItemCategory',
            type: 'post',
            data: {
                ItemCategory: ItemCategory,
                AccountId: sessionStorage.getItem('Selected_Head'),
                _token: token

            },
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                console.log(data)
                if (data == 'inserted') {
                    $('.loader').hide()

                    document.getElementById('ItemCategory').value = '';
                    // ShowItemCategory();

                    var output = `
                    <div class="alert alert-success">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Saved Successfuly
                    </div>    
                            `;
                    document.getElementById(
                        "ItemCategory_insert_status"
                    ).innerHTML = output;


                }
            }
        })

    }



    function confirmToDelete_ItemCategory(id) {
        var status = confirm('Want to delete ?');
        if (status) {
            // location.href = value;
            $.ajax({
                url: '/ItemCategoryDelete',
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
                        ShowItemCategory()
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
                            "ItemCategory_delete_status"
                        ).innerHTML = output;

                        ShowItemCategory()
                    }
                }
            })
        }

    }

    function UpdateItemCategory() {

        var ItemCategory = document.getElementById('ItemCategory').value;
        var ItemCategory_id = document.getElementById('ItemCategory_id').value;
        var token = '{{csrf_token()}}';
        $.ajax({
            url: '/updateItemCategory',
            type: 'post',
            data: {
                ItemCategory: ItemCategory,
                id: ItemCategory_id,
                _token: token

            },
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                console.log(data)
                if (data == 'updated') {
                    $('.loader').hide()
                    document.getElementById('UpdateItemCategoryBtn').disabled = true;
                    document.getElementById('InsertItemCategoryBtn').disabled = false;

                    document.getElementById('ItemCategory').value = '';
                    updated_ids_array.push(variable_id_for_edit)

                    var output = `
                    <div class="alert alert-success">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Updated Successfuly
                    </div>    
                            `;
                    document.getElementById(
                        "ItemCategory_insert_status"
                    ).innerHTML = output;

                } else {
                    $('#ItemCategoryModal').modal('hide');

                }
            }
        })
    }

    function getValueForEdit_ItemCategory(id, id_for_edit) {
        document.getElementById('UpdateItemCategoryBtn').disabled = false;
        document.getElementById('InsertItemCategoryBtn').disabled = true;
        // document.getElementById('StoreName_id').value = id;
        variable_id_for_edit = id_for_edit;

        $.ajax({
            url: '/ItemCategoryEdit',
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
                    document.getElementById('ItemCategory_id').value = data.ItemCategoryId;
                    document.getElementById('ItemCategory').value = data.ItemCategory;
                    $(".loader").hide();
                } else {
                    $(".loader").show();
                }
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        $('#ItemCategoryModal').modal('hide');
    }
</script>