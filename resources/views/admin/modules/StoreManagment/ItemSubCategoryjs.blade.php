<script>
    $(".loader").hide()
    document.getElementById('UpdateItemSubCategoryBtn').disabled = true;

    var page_number = 1;
    variable_id_for_edit = '';
    var updated_ids_array = [];
    // data_table_pagination_ItemSubCategory()

    function data_table_pagination_ItemSubCategory() {
        $(function() {
            var table = $('#table_ItemSubCategory').DataTable({
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

    function ShowItemSubCategory() {
        $('#ItemSubCategoryModal').modal('show')
        $.ajax({
            url: '/ItemSubCategory_1',
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
                                        <td>${el.SubCategory}</td>
                                        <td> ${el.ItemCategoryId} </td>

                                        <td>
                                            <span style="cursor: pointer;" id="id_${el.id}" onclick="getValueForEdit_ItemSubCategory('${el.id}',this.id)">
                                                <i class="fa fa-fw fa-edit"></i> Edit
                                            </span>

                                            <span style="cursor: pointer;" onclick="confirmToDelete_ItemSubCategory('${el.id}')">
                                                <i class="fa fa-fw fa-eraser"></i> Delete
                                            </span>

                                        </td>
                                    </tr>
            
            `;

                    })

                    document.getElementById('here_show_table_content_ItemSubCategory').innerHTML = '';

                    var table = `
                            <table id="table_ItemSubCategory" class="table">
                                <thead>
                                <tr>
                                        <th scope="col">Sub Category</th>
                                        <th scope="col">Item Category</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody id="abc_ItemSubCategory">


                                </tbody>
                            </table>
    `;


                    document.getElementById('here_show_table_content_ItemSubCategory').innerHTML = table;

                    data_table_pagination_ItemSubCategory()

                    document.getElementById('abc_ItemSubCategory').innerHTML = tr;

                    for (var a = 0; a < updated_ids_array.length; a++) {
                        document.getElementById(updated_ids_array[a]).style = "color:red;cursor:pointer";
                    }
                }


            }
        })
    }


    function insertItemSubCategory() {

        var ItemSubCategory = document.getElementById('ItemSubCategory').value;
        var ItemCategory = document.getElementById('ItemCategory').value;
        var token = '{{csrf_token()}}';
        $.ajax({
            url: '/insertItemSubCategory',
            type: 'post',
            data: {
                ItemSubCategory: ItemSubCategory,
                ItemCategory: ItemCategory,
                _token: token

            },
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                console.log(data)
                if (data == 'inserted') {
                    $('.loader').hide()

                    document.getElementById('ItemSubCategory').value = '';
                    $('#ItemCategory').val('').trigger('change')
                    // ShowItemSubCategory();

                    var output = `
                    <div class="alert alert-success">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Saved Successfuly
                    </div>    
                            `;
                    document.getElementById(
                        "ItemSubCategory_insert_status"
                    ).innerHTML = output;


                }
            }
        })


    }



    function confirmToDelete_ItemSubCategory(id) {
        var status = confirm('Want to delete ?');
        if (status) {
            // location.href = value;
            $.ajax({
                url: '/ItemSubCategoryDelete',
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
                        ShowItemSubCategory()
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
                            "ItemSubCategory_delete_status"
                        ).innerHTML = output;

                        ShowItemSubCategory()
                    }
                }
            })
        }

    }

    function UpdateItemSubCategory() {

        var ItemSubCategory = document.getElementById('ItemSubCategory').value;
        var ItemCategory = document.getElementById('ItemCategory').value;
        var ItemSubCategory_id = document.getElementById('ItemSubCategory_id').value;
        var token = '{{csrf_token()}}';
        $.ajax({
            url: '/updateItemSubCategory',
            type: 'post',
            data: {
                ItemSubCategory: ItemSubCategory,
                ItemCategory: ItemCategory,
                id: ItemSubCategory_id,
                _token: token

            },
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                console.log(data)
                if (data == 'updated') {
                    $('.loader').hide()
                    document.getElementById('UpdateItemSubCategoryBtn').disabled = true;
                    document.getElementById('InsertItemSubCategoryBtn').disabled = false;

                    document.getElementById('ItemSubCategory').value = '';

                    $('#ItemCategory').val('').trigger('change');

                    updated_ids_array.push(variable_id_for_edit)

                    var output = `
                    <div class="alert alert-success">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Updated Successfuly
                    </div>    
                            `;
                    document.getElementById(
                        "ItemSubCategory_insert_status"
                    ).innerHTML = output;

                } else {
                    $('#ItemSubCategoryModal').modal('hide');

                }
            }
        })
    }

    function getValueForEdit_ItemSubCategory(id, id_for_edit) {
        document.getElementById('UpdateItemSubCategoryBtn').disabled = false;
        document.getElementById('InsertItemSubCategoryBtn').disabled = true;
        // document.getElementById('StoreName_id').value = id;
        variable_id_for_edit = id_for_edit;

        $.ajax({
            url: '/ItemSubCategoryEdit',
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
                    document.getElementById('ItemSubCategory_id').value = data.SubCategory.SubCategoryId;
                    document.getElementById('ItemSubCategory').value = data.SubCategory.SubCategory;
                    var ItemCategory = '';
                    data.ItemCategory.forEach(el => {
                        ItemCategory += `
                        <option value="${el.ItemCategoryId}" ${el.ItemCategoryId == data.SubCategory.ItemCategoryId ? 'selected' : ''}> ${el.ItemCategory} </option>
                        `;
                    });
                    document.getElementById('ItemCategory').innerHTML = ItemCategory;
                    $(".loader").hide();
                } else {
                    $(".loader").show();
                }
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        $('#ItemSubCategoryModal').modal('hide');
    }
</script>