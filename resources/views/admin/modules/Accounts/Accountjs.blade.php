<script>
    $(".loader").hide()
    document.getElementById('UpdateBankBtn').disabled = true;

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

    function ShowBanks() {
        $('#BankModal').modal('show')
        $.ajax({
            url: '/Account_1',
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
                                        <td>${el.AccountName}</td>
                                        <td>${el.AccountDetail}</td>
                                        <td>${el.OpeningBalance}</td>

                                        <td>
                                            <span style="cursor: pointer;" id="id_${el.id}" onclick="getValueForEdit_banks('${el.id}',this.id)">
                                                <i class="fa fa-fw fa-edit"></i> Edit
                                            </span>

                                            <span style="cursor: pointer;" onclick="confirmToDelete('${el.id}')">
                                                <i class="fa fa-fw fa-eraser"></i> Delete
                                            </span>

                                        </td>
                                    </tr>
            
            `;

                    })

                    document.getElementById('here_show_table_content_bank').innerHTML = '';

                    var table = `
                            <table id="bank_table" class="table">
                                <thead>
                                <tr>
                                        <th scope="col">Account Name</th>
                                        <th scope="col">Account Detailr</th>
                                        <th scope="col">Opening Balance</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody id="abc_bank">


                                </tbody>
                            </table>
    `;


                    document.getElementById('here_show_table_content_bank').innerHTML = table;

                    data_table_pagination_bank()

                    document.getElementById('abc_bank').innerHTML = tr;

                    for (var a = 0; a < updated_ids_array.length; a++) {
                        document.getElementById(updated_ids_array[a]).style = "color:red;cursor:pointer";
                    }

                }

            }
        })
    }


    window.onload = (event) => {
        document.getElementById('AccountName').focus()
        document.getElementById('AccountName').select();
    };


    function insertAccount() {

        var AccountName = document.getElementById('AccountName').value;
        var AccountDetail = document.getElementById('AccountDetail').value;
        var OpeningBalance = document.getElementById('OpeningBalance').value;
        var token = '{{csrf_token()}}';
        $.ajax({
            url: '/insertAccount',
            type: 'post',
            data: {
                AccountName: AccountName,
                AccountDetail: AccountDetail,
                OpeningBalance: OpeningBalance,
                _token: token

            },
            beforeSend : function(){
                $('.loader').show()
            },
            success: function(data) {
                // console.log(data)
                if (data == 'inserted') {
                    $('.loader').hide()
                    document.getElementById('AccountName').value = '';
                    document.getElementById('AccountDetail').value = '';
                    document.getElementById('OpeningBalance').value = '';


                }
            }
        })

        document.getElementById('AccountName').focus()
        document.getElementById('AccountName').select();
    }



    function confirmToDelete(id) {
        var status = confirm('Want to delete ?');
        if (status) {
            // location.href = value;
            $.ajax({
                url: '/AccountDelete',
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
                        alert("Account is deleted successfully !")
                        ShowBanks()
                    }
                }
            })
        }

    }


    function UpdateBank() {

        var AccountName = document.getElementById('AccountName').value;
        var AccountDetail = document.getElementById('AccountDetail').value;
        var OpeningBalance = document.getElementById('OpeningBalance').value;
        var Account_id = document.getElementById('Account_id').value;
        var token = '{{csrf_token()}}';
        $.ajax({
            url: '/updateAccount',
            type: 'post',
            data: {
                AccountName: AccountName,
                AccountDetail: AccountDetail,
                OpeningBalance: OpeningBalance,
                id: Account_id,
                _token: token

            },
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                console.log(data)
                if (data == 'updated') {
                    $('.loader').hide()
                    document.getElementById('InsertBankBtn').disabled = false;
                    document.getElementById('UpdateBankBtn').disabled = true;

                    document.getElementById('AccountName').value = '';
                    document.getElementById('AccountDetail').value = '';
                    document.getElementById('OpeningBalance').value = '';
                    updated_ids_array.push(variable_id_for_edit)

                } else {
                    $('#BankModal').modal('hide');

                }
            }
        })
    }

    function getValueForEdit_banks(id, id_for_edit) {
        document.getElementById('InsertBankBtn').disabled = true;
        document.getElementById('UpdateBankBtn').disabled = false;
        $('#BankModal').modal('hide')
        variable_id_for_edit = id_for_edit;

        $.ajax({
            url: '/AccountEdit',
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
                    document.getElementById('Account_id').value = data.id;
                    document.getElementById('AccountName').value = data.AccountName;
                    document.getElementById('AccountDetail').value = data.AccountDetail;
                    document.getElementById('OpeningBalance').value = data.OpeningBalance;
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