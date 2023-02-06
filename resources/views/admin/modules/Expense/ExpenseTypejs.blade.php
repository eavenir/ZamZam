<script>
    $(".loader").hide()
    document.getElementById('UpdateExpenseTypeBtn').disabled = true;

    var page_number = 1;
    variable_id_for_edit = '';
    var updated_ids_array = [];
    // data_table_pagination_bank()

    function data_table_pagination_bank() {
        $(function() {
            var table = $('#bank_table').DataTable({
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

    function ShowExpenseType() {
        $('#ExpenseTypeModal').modal('show')
        $.ajax({
            url: '/ExpenseType_1',
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
                                        <td>${el.ExpenseType}</td>
                                        
                                        <td>
                                            <span style="cursor: pointer;" id="id_${el.id}" onclick="getValueForEdit_banks('${el.id}',this.id)">
                                                <i class="fa fa-fw fa-edit"></i> Edit
                                            </span>

                                            <span style="cursor: pointer;" onclick="confirmToDelete_expense_type('${el.id}')">
                                                <i class="fa fa-fw fa-eraser"></i> Delete
                                            </span>

                                        </td>
                                    </tr>
            
            `;

                    })

                    document.getElementById('here_show_table_content_expense_type').innerHTML = '';

                    var table = `
                            <table id="bank_table" class="table">
                                <thead>
                                <tr>
                                        <th scope="col">Expense Type</th>
                                       
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody id="abc_expense_type">


                                </tbody>
                            </table>
    `;


                    document.getElementById('here_show_table_content_expense_type').innerHTML = table;

                    data_table_pagination_bank()

                    document.getElementById('abc_expense_type').innerHTML = tr;

                    for (var a = 0; a < updated_ids_array.length; a++) {
                        document.getElementById(updated_ids_array[a]).style = "color:red;cursor:pointer";
                    }

                }

            }
        })
    }


    window.onload = (event) => {
        document.getElementById('ExpenseType').focus()
        document.getElementById('ExpenseType').select();
    };


    function insertExpenseType() {

        var ExpenseType = document.getElementById('ExpenseType').value;

        var token = '{{csrf_token()}}';
        $.ajax({
            url: '/insertExpenseType',
            type: 'post',
            data: {
                ExpenseType: ExpenseType,

                _token: token

            },
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                // console.log(data)
                if (data == 'inserted') {
                    $('.loader').hide()
                    document.getElementById('ExpenseType').value = '';

                }
            }
        })

        document.getElementById('ExpenseType').focus()
        document.getElementById('ExpenseType').select();
    }



    function confirmToDelete_expense_type(id) {
        var status = confirm('Want to delete ?');
        if (status) {
            // location.href = value;
            $.ajax({
                url: '/ExpenseTypeDelete',
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
                        alert("Expense Type is deleted successfully !")
                        ShowExpenseType()
                    }
                }
            })
        }

    }


    function UpdateExpenseType() {

        var ExpenseType = document.getElementById('ExpenseType').value;

        var ExpenseType_id = document.getElementById('ExpenseType_id').value;
        var token = '{{csrf_token()}}';
        $.ajax({
            url: '/updateExpenseType',
            type: 'post',
            data: {
                ExpenseType: ExpenseType,

                id: ExpenseType_id,
                _token: token

            },
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                console.log(data)
                if (data == 'updated') {
                    $('.loader').hide()
                    document.getElementById('InsertExpenseTypeBtn').disabled = false;
                    document.getElementById('UpdateExpenseTypeBtn').disabled = true;

                    document.getElementById('ExpenseType').value = '';

                    updated_ids_array.push(variable_id_for_edit)

                } else {
                    $('#ExpenseTypeModal').modal('hide');

                }
            }
        })
    }

    function getValueForEdit_banks(id, id_for_edit) {
        document.getElementById('InsertExpenseTypeBtn').disabled = true;
        document.getElementById('UpdateExpenseTypeBtn').disabled = false;
        $('#ExpenseTypeModal').modal('hide')
        variable_id_for_edit = id_for_edit;

        $.ajax({
            url: '/ExpenseTypeEdit',
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
                    document.getElementById('ExpenseType_id').value = data.id;
                    document.getElementById('ExpenseType').value = data.ExpenseType;

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