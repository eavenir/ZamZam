<script>
    $(".loader").hide()
    document.getElementById('UpdateExpenseBtn').disabled = true;

    var page_number = 1;
    variable_id_for_edit = '';
    var updated_ids_array = [];
    // data_table_pagination_expense()

    function data_table_pagination_expense() {
        $(function() {
            var table = $('#expense_table').DataTable({
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

    function ShowExpense() {
        $('#ExpenseModal').modal('show')
        $.ajax({
            url: '/Expense_1',
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
                                        <td>${el.ExpenseType}</td>
                                        <td>${el.Amount}</td>
                                        <td>${el.VATPercent}</td>
                                        <td>${el.VATAmount}</td>
                                        
                                        <td>
                                            <span style="cursor: pointer;" id="id_${el.id}" onclick="getValueForEdit_expense('${el.id}',this.id)">
                                                <i class="fa fa-fw fa-edit"></i> Edit
                                            </span>

                                            <span style="cursor: pointer;" onclick="confirmToDelete_expense('${el.id}')">
                                                <i class="fa fa-fw fa-eraser"></i> Delete
                                            </span>

                                        </td>
                                    </tr>
            
            `;

                    })

                    document.getElementById('here_show_table_content_expense').innerHTML = '';

                    var table = `
                            <table id="expense_table" class="table">
                                <thead>
                                <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">From Account</th>
                                        <th scope="col">Expense Type</th>
                                        <th scope="col">Amount</th>\
                                        <th scope="col">VAT %</th>
                                        <th scope="col">VAT Amount</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody id="abc_expense">


                                </tbody>
                            </table>
    `;


                    document.getElementById('here_show_table_content_expense').innerHTML = table;

                    data_table_pagination_expense()

                    document.getElementById('abc_expense').innerHTML = tr;

                    for (var a = 0; a < updated_ids_array.length; a++) {
                        document.getElementById(updated_ids_array[a]).style = "color:red;cursor:pointer";
                    }

                }

            }
        })
    }



    function insertExpense() {

        var Date = document.getElementById('Date').value
        var FromAccount = document.getElementById('FromAccount').value;
        var ExpenseType = document.getElementById('ExpenseType_Expense').value
        var Amount = document.getElementById('Amount').value
        var VATPercent = document.getElementById('VATPercent').value
        var VATAmount = document.getElementById('VATAmount').value
        var Remarks = document.getElementById('Remarks').value
        var AccountId = sessionStorage.getItem('Selected_Head')


        var token = '{{csrf_token()}}';
        $.ajax({
            url: '/insertExpense',
            type: 'post',
            data: {
                Date: Date,
                FromAccount: FromAccount,
                ExpenseType: ExpenseType,
                Amount: Amount,
                VATPercent: VATPercent,
                VATAmount: VATAmount,
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
                    $('#ExpenseType_Expense').val('').trigger('change');
                    document.getElementById('Amount').value = ''
                    document.getElementById('VATPercent').value = ''
                    document.getElementById('VATAmount').value = ''
                    document.getElementById('Remarks').value = ''

                }
            }
        })


    }



    function confirmToDelete_expense(id) {
        var status = confirm('Want to delete ?');
        if (status) {
            // location.href = value;
            $.ajax({
                url: '/ExpenseDelete',
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
                        alert("Expense is deleted successfully !")
                        ShowExpense()
                    }
                }
            })
        }

    }


    function UpdateExpense() {

        var Date = document.getElementById('Date').value
        var FromAccount = document.getElementById('FromAccount').value;
        var ExpenseType = document.getElementById('ExpenseType_Expense').value
        var Amount = document.getElementById('Amount').value
        var VATPercent = document.getElementById('VATPercent').value
        var VATAmount = document.getElementById('VATAmount').value
        var Remarks = document.getElementById('Remarks').value

        var Expense_id = document.getElementById('Expense_id').value;
        var token = '{{csrf_token()}}';
        $.ajax({
            url: '/updateExpense',
            type: 'post',
            data: {
                Date: Date,
                FromAccount: FromAccount,
                ExpenseType: ExpenseType,
                Amount: Amount,
                VATPercent: VATPercent,
                VATAmount: VATAmount,
                Remarks: Remarks,
                id: Expense_id,
                _token: token

            },
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                console.log(data)
                if (data == 'updated') {
                    $('.loader').hide()
                    document.getElementById('InsertExpenseBtn').disabled = false;
                    document.getElementById('UpdateExpenseBtn').disabled = true;

                    document.getElementById('Date').value = ''
                    $('#FromAccount').val('').trigger('change');
                    $('#ExpenseType_Expense').val('').trigger('change');
                    document.getElementById('Amount').value = ''
                    document.getElementById('VATPercent').value = ''
                    document.getElementById('VATAmount').value = ''
                    document.getElementById('Remarks').value = ''

                    updated_ids_array.push(variable_id_for_edit)

                } else {
                    $('#ExpenseModal').modal('hide');

                }
            }
        })
    }

    function getValueForEdit_expense(id, id_for_edit) {
        document.getElementById('InsertExpenseBtn').disabled = true;
        document.getElementById('UpdateExpenseBtn').disabled = false;
        $('#ExpenseModal').modal('hide')
        variable_id_for_edit = id_for_edit;

        $.ajax({
            url: '/ExpenseEdit',
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
                    document.getElementById('Expense_id').value = data.Expense.id;
                    document.getElementById('Date').value = data.Expense.Date;
                    document.getElementById('Amount').value = data.Expense.Amount;
                    document.getElementById('VATPercent').value = data.Expense.VATPercent;
                    document.getElementById('VATAmount').value = data.Expense.VATAmount;
                    document.getElementById('Remarks').value = data.Expense.Remarks;
                    var FromAccount = '';
                    data.Accounts.forEach(el => {
                        FromAccount += `
<option ${data.Expense.FromAccount == el.id ? 'selected' : ''}>${el.AccountName}</option>
`;
                    });

                    document.getElementById('FromAccount').innerHTML = FromAccount;

                    var ExpenseType = '';
                    data.ExpenseType.forEach(el => {
                        ExpenseType += `
<option ${data.Expense.ExpenseType == el.id ? 'selected' : ''}>${el.ExpenseType}</option>
`;
                    });

                    document.getElementById('ExpenseType_Expense').innerHTML = ExpenseType

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