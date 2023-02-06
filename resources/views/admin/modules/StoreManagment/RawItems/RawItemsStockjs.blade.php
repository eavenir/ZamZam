<script>
    $(".loader").hide();

    var page_number = 1;
    variable_id_for_edit = "";
    var updated_ids_array = [];
    // data_table_pagination_RawItemStock();

    function data_table_pagination_RawItemStock() {
        $(function() {
            var table = $("#RawItemStock_Table").DataTable({
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

    function ShowRawItemStocks() {
        $("#RawItemStockModal").modal("show");
        $.ajax({
            url: "/RawItemStock_1",
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
                                    <td>${el.ItemId}</td>
                                    <td>${el.PRate}</td>
                                    <td>${el.VAT}</td>
                                    <td>${el.SRate}</td>
                                    <td>${el.Qty}</td>
                                    <td>${el.StoreName}</td>
                                    

                                    <td>
                                        <span style="cursor: pointer;" id="id_${el.id}" onclick="getSelectedRawItemStockData('${el.id}')">
                                            <i class="fa fa-fw fa-edit"></i> Edit
                                        </span>

                                        <span style="cursor: pointer;" onclick="DeleteRawItemStock('${el.id}')">
                                            <i class="fa fa-fw fa-eraser"></i> Delete
                                        </span>

                                    </td>
                                </tr>
        
        `;
                    });

                    document.getElementById("here_show_table_content_RawItemStock").innerHTML =
                        "";

                    var table = `
                        <table id="RawItemStock_Table" class="table">
                            <thead>
                            <tr>
                                    <th scope="col">ItemName</th>
                                    <th scope="col">Purchase Rate</th>
                                    <th scope="col">VAT</th>
                                    <th scope="col">Sale Rate</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Store Name</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody id="abc_RawItemStock">


                            </tbody>
                        </table>
`;

                    document.getElementById(
                        "here_show_table_content_RawItemStock"
                    ).innerHTML = table;

                    data_table_pagination_RawItemStock();

                    document.getElementById("abc_RawItemStock").innerHTML = tr;

                    for (var a = 0; a < updated_ids_array.length; a++) {
                        document.getElementById(updated_ids_array[a]).style =
                            "color:red;cursor:pointer";
                    }
                }
            }
        });
    }

    window.onload = event => {
        document.getElementById("RawItemStock").focus();
        document.getElementById("RawItemStock").select();
    };

    document.getElementById("RawItemStockError").style.display = "none";

    function insertRawItemStock() {
        var ItemName = document.getElementById("ItemName_Stock").value;
        var PRate = document.getElementById("PRate").value;
        var VAT = document.getElementById("VAT").value;
        var SRate = document.getElementById("SRate").value;
        var Qty = document.getElementById("Qty").value;
        var Store = document.getElementById("Store").value;
        var token = "{{csrf_token()}}";
        $.ajax({
            url: "/insertRawItemStock",
            type: "post",
            data: {
                ItemName: ItemName,
                PRate: PRate,
                VAT: VAT,
                SRate: SRate,
                Qty: Qty,
                Store: Store,
                AccountId: sessionStorage.getItem('Selected_Head'),
                _token: token
            },
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                // console.log(data)
                if (data == "inserted") {
                    $('.loader').hide()
                    clear_input_fields_RawItemStock();

                    var output = `
                <div class="alert alert-success">
                <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                Saved Successfuly
                </div>    
                        `;
                    document.getElementById(
                        "RawItemStock_updated_status"
                    ).innerHTML = output;
                }
            }
        });

        document.getElementById("RawItemStock").focus();
        document.getElementById("RawItemStock").select();
    }

    function getSelectedRawItemStockData(id) {
        if (id != "") {
            // clear_input_fields();
            $("#RawItemStockModal").modal("hide");
            $.ajax({
                url: "/RawItemStockEdit",
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
                    document.getElementById("RawItemStock_Id").value = data.RawItemStock.id;
                    document.getElementById("PRate").value = data.RawItemStock.PRate;
                    document.getElementById("VAT").value = data.RawItemStock.VAT;
                    document.getElementById("SRate").value = data.RawItemStock.SRate;
                    document.getElementById("Qty").value = data.RawItemStock.Qty;
                    var ItemName = '';
                    data.RawItem.forEach(el => {
                        ItemName += `
<option value="${el.ItemId}" ${el.ItemId == data.RawItemStock.ItemName ? 'selected' : ''}> ${el.ItemName} </option>
`;
                    });
                    document.getElementById('ItemName_Stock').innerHTML = ItemName

                    var ItemName = '';
                    data.Store.forEach(el => {
                        ItemName += `
<option value="${el.StoreId}" ${el.StoreId == data.RawItemStock.StoreName ? 'selected' : ''}> ${el.StoreName} </option>
`;
                    });
                    document.getElementById('Store').innerHTML = ItemName

                    $("#RawItemStockModal").modal("hide");
                },
                error: function(req, status, error) {
                    console.log(error);
                }
            });
        }
    }

    function DeleteRawItemStock(id) {
        var status = confirm("Want to delete ?");
        if (status) {
            $.ajax({
                url: "/RawItemStockDelete",
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
                        ShowRawItemStocks()
                        var output = `
                    <div class="alert alert-danger">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Deleted Successfuly
                    </div>    
                            `;
                        document.getElementById(
                            "RawItemStock_deleted_status"
                        ).innerHTML = output;
                    }
                }
            });
        }
    }

    function UpdateRawItemStock() {
       
        var formData = new FormData();
        formData.append("ItemName", document.getElementById("ItemName_Stock").value);
        formData.append("PRate", document.getElementById("PRate").value);
        formData.append("VAT", document.getElementById("VAT").value);
        formData.append("SRate", document.getElementById("SRate").value);
        formData.append("Qty", document.getElementById("Qty").value);
        formData.append("Store", document.getElementById("Store").value);

        formData.append("id", document.getElementById("RawItemStock_Id").value);

        formData.append("_token", "{{csrf_token()}}");

        $.ajax({
            url: "/updateRawItemStock",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                console.log(data);
                clear_input_fields_RawItemStock();
                if (data == "updated") {
                    $('.loader').hide()
                    var output = `
                    <div class="alert alert-success">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Updated Successfuly
                    </div>    
                            `;
                    document.getElementById(
                        "RawItemStock_updated_status"
                    ).innerHTML = output;
                }
            }
        });
    }

    function clear_input_fields_RawItemStock() {
        $('#ItemName_Stock').val('').trigger('change')
        document.getElementById("PRate").value = "";
        document.getElementById("VAT").value = "";
        document.getElementById("SRate").value = "";
        document.getElementById("Qty").value = "";
        $('#Store').val('').trigger('change')
    }
</script>