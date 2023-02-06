<script>
    $(".loader").hide()
    document.getElementById('UpdateBuyerBtn').disabled = true;

    var page_number = 1;
    variable_id_for_edit = '';
    var updated_ids_array = [];
    // data_table_pagination_Buyers()

    function data_table_pagination_Buyers() {
        $(function() {
            var table = $('#Buyers_table').DataTable({
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

    function ShowBuyers() {
        $('#BuyersModal').modal('show')
        $.ajax({
            url: '/Buyers_Suppliers_1',
            type: 'get',
            data: {
                AccountType: 'Buyer'
            },
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
                                        <td>${el.AccountName_Arabic}</td>
                                        <td>${el.AccountType}</td>
                                        <td>${el.Balance}</td>
                                        <td>${el.Cell}</td>
                                        <td>${el.ContactPerson}</td>
                                        <td>${el.Address}</td>
                                        <td>${el.VatNo}</td>
                                        <td>${el.BankDetail}</td>

                                        <td>
                                            <span style="cursor: pointer;" id="id_${el.id}" onclick="getValueForEdit_buyers('${el.id}',this.id)">
                                                <i class="fa fa-fw fa-edit"></i> Edit
                                            </span>
                                            <br>
                                            <span style="cursor: pointer;" onclick="confirmToDelete_buyers('${el.id}')">
                                                <i class="fa fa-fw fa-eraser"></i> Delete
                                            </span>

                                        </td>
                                    </tr>
            
            `;

                    })

                    document.getElementById('here_show_table_content_buyers').innerHTML = '';

                    var table = `
                            <table id="Buyers_table" class="table">
                                <thead>
                                <tr>
                                        <th scope="col">Account Name</th>
                                        <th scope="col">Account Name Arabic</th>
                                        <th scope="col">AccountType</th>
                                        <th scope="col">Balance</th>
                                        <th scope="col">Cell</th>
                                        <th scope="col">Contact Person</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">VAT No.</th>
                                        <th scope="col">Bank Detail</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody id="abc_buyers">


                                </tbody>
                            </table>
    `;


                    document.getElementById('here_show_table_content_buyers').innerHTML = table;

                    data_table_pagination_Buyers()

                    document.getElementById('abc_buyers').innerHTML = tr;

                    for (var a = 0; a < updated_ids_array.length; a++) {
                        document.getElementById(updated_ids_array[a]).style = "color:red;cursor:pointer";
                    }
                }


            }
        })
    }


    function insertBuyers() {

        var AccountName = document.getElementById('AccountName_Buyer').value;
        var AccountName_Arabic = document.getElementById('AccountName_Arabic').value;
        var AccountType = document.getElementById('AccountType_buyer').value;
        var Balance = document.getElementById('Balance').value;
        var Cell = document.getElementById('Cell').value;
        var ContactPerson = document.getElementById('ContactPerson').value;
        var Address = document.getElementById('Address').value;
        var VatNo = document.getElementById('VatNo').value;
        var BankDetail = document.getElementById('BankDetail').value;
        var AccountId = sessionStorage.getItem('Selected_Head');

        var token = '{{csrf_token()}}';
        $.ajax({
            url: '/insertBuyers_Suppliers',
            type: 'post',
            data: {
                AccountName: AccountName,
                AccountName_Arabic: AccountName_Arabic,
                AccountType: AccountType,
                Balance: Balance,
                Cell: Cell,
                ContactPerson: ContactPerson,
                Address: Address,
                VatNo: VatNo,
                BankDetail: BankDetail,
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
                    document.getElementById('AccountName_Buyer').value = '';
                    document.getElementById('AccountName_Arabic').value = '';
                    document.getElementById('AccountType_buyer').value = '';
                    document.getElementById('Balance').value = '';
                    document.getElementById('Cell').value = '';
                    document.getElementById('ContactPerson').value = '';
                    document.getElementById('Address').value = '';
                    document.getElementById('VatNo').value = '';
                    document.getElementById('BankDetail').value = '';
                    // showUpdated_AccountHead();


                }
            }
        })


    }



    function confirmToDelete_buyers(id) {
        var status = confirm('Want to delete ?');
        if (status) {
            // location.href = value;
            $.ajax({
                url: '/Buyers_SuppliersDelete',
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
                        alert("AccountHead is deleted successfully !")
                        ShowBuyers()
                    }
                }
            })
        }

    }


    function UpdateBuyers() {

        var AccountName = document.getElementById('AccountName_Buyer').value;
        var AccountName_Arabic = document.getElementById('AccountName_Arabic').value;
        var AccountType = document.getElementById('AccountType_buyer').value;
        var Balance = document.getElementById('Balance').value;
        var Cell = document.getElementById('Cell').value;
        var ContactPerson = document.getElementById('ContactPerson').value;
        var Address = document.getElementById('Address').value;
        var VatNo = document.getElementById('VatNo').value;
        var BankDetail = document.getElementById('BankDetail').value;


        var Buyer_id = document.getElementById('Buyer_id').value;
        var token = '{{csrf_token()}}';
        $.ajax({
            url: '/updateBuyers_Suppliers',
            type: 'post',
            data: {
                AccountName: AccountName,
                AccountName_Arabic: AccountName_Arabic,
                AccountType: AccountType,
                Balance: Balance,
                Cell: Cell,
                ContactPerson: ContactPerson,
                Address: Address,
                VatNo: VatNo,
                BankDetail: BankDetail,
                id: Buyer_id,
                _token: token

            },
            beforeSend: function(){
                $('.loader').show()
            },
            success: function(data) {
                console.log(data)
                if (data == 'updated') {
                    $('.loader').hide()
                    document.getElementById('UpdateBuyerBtn').disabled = true
                    document.getElementById('InsertBuyerBtn').disabled = false

                    document.getElementById('AccountName_Buyer').value = '';
                    document.getElementById('AccountName_Arabic').value = '';
                    document.getElementById('AccountType_buyer').value = '';
                    document.getElementById('Balance').value = '';
                    document.getElementById('Cell').value = '';
                    document.getElementById('ContactPerson').value = '';
                    document.getElementById('Address').value = '';
                    document.getElementById('VatNo').value = '';
                    document.getElementById('BankDetail').value = '';

                    // $('#exampleModal').modal('hide');
                    updated_ids_array.push(variable_id_for_edit)
                    // showUpdated_AccountHead()

                } else {
                    $('#exampleModal').modal('hide');

                }
            }
        })
    }

    function getValueForEdit_buyers(id, id_for_edit) {
        document.getElementById('UpdateBuyerBtn').disabled = false
        document.getElementById('InsertBuyerBtn').disabled = true
        $('#BuyersModal').modal('hide')
        // document.getElementById('AccountHead_id').value = id;
        variable_id_for_edit = id_for_edit;

        $.ajax({
            url: '/Buyers_SuppliersEdit',
            type: 'get',
            data: {
                id: id,
            },
            beforeSend: function() {
                $(".loader").show();
            },

            success: function(data) {
                console.log(data)
                if (data != '') {
                    document.getElementById('Buyer_id').value = data.id;
                    document.getElementById('AccountName_Buyer').value = data.AccountName;
                    document.getElementById('AccountName_Arabic').value = data.AccountName_Arabic;

                    document.getElementById('AccountType_buyer').value = data.AccountType;

                    document.getElementById('Balance').value = data.Balance;
                    document.getElementById('Cell').value = data.Cell;
                    document.getElementById('ContactPerson').value = data.ContactPerson;
                    document.getElementById('Address').value = data.Address;
                    document.getElementById('VatNo').value = data.VatNo;
                    document.getElementById('BankDetail').value = data.BankDetail;
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