<script>
    $(".loader").hide();

    var page_number = 1;
    variable_id_for_edit = "";
    var updated_ids_array = [];
    // data_table_pagination_RawItem();

    function data_table_pagination_RawItem() {
        $(function() {
            var table = $("#RawItem_Table").DataTable({
                drawCallback: function() {
                    $(
                        ".paginate_button",
                        this.api()
                        .table()
                        .container()
                    ).on("click", function(data) {
                        // console.log(data.currentTarget.innerText);
                        page_number = data.currentTarget.innerText;
                    });
                }
            });
            table.page(page_number - 1).draw("page");
        });
    }

    function ShowRawItem() {
        $("#RawItemModal").modal("show");
        $.ajax({
            url: "/RawItems_1",
            type: "get",
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                console.log(data);
                if (data) {
                    $('.loader').hide()
                    var tr = ``;
                    data.forEach(el => {
                        tr += `
                <tr>
                                    <td>${el.ItemName}</td>

                                    <td>${el.ItemName_Arabic}</td>

                                    <td>${el.ItemSubCategory}</td>
                                    <td>${el.Unit}</td>

                                    <td>
                                        <span style="cursor: pointer;" id="id_${el.id}" onclick="getSelectedRawItemData('${el.id}')">
                                            <i class="fa fa-fw fa-edit"></i> Edit
                                        </span>

                                        <span style="cursor: pointer;" onclick="DeleteRawItem('${el.id}')">
                                            <i class="fa fa-fw fa-eraser"></i> Delete
                                        </span>

                                    </td>
                                </tr>
        
        `;
                    });

                    document.getElementById("here_show_table_content_RawItem").innerHTML =
                        "";

                    var table = `
                        <table id="RawItem_Table" class="table">
                            <thead>
                            <tr>
                                    <th scope="col">ItemName</th>
                                    <th scope="col">اسم العنصر</th>

                                    <th scope="col">Item Sub Category</th>
                                    <th scope="col">Unit</th>

                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody id="abc_RawItem">


                            </tbody>
                        </table>
`;

                    document.getElementById(
                        "here_show_table_content_RawItem"
                    ).innerHTML = table;

                    data_table_pagination_RawItem();

                    document.getElementById("abc_RawItem").innerHTML = tr;

                    for (var a = 0; a < updated_ids_array.length; a++) {
                        document.getElementById(updated_ids_array[a]).style =
                            "color:red;cursor:pointer";
                    }
                }
            }
        });
    }



    function insertRawItem() {
        var ItemName = document.getElementById("ItemName").value;
        var ItemName_Arabic = document.getElementById("ItemName_Arabic").value;
        var ItemSubCategory = document.getElementById("ItemSubCategory").value;
        var Unit = document.getElementById("Unit").value;
        var token = "{{csrf_token()}}";
        $.ajax({
            url: "/insertRawItems",
            type: "post",
            data: {
                ItemName: ItemName,
                ItemName_Arabic: ItemName_Arabic,
                ItemSubCategory: ItemSubCategory,
                Unit: Unit,
                _token: token
            },
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                console.log(data)
                if (data == "inserted") {
                    $('.loader').hide()
                    clear_input_fields_RawItem();

                    var output = `
                <div class="alert alert-success">
                <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                Saved Successfuly
                </div>    
                        `;
                    document.getElementById(
                        "RawItem_updated_status"
                    ).innerHTML = output;
                }
            }
        });

    }

    function getSelectedRawItemData(id) {
        if (id != "") {
            // clear_input_fields();
            $("#RawItemModal").modal("hide");
            $.ajax({
                url: "/RawItemsEdit",
                type: "get",
                data: {
                    id: id
                },
                beforeSend: function() {
                    $(".loader").show();
                },

                success: function(data) {
                    console.log(data);
                    $('.loader').hide()
                    document.getElementById("RawItem_Id").value = data.RawItem.ItemId;
                    document.getElementById("ItemName").value = data.RawItem.ItemName;
                    document.getElementById("ItemName_Arabic").value = data.RawItem.ItemName_Arabic;

                    var ItemSubCategory = '';
                    data.ItemSubCategory.forEach(el => {
                        ItemSubCategory += `
<option value="${el.SubCategoryId}" ${el.SubCategoryId == data.RawItem.ItemSubCategory ? 'selected' : ''}> ${el.SubCategory} </option>
`;
                    })

                    document.getElementById('ItemSubCategory').innerHTML = ItemSubCategory;


                    var Unit = '';
                    data.Unit.forEach(el => {
                        Unit += `
<option value="${el.id}" ${el.id == data.RawItem.Unit ? 'selected' : ''}> ${el.Unit} </option>
`;
                    })

                    document.getElementById('Unit').innerHTML = Unit;



                    $("#RawItemModal").modal("hide");
                },
                error: function(req, status, error) {
                    console.log(error);
                }
            });
        }
    }

    function DeleteRawItem(id) {
        var status = confirm("Want to delete ?");
        if (status) {
            $.ajax({
                url: "/RawItemsDelete",
                type: "get",
                data: {
                    id: id
                },
                beforeSend: function() {
                    $('.loader').show()
                },
                success: function(data) {
                    console.log(data);
                    if (data == "deleted") {
                        $('.loader').hide()
                        ShowRawItem()
                        var output = `
                    <div class="alert alert-danger">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Deleted Successfuly
                    </div>    
                            `;
                        document.getElementById(
                            "RawItem_deleted_status"
                        ).innerHTML = output;
                    }
                }
            });
        }
    }

    function UpdateRawItem() {
        var formData = new FormData();
        formData.append("ItemName", document.getElementById("ItemName").value);
        formData.append("ItemName_Arabic", document.getElementById("ItemName_Arabic").value);
        formData.append("ItemSubCategory", document.getElementById("ItemSubCategory").value);
        formData.append("Unit", document.getElementById("Unit").value);
        formData.append("id", document.getElementById("RawItem_Id").value);

        formData.append("_token", "{{csrf_token()}}");

        $.ajax({
            url: "/updateRawItems",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                console.log(data);
                clear_input_fields_RawItem();
                if (data == "updated") {
                    $('.loader').hide()
                    var output = `
                    <div class="alert alert-success">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Updated Successfuly
                    </div>    
                            `;
                    document.getElementById(
                        "RawItem_updated_status"
                    ).innerHTML = output;
                }
            }
        });
    }

    function clear_input_fields_RawItem() {
        document.getElementById("ItemName").value = "";
        document.getElementById("ItemName_Arabic").value = "";
        $('#ItemSubCategory').val('Sub Menu...').trigger('change')
        $('#Unit').val('Sub Menu...').trigger('change')
    }
</script>