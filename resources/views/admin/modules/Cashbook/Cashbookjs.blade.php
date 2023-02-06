<script>
    $(".loader").hide()
    document.getElementById('UpdateCashbookBtn').disabled = true;

    var page_number = 1;
    variable_id_for_edit = '';
    var updated_ids_array = [];
    // data_table_pagination_Cashbook()

    function data_table_pagination_Cashbook() {
        $(function() {
            var table = $('#Cashbook_table').DataTable({
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

    function ShowCashbook() {
        $('#CashbookModal').modal('show')
        $.ajax({
            url: '/Cashbook_1',
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
                                        <td>${el.Date}</td>
                                        <td>${el.FromAccount}</td>
                                        <td>${el.ToAccount}</td>
                                        <td>${el.Amount}</td>
                                        
                                        
                                        <td>
                                            <span style="cursor: pointer;" id="id_${el.id}" onclick="getValueForEdit_Cashbook('${el.id}',this.id)">
                                                <i class="fa fa-fw fa-edit"></i> Edit
                                            </span>

                                            <span style="cursor: pointer;" onclick="confirmToDelete_Cashbook('${el.id}')">
                                                <i class="fa fa-fw fa-eraser"></i> Delete
                                            </span>

                                        </td>
                                    </tr>
            
            `;

                    })

                    document.getElementById('here_show_table_content_Cashbook').innerHTML = '';

                    var table = `
                            <table id="Cashbook_table" class="table">
                                <thead>
                                <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">From Account</th>
                                        <th scope="col">To Account</th>
                                        <th scope="col">Amount</th>\
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody id="abc_Cashbook">


                                </tbody>
                            </table>
    `;


                    document.getElementById('here_show_table_content_Cashbook').innerHTML = table;

                    data_table_pagination_Cashbook()

                    document.getElementById('abc_Cashbook').innerHTML = tr;

                    for (var a = 0; a < updated_ids_array.length; a++) {
                        document.getElementById(updated_ids_array[a]).style = "color:red;cursor:pointer";
                    }

                }

            }
        })
    }



    function insertCashbook() {

        var Date = document.getElementById('Date').value
        var FromAccount = document.getElementById('FromAccount').value;
        var ToAccount = document.getElementById('ToAccount').value
        var Amount = document.getElementById('Amount').value
        var Remarks = document.getElementById('Remarks').value
        var AccountId = sessionStorage.getItem('Selected_Head')


        var token = '{{csrf_token()}}';
        $.ajax({
            url: '/insertCashbook',
            type: 'post',
            data: {
                Date: Date,
                FromAccount: FromAccount,
                ToAccount: ToAccount,
                Amount: Amount,
                Remarks: Remarks,
                AccountId: AccountId,

                _token: token

            },
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                console.log(data)
                if (data == 'inserted') {
                    $('.loader').hide()
                    document.getElementById('Date').value = ''
                    $('#FromAccount').val('').trigger('change');
                    $('#ToAccount').val('').trigger('change');
                    document.getElementById('Amount').value = ''
                    document.getElementById('Remarks').value = ''

                }
            }
        })


    }



    function confirmToDelete_Cashbook(id) {
        var status = confirm('Want to delete ?');
        if (status) {
            // location.href = value;
            $.ajax({
                url: '/CashbookDelete',
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
                        var index = updated_ids_array.indexOf('id_' + id);
                        if (index != -1) {
                            updated_ids_array.splice(index, 1);
                        }
                        alert("Cashbook is deleted successfully !")
                        ShowCashbook()
                    }
                }
            })
        }

    }


    function UpdateCashbook() {

        var Date = document.getElementById('Date').value
        var FromAccount = document.getElementById('FromAccount').value;
        var ToAccount = document.getElementById('ToAccount').value
        var Amount = document.getElementById('Amount').value
        var Remarks = document.getElementById('Remarks').value

        var Cashbook_id = document.getElementById('Cashbook_id').value;
        var token = '{{csrf_token()}}';
        $.ajax({
            url: '/updateCashbook',
            type: 'post',
            data: {
                Date: Date,
                FromAccount: FromAccount,
                ToAccount: ToAccount,
                Amount: Amount,
                Remarks: Remarks,
                id: Cashbook_id,
                _token: token

            },
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                console.log(data)
                if (data == 'updated') {
                    $('.loader').hide()
                    document.getElementById('InsertCashbookBtn').disabled = false;
                    document.getElementById('UpdateCashbookBtn').disabled = true;

                    document.getElementById('Date').value = ''
                    $('#FromAccount').val('').trigger('change');
                    $('#ToAccount').val('').trigger('change');
                    document.getElementById('Amount').value = ''
                    document.getElementById('Remarks').value = ''

                    updated_ids_array.push(variable_id_for_edit)

                } else {
                    $('#CashbookModal').modal('hide');

                }
            }
        })
    }

    function getValueForEdit_Cashbook(id, id_for_edit) {
        document.getElementById('InsertCashbookBtn').disabled = true;
        document.getElementById('UpdateCashbookBtn').disabled = false;
        $('#CashbookModal').modal('hide')
        variable_id_for_edit = id_for_edit;

        $.ajax({
            url: '/CashbookEdit',
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
                    document.getElementById('Cashbook_id').value = data.Cashbook.id;
                    document.getElementById('Date').value = data.Cashbook.Date;
                    document.getElementById('Amount').value = data.Cashbook.Amount;
                    document.getElementById('Remarks').value = data.Cashbook.Remarks;

                    var FromAccount = '';
                    data.Accounts.forEach(el => {
                        FromAccount += `
<option value="${el.AccountName}" ${data.Cashbook.FromAccount == el.AccountName ? 'selected' : ''}>${el.AccountName} (Bank)</option>
`;
                    });


                    data.Buyers.forEach(el => {
                        FromAccount += `
<option value="${el.AccountName}" ${data.Cashbook.FromAccount == el.AccountName ? 'selected' : ''}>${el.AccountName} (Buyer)</option>
`;
                    });


                    data.Suppliers.forEach(el => {
                        FromAccount += `
<option value="${el.AccountName}" ${data.Cashbook.FromAccount == el.AccountName ? 'selected' : ''}>${el.AccountName} (Supplier)</option>
`;
                    });

                    document.getElementById('FromAccount').innerHTML = FromAccount;




                    var ToAccount = '';
                    data.Accounts.forEach(el => {
                        ToAccount += `
<option value="${el.AccountName}" ${data.Cashbook.FromAccount == el.AccountName ? 'selected' : ''}>${el.AccountName}</option>
`;
                    });


                    data.Buyers.forEach(el => {
                        ToAccount += `
<option value="${el.AccountName}" ${data.Cashbook.FromAccount == el.AccountName ? 'selected' : ''}>${el.AccountName}</option>
`;
                    });


                    data.Suppliers.forEach(el => {
                        ToAccount += `
<option value="${el.AccountName}" ${data.Cashbook.FromAccount == el.AccountName ? 'selected' : ''}>${el.AccountName}</option>
`;
                    });

                    document.getElementById('ToAccount').innerHTML = ToAccount;

                    var ToAccount = '';
                    data.Suppliers.forEach(el => {
                        ToAccount += `
<option ${data.Cashbook.ToAccount == el.AccountName ? 'selected' : ''}>${el.AccountName}</option>
`;
                    });

                    document.getElementById('ToAccount').innerHTML = ToAccount

                    $(".loader").hide();
                } else {
                    $(".loader").show();
                }
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
    }
</script>